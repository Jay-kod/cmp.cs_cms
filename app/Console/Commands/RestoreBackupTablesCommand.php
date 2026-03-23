<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RestoreBackupTablesCommand extends Command
{
    protected $signature = 'backup:restore-tables
        {dumpPath : Absolute/relative path to the SQL dump}
        {tables : Comma-separated list of table names to restore}
        {--dry-run : Do not execute SQL, only show what would run}';

    protected $description = 'Restore selected tables from an SQL dump (filtered inserts only, idempotent).';

    public function handle(): int
    {
        $dumpPath = $this->argument('dumpPath');
        $tables = array_values(array_filter(array_map('trim', explode(',', $this->argument('tables')))));
        $dryRun = (bool) $this->option('dry-run');

        $absoluteDumpPath = $dumpPath;
        if (!str_starts_with($absoluteDumpPath, DIRECTORY_SEPARATOR) && !preg_match('/^[A-Za-z]:\\\\/', $absoluteDumpPath)) {
            $absoluteDumpPath = base_path($dumpPath);
        }

        if (!is_file($absoluteDumpPath)) {
            $this->error("SQL dump not found: {$absoluteDumpPath}");
            return self::FAILURE;
        }

        $dump = file_get_contents($absoluteDumpPath);
        if ($dump === false) {
            $this->error("Failed reading SQL dump: {$absoluteDumpPath}");
            return self::FAILURE;
        }

        $this->info("Restoring tables from: {$absoluteDumpPath}");

        // Avoid FK-order issues; upserts should still respect unique constraints.
        if (!$dryRun) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $summary = [];

        foreach ($tables as $table) {
            try {
                $this->line("Processing `{$table}` ...");

                $currentColumns = $this->getCurrentColumnsInOrder($table);
                $primaryKeyColumns = $this->getPrimaryKeyColumnsInOrder($table);

                $insertStatements = $this->extractInsertStatements($dump, $table);
                if (count($insertStatements) === 0) {
                    $this->warn("No INSERT statements found for `{$table}` in dump.");
                    $summary[$table] = ['statements' => 0, 'executed' => 0, 'skipped' => 0];
                    continue;
                }

                $executed = 0;
                $skipped = 0;

                foreach ($insertStatements as $stmtIndex => $stmt) {
                    $originalStmt = trim($stmt);
                    if ($originalStmt === '') {
                        continue;
                    }

                    // If the dump was created before some columns were added, the VALUES tuple count won't match.
                    // We rebuild the INSERT with explicit column list using current column order.
                    $valuesTupleCount = $this->countValuesInFirstTuple($originalStmt);

                    if (count($currentColumns) < $valuesTupleCount) {
                        // Can't safely map; skip this statement.
                        $this->warn("Skip statement: current column count < dump value count for `{$table}`.");
                        $skipped++;
                        continue;
                    }

                    $mappedColumns = array_slice($currentColumns, 0, $valuesTupleCount);

                    $mappedStmt = $this->mapInsertToColumnList($originalStmt, $table, $mappedColumns);
                    $upsertStmt = $this->addOnDuplicateKeyUpdate($mappedStmt, $table, $mappedColumns, $primaryKeyColumns);

                    if ($dryRun) {
                        $this->line("DRY-RUN would execute for `{$table}` statement #".($stmtIndex + 1));
                        $executed++;
                        continue;
                    }

                    DB::unprepared($upsertStmt);
                    $executed++;
                }

                $summary[$table] = ['statements' => count($insertStatements), 'executed' => $executed, 'skipped' => $skipped];
                $this->info("`{$table}` done. Executed: {$executed}, Skipped: {$skipped}");
            } catch (\Throwable $e) {
                $this->error("Failed `{$table}`: {$e->getMessage()}");
                $summary[$table] = ['statements' => 0, 'executed' => 0, 'skipped' => 0, 'error' => $e->getMessage()];
            }
        }

        if (!$dryRun) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        $this->info('Restore summary:');
        foreach ($summary as $table => $s) {
            $err = isset($s['error']) ? " Error: {$s['error']}" : '';
            $this->line("- `{$table}` executed={$s['executed']} skipped={$s['skipped']} ({$s['statements']} dump insert(s)).{$err}");
        }

        return self::SUCCESS;
    }

    /**
     * @return string[]
     */
    private function getCurrentColumnsInOrder(string $table): array
    {
        $rows = DB::select(
            'SELECT COLUMN_NAME
             FROM INFORMATION_SCHEMA.COLUMNS
             WHERE TABLE_SCHEMA = DATABASE()
               AND TABLE_NAME = ?
             ORDER BY ORDINAL_POSITION',
            [$table]
        );

        return array_map(static fn ($r) => $r->COLUMN_NAME, $rows);
    }

    /**
     * @return string[]
     */
    private function getPrimaryKeyColumnsInOrder(string $table): array
    {
        $rows = DB::select(
            'SELECT kcu.COLUMN_NAME
             FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS tc
             JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
               ON tc.CONSTRAINT_NAME = kcu.CONSTRAINT_NAME
              AND tc.TABLE_SCHEMA = kcu.TABLE_SCHEMA
             WHERE tc.TABLE_SCHEMA = DATABASE()
               AND tc.TABLE_NAME = ?
               AND tc.CONSTRAINT_TYPE = "PRIMARY KEY"
             ORDER BY kcu.ORDINAL_POSITION',
            [$table]
        );

        return array_map(static fn ($r) => $r->COLUMN_NAME, $rows);
    }

    /**
     * Extract all `INSERT INTO `{$table}` VALUES ...;` statements from dump.
     *
     * @return string[]
     */
    private function extractInsertStatements(string $dump, string $table): array
    {
        // Important: the dump can contain semicolons inside SQL string literals.
        // So we can't use a regex like `.*?;` to find the end of the INSERT.
        // Instead, we scan forward and treat `;` as the end only when we are NOT inside a string.
        $needle = "INSERT INTO `{$table}` VALUES";
        $stmts = [];
        $offset = 0;
        $len = strlen($dump);

        while (true) {
            $pos = strpos($dump, $needle, $offset);
            if ($pos === false) {
                break;
            }

            $inString = false;
            $escape = false;

            for ($i = $pos; $i < $len; $i++) {
                $ch = $dump[$i];

                if ($escape) {
                    $escape = false;
                    continue;
                }

                if ($ch === '\\') {
                    $escape = true;
                    continue;
                }

                if ($ch === "'") {
                    $inString = !$inString;
                    continue;
                }

                if (!$inString && $ch === ';') {
                    $stmts[] = substr($dump, $pos, $i - $pos + 1);
                    $offset = $i + 1;
                    break;
                }
            }

            // Avoid infinite loops if no semicolon is found.
            if (count($stmts) > 1000) {
                break;
            }
        }

        return $stmts;
    }

    private function countValuesInFirstTuple(string $insertStatement): int
    {
        // Find the "VALUES" keyword and the first tuple "(...)"
        $valuesPos = stripos($insertStatement, 'VALUES');
        if ($valuesPos === false) {
            throw new \RuntimeException('Invalid INSERT (missing VALUES).');
        }

        $afterValues = substr($insertStatement, $valuesPos + strlen('VALUES'));
        $firstOpen = strpos($afterValues, '(');
        if ($firstOpen === false) {
            throw new \RuntimeException('Invalid INSERT (missing first tuple).');
        }

        $tupleStart = $valuesPos + strlen('VALUES') + $firstOpen;

        // Extract the first tuple by looking for the dump's usual separator pattern: `),(`
        // outside of SQL strings. This is more robust than generic parenthesis balancing.
        $len = strlen($insertStatement);
        $inString = false;
        $escape = false;
        $tupleEnd = null;

        for ($i = $tupleStart; $i < $len; $i++) {
            $ch = $insertStatement[$i];

            if ($escape) {
                $escape = false;
                continue;
            }

            if ($ch === '\\') {
                $escape = true;
                continue;
            }

            if ($ch === "'") {
                $inString = !$inString;
                continue;
            }

            if (!$inString && $ch === ')') {
                // Look ahead for `,(`
                if (($i + 2) < $len && $insertStatement[$i + 1] === ',' && $insertStatement[$i + 2] === '(') {
                    $tupleEnd = $i;
                    break;
                }
            }
        }

        // Fallback: if we couldn't find `),(`, try to find the next `);` close for the first tuple.
        if ($tupleEnd === null) {
            $tupleEnd = strpos($insertStatement, ');', $tupleStart);
            if ($tupleEnd === false) {
                throw new \RuntimeException('Failed extracting first tuple.');
            }
            // `);` starts at the ')' position.
            $tupleEnd = $tupleEnd;
        }

        $tuple = substr($insertStatement, $tupleStart, $tupleEnd - $tupleStart + 1);

        // Now count comma separators at top-level within the tuple.
        // tuple includes outer parentheses.
        $inner = substr($tuple, 1, -1);
        $inString = false;
        $escape = false;
        $topLevelCommas = 0;

        $innerLen = strlen($inner);
        for ($j = 0; $j < $innerLen; $j++) {
            $ch = $inner[$j];

            if ($escape) {
                $escape = false;
                continue;
            }

            if ($ch === '\\') {
                $escape = true;
                continue;
            }

            if ($ch === "'") {
                $inString = !$inString;
                continue;
            }

            if (!$inString && $ch === ',') {
                $topLevelCommas++;
            }
        }

        return $topLevelCommas + 1;
    }

    /**
     * Replace `INSERT INTO `table` VALUES` with `INSERT INTO `table` (`col1`,`col2`,...) VALUES`.
     *
     * @param string[] $mappedColumns
     */
    private function mapInsertToColumnList(string $insertStatement, string $table, array $mappedColumns): string
    {
        $colsSql = '`' . implode('`,`', $mappedColumns) . '`';

        return preg_replace(
            "/INSERT INTO `".preg_quote($table, '/')."` VALUES /",
            "INSERT INTO `{$table}` ({$colsSql}) VALUES ",
            $insertStatement,
            1
        );
    }

    /**
     * Add ON DUPLICATE KEY UPDATE for the mapped columns (excluding primary key columns).
     *
     * @param string[] $mappedColumns
     * @param string[] $primaryKeyColumns
     */
    private function addOnDuplicateKeyUpdate(string $insertStatement, string $table, array $mappedColumns, array $primaryKeyColumns): string
    {
        if (stripos($insertStatement, 'ON DUPLICATE KEY UPDATE') !== false) {
            return $insertStatement;
        }

        $pkSet = array_flip($primaryKeyColumns);
        $updates = [];

        foreach ($mappedColumns as $col) {
            if (isset($pkSet[$col])) {
                continue;
            }
            $updates[] = "`{$col}` = VALUES(`{$col}`)";
        }

        // If somehow every mapped column is part of the PK, we can't build an UPDATE clause.
        if (count($updates) === 0) {
            return $insertStatement;
        }

        $insertStatement = rtrim(trim($insertStatement), ';');
        return $insertStatement.' ON DUPLICATE KEY UPDATE '.implode(', ', $updates).';';
    }
}

