<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffRole;
use App\Models\PastHod;
use App\Models\NacosPresident;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BulkImportController extends Controller
{
    /**
     * Definitions for each importable resource.
     */
    private function definitions(): array
    {
        return [
            'staff' => [
                'label'    => 'Staff Members',
                'model'    => Staff::class,
                'columns'  => ['name', 'rank', 'qualifications', 'area_of_specialization', 'status', 'position_responsibility'],
                'required' => ['name'],
                'back'     => 'admin.staff.index',
                'extra'    => function (array &$row) {
                    // The "name" column may hold merged multi-row data like:
                    // "Dr. John Doe\njohn@email.com\n123 Address\n08012345678"
                    // Split it into separate name / email / address / phone fields.
                    $nameValue = $row['name'] ?? '';

                    if (str_contains($nameValue, "\n")) {
                        $lines = array_map('trim', explode("\n", $nameValue));
                        $row['name'] = $lines[0] ?? '';
                        foreach (array_slice($lines, 1) as $line) {
                            if (empty($line)) continue;
                            if (empty($row['email']) && filter_var($line, FILTER_VALIDATE_EMAIL)) {
                                $row['email'] = $line;
                            } elseif (empty($row['phone']) && preg_match('/^[\d\s\+\-\(\)]{7,}$/', $line)) {
                                $row['phone'] = $line;
                            } elseif (empty($row['address'])) {
                                $row['address'] = $line;
                            }
                        }
                    }

                    // If "name" still looks like a phone number or email,
                    // it's a mis-parsed continuation row — skip it.
                    $nameVal = trim($row['name'] ?? '');
                    if ($nameVal !== '' && (
                        preg_match('/^[\d\s\+\-\(\)]{7,}$/', $nameVal) ||
                        filter_var($nameVal, FILTER_VALIDATE_EMAIL)
                    )) {
                        $row['name'] = '';
                        return;
                    }

                    $row['slug'] = Str::slug($row['name']) . '-' . Str::random(4);

                    // Check required: name must exist
                    if (empty(trim($row['name'] ?? ''))) {
                        return;
                    }

                    // Convert newline-separated merged values to comma-separated
                    // (qualifications, rank, etc. may span multiple rows in Excel)
                    foreach (['qualifications', 'area_of_specialization', 'rank', 'position_responsibility'] as $col) {
                        if (isset($row[$col]) && str_contains($row[$col], "\n")) {
                            $row[$col] = implode(', ', array_filter(array_map('trim', explode("\n", $row[$col]))));
                        }
                    }

                    // Map friendly CSV column names to database column names
                    if (isset($row['area_of_specialization'])) {
                        $row['specialisation'] = $row['area_of_specialization'];
                        unset($row['area_of_specialization']);
                    }
                    if (isset($row['position_responsibility'])) {
                        $row['role'] = $row['position_responsibility'];
                        unset($row['position_responsibility']);
                    }
                    // Normalise status values to one of: Tenure, Visiting, Sabbatical
                    if (isset($row['status'])) {
                        $statusLower = strtolower(trim($row['status']));
                        if (in_array($statusLower, ['visiting', 'visit'])) {
                            $row['status'] = 'Visiting';
                        } elseif (in_array($statusLower, ['sabbatical', 'sabbat'])) {
                            $row['status'] = 'Sabbatical';
                        } else {
                            $row['status'] = 'Tenure';
                        }
                    } else {
                        $row['status'] = 'Tenure';
                    }
                },
            ],
            'staff-roles' => [
                'label'    => 'Staff Roles',
                'model'    => StaffRole::class,
                'columns'  => ['name', 'sort_order'],
                'required' => ['name'],
                'back'     => 'admin.staff-roles.index',
                'extra'    => function (array &$row) {
                    $row['sort_order'] = (int) ($row['sort_order'] ?? 0);
                },
            ],
            'past-hods' => [
                'label'    => 'Past HODs',
                'model'    => PastHod::class,
                'columns'  => ['name', 'tenure_start', 'tenure_end', 'bio'],
                'required' => ['name'],
                'back'     => 'admin.past-hods.index',
                'extra'    => null,
            ],
            'nacos-presidents' => [
                'label'    => 'NACOS Presidents',
                'model'    => NacosPresident::class,
                'columns'  => ['name', 'tenure_start', 'tenure_end', 'bio', 'current_status', 'email', 'whatsapp', 'facebook', 'x'],
                'required' => ['name'],
                'back'     => 'admin.nacos-presidents.index',
                'extra'    => null,
            ],
        ];
    }

    /**
     * Show the upload form.
     */
    public function show(string $type)
    {
        $def = $this->definitions()[$type] ?? abort(404);

        return view('admin.bulk-import', [
            'type'     => $type,
            'label'    => $def['label'],
            'columns'  => $def['columns'],
            'required' => $def['required'],
        ]);
    }

    /**
     * Download a CSV template for the given resource.
     */
    public function template(string $type)
    {
        $def = $this->definitions()[$type] ?? abort(404);

        // Use friendly header names for the CSV template.
        // Quote any value that contains commas to prevent CSV column splitting.
        $friendlyHeaders = array_map(function ($col) use ($type) {
            if ($type === 'staff' && $col === 'name') {
                return '"Name, Email, Address & Phone"';
            }
            return ucwords(str_replace('_', ' ', $col));
        }, $def['columns']);

        $headers = implode(',', $friendlyHeaders);
        $filename = "{$type}-import-template.csv";

        return response($headers . "\n", 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    /**
     * Parse an uploaded file (CSV, XLSX, XLS) into an array of rows.
     */
    private function parseFile($file): array
    {
        $ext = strtolower($file->getClientOriginalExtension());

        // Always try PhpSpreadsheet first — it handles CSV, XLSX, XLS, and
        // auto-detects format more reliably than manual CSV parsing.
        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = [];
            foreach ($worksheet->toArray(null, true, true, false) as $row) {
                $rows[] = array_map(fn ($cell) => $cell !== null ? (string) $cell : '', $row);
            }
            // Remove trailing empty rows
            while (count($rows) > 0 && !array_filter(end($rows))) {
                array_pop($rows);
            }
            // If we got a reasonable number of columns, return
            if (count($rows) > 0 && count($rows[0]) > 1) {
                return $rows;
            }
        } catch (\Exception $e) {
            // Fall through to manual CSV parsing
        }

        // Manual CSV/TXT parsing with auto-detected delimiter
        $content = file_get_contents($file->getRealPath());
        // Strip BOM
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
        // Normalise line endings
        $content = str_replace(["\r\n", "\r"], "\n", $content);

        $lines = array_filter(explode("\n", $content), fn ($l) => trim($l) !== '');
        if (empty($lines)) {
            return [];
        }

        // Auto-detect delimiter from the first line
        $firstLine = reset($lines);
        $delimiter = $this->detectDelimiter($firstLine);

        return array_map(fn ($line) => str_getcsv($line, $delimiter), $lines);
    }

    /**
     * Auto-detect the CSV delimiter from a line of text.
     */
    private function detectDelimiter(string $line): string
    {
        $delimiters = [
            "\t" => 0,
            ','  => 0,
            ';'  => 0,
            '|'  => 0,
        ];

        foreach ($delimiters as $d => &$count) {
            $count = substr_count($line, $d);
        }

        // Return the delimiter with the highest occurrence
        arsort($delimiters);
        $best = array_key_first($delimiters);

        // If the best delimiter has 0 occurrences, default to comma
        return $delimiters[$best] > 0 ? $best : ',';
    }

    /**
     * Parse, merge, and map an uploaded file. Returns the processed data
     * or redirects back with errors.
     */
    private function parseAndMap(Request $request, string $type): array|false
    {
        $def = $this->definitions()[$type] ?? abort(404);

        $request->validate([
            'csv_file' => 'required|file|max:5120',
        ]);

        $file = $request->file('csv_file');
        $ext = strtolower($file->getClientOriginalExtension());
        $allowed = ['csv', 'txt', 'xlsx', 'xls'];

        if (! in_array($ext, $allowed)) {
            return false;
        }

        try {
            $rows = $this->parseFile($file);
        } catch (\Exception $e) {
            return false;
        }

        if (count($rows) < 2) {
            return false;
        }

        // Find header row
        $headerRowIndex = 0;
        foreach ($rows as $ri => $row) {
            $nonEmpty = count(array_filter($row, fn ($c) => trim($c) !== ''));
            if ($nonEmpty >= 2) {
                $headerRowIndex = $ri;
                break;
            }
        }

        $rawHeaders = $rows[$headerRowIndex];
        $dataRows = array_slice($rows, $headerRowIndex + 1);

        if (count($dataRows) < 1) {
            return false;
        }

        // Merge multi-row records
        $dataRows = $this->mergeMultiRowRecords($dataRows, $rawHeaders);

        $headers = array_map(fn ($h) => Str::slug(trim($h), '_'), $rawHeaders);
        $validColumns = $def['columns'];

        // Map columns (3-pass)
        $columnMap = [];
        $usedColumns = [];
        $skipPatterns = ['s_n', 'sn', 'serial', 'serial_number', 'no', 'number', 's_no', 'sr_no', 'sl_no'];

        foreach ($headers as $index => $header) {
            if ($header === '' || in_array($header, $skipPatterns)) continue;
            if (in_array($header, $validColumns) && !in_array($header, $usedColumns)) {
                $columnMap[$index] = $header;
                $usedColumns[] = $header;
            }
        }
        foreach ($headers as $index => $header) {
            if ($header === '' || isset($columnMap[$index]) || in_array($header, $skipPatterns)) continue;
            foreach ($validColumns as $col) {
                if (in_array($col, $usedColumns)) continue;
                if (str_contains($header, $col) || (strlen($header) >= 3 && str_contains($col, $header))) {
                    $columnMap[$index] = $col;
                    $usedColumns[] = $col;
                    break;
                }
            }
        }
        foreach ($headers as $index => $header) {
            if (isset($columnMap[$index]) || in_array($header, $skipPatterns)) continue;
            $stripped = strtolower(preg_replace('/[^a-zA-Z]/', '', $rawHeaders[$index] ?? ''));
            foreach ($validColumns as $col) {
                if (in_array($col, $usedColumns)) continue;
                $colStripped = preg_replace('/[^a-zA-Z]/', '', $col);
                if (str_contains($stripped, $colStripped)) {
                    $columnMap[$index] = $col;
                    $usedColumns[] = $col;
                    break;
                }
            }
        }

        return [
            'def' => $def,
            'rawHeaders' => $rawHeaders,
            'headers' => $headers,
            'columnMap' => $columnMap,
            'dataRows' => $dataRows,
            'validColumns' => $validColumns,
            'skipPatterns' => $skipPatterns,
        ];
    }

    /**
     * Transform raw data rows into mapped + processed records ready for DB.
     * Returns array of ['records' => [...], 'skipped' => int, 'errors' => [...]]
     */
    private function transformRecords(array $dataRows, array $columnMap, array $def): array
    {
        $records = [];
        $skipped = 0;
        $errors  = [];

        foreach ($dataRows as $i => $row) {
            if (!array_filter($row)) continue;

            $data = [];
            foreach ($columnMap as $colIndex => $colName) {
                $data[$colName] = isset($row[$colIndex]) ? trim($row[$colIndex]) : null;
            }

            // Check required
            $missing = [];
            foreach ($def['required'] as $req) {
                if (empty($data[$req])) $missing[] = $req;
            }
            if ($missing) {
                $skipped++;
                $errors[] = "Row " . ($i + 1) . ": missing required field(s) — " . implode(', ', $missing);
                continue;
            }

            // Run extra transformations
            if ($def['extra']) {
                ($def['extra'])($data);
            }

            // Skip rows where name resolved to empty
            if (array_key_exists('name', $data) && empty(trim($data['name'] ?? ''))) {
                $skipped++;
                $errors[] = "Row " . ($i + 1) . ": could not detect a valid name — skipped";
                continue;
            }

            $records[] = $data;
        }

        return compact('records', 'skipped', 'errors');
    }

    /**
     * Step 1: Upload file → parse → show preview for confirmation.
     */
    public function preview(Request $request, string $type)
    {
        $def = $this->definitions()[$type] ?? abort(404);

        $request->validate([
            'csv_file' => 'required|file|max:5120',
        ]);

        $file = $request->file('csv_file');
        $ext = strtolower($file->getClientOriginalExtension());
        $allowed = ['csv', 'txt', 'xlsx', 'xls'];

        if (! in_array($ext, $allowed)) {
            return back()->withErrors(['csv_file' => 'Unsupported file type. Please upload a CSV, XLSX, or XLS file.']);
        }

        try {
            $rows = $this->parseFile($file);
        } catch (\Exception $e) {
            return back()->withErrors(['csv_file' => 'Could not read the file. Error: ' . Str::limit($e->getMessage(), 120)]);
        }

        if (count($rows) < 2) {
            return back()->withErrors(['csv_file' => 'The file must contain a header row and at least one data row.']);
        }

        // Find header row
        $headerRowIndex = 0;
        foreach ($rows as $ri => $row) {
            $nonEmpty = count(array_filter($row, fn ($c) => trim($c) !== ''));
            if ($nonEmpty >= 2) {
                $headerRowIndex = $ri;
                break;
            }
        }

        $rawHeaders = $rows[$headerRowIndex];
        $dataRows = array_slice($rows, $headerRowIndex + 1);

        if (count($dataRows) < 1) {
            return back()->withErrors(['csv_file' => 'The file must contain at least one data row after the header row.']);
        }

        // Merge multi-row records
        $dataRows = $this->mergeMultiRowRecords($dataRows, $rawHeaders);

        $headers = array_map(fn ($h) => Str::slug(trim($h), '_'), $rawHeaders);
        $validColumns = $def['columns'];

        // Map columns (3-pass)
        $columnMap = [];
        $usedColumns = [];
        $skipPatterns = ['s_n', 'sn', 'serial', 'serial_number', 'no', 'number', 's_no', 'sr_no', 'sl_no'];

        foreach ($headers as $index => $header) {
            if ($header === '' || in_array($header, $skipPatterns)) continue;
            if (in_array($header, $validColumns) && !in_array($header, $usedColumns)) {
                $columnMap[$index] = $header;
                $usedColumns[] = $header;
            }
        }
        foreach ($headers as $index => $header) {
            if ($header === '' || isset($columnMap[$index]) || in_array($header, $skipPatterns)) continue;
            foreach ($validColumns as $col) {
                if (in_array($col, $usedColumns)) continue;
                if (str_contains($header, $col) || (strlen($header) >= 3 && str_contains($col, $header))) {
                    $columnMap[$index] = $col;
                    $usedColumns[] = $col;
                    break;
                }
            }
        }
        foreach ($headers as $index => $header) {
            if (isset($columnMap[$index]) || in_array($header, $skipPatterns)) continue;
            $stripped = strtolower(preg_replace('/[^a-zA-Z]/', '', $rawHeaders[$index] ?? ''));
            foreach ($validColumns as $col) {
                if (in_array($col, $usedColumns)) continue;
                $colStripped = preg_replace('/[^a-zA-Z]/', '', $col);
                if (str_contains($stripped, $colStripped)) {
                    $columnMap[$index] = $col;
                    $usedColumns[] = $col;
                    break;
                }
            }
        }

        // Check required columns
        $mappedCols = array_values($columnMap);
        foreach ($def['required'] as $req) {
            if (!in_array($req, $mappedCols)) {
                $detected = empty($columnMap)
                    ? 'none'
                    : implode(', ', array_map(fn ($c) => "\"{$c}\"", array_unique($columnMap)));
                $rawList = implode(', ', array_map(fn ($h) => '"' . trim($h) . '"', $rawHeaders));
                return back()->withErrors([
                    'csv_file' => "Required column \"{$req}\" is missing. Detected columns: {$detected}. Raw headers: {$rawList}",
                ]);
            }
        }

        // Transform records (apply extra logic, column renames, etc.)
        $result = $this->transformRecords($dataRows, $columnMap, $def);

        // Build mapping info for display
        $mappingInfo = [];
        foreach ($columnMap as $ci => $colName) {
            $mappingInfo[] = '"' . trim($rawHeaders[$ci]) . '" → ' . $colName;
        }

        // Store records in session for the confirm step
        session()->put('bulk_import_preview', [
            'type'    => $type,
            'records' => $result['records'],
        ]);

        // Determine the display columns for staff (after transform they use DB names)
        if ($type === 'staff') {
            $displayColumns = ['name', 'email', 'address', 'phone', 'rank', 'qualifications', 'specialisation', 'status', 'role'];
        } else {
            $displayColumns = $def['columns'];
        }

        return view('admin.bulk-import-preview', [
            'type'           => $type,
            'label'          => $def['label'],
            'records'        => $result['records'],
            'skipped'        => $result['skipped'],
            'errors'         => $result['errors'],
            'mappingInfo'    => $mappingInfo,
            'displayColumns' => $displayColumns,
            'totalRawRows'   => count($dataRows),
        ]);
    }

    /**
     * Step 2: Confirm import — actually save the previewed records to the DB.
     */
    public function confirmImport(Request $request, string $type)
    {
        $def = $this->definitions()[$type] ?? abort(404);

        $preview = session()->pull('bulk_import_preview');

        if (!$preview || $preview['type'] !== $type || empty($preview['records'])) {
            return redirect()->route('admin.bulk-import.show', $type)
                ->withErrors(['csv_file' => 'Preview session expired. Please upload the file again.']);
        }

        // Get the list of row indices the user chose to exclude
        $excludedIndices = array_flip($request->input('exclude', []));

        $imported = 0;
        $skipped  = 0;
        $errors   = [];

        foreach ($preview['records'] as $i => $data) {
            // Skip rows the user unchecked
            if (isset($excludedIndices[$i])) {
                $skipped++;
                continue;
            }

            try {
                $def['model']::create($data);
                $imported++;
            } catch (\Exception $e) {
                $skipped++;
                $errors[] = "Record #" . ($i + 1) . ": " . Str::limit($e->getMessage(), 120);
            }
        }

        $message = "{$imported} " . Str::plural('record', $imported) . " imported successfully.";
        if ($skipped) {
            $message .= " {$skipped} " . Str::plural('row', $skipped) . " skipped.";
        }

        return redirect()->route($def['back'])
            ->with('success', $message)
            ->with('import_errors', $errors);
    }

    /**
     * Legacy direct import (kept for non-staff types or API use).
     */
    public function import(Request $request, string $type)
    {
        // Redirect to preview flow instead
        return $this->preview($request, $type);
    }

    /**
     * Convert common truthy/falsy strings to boolean.
     */
    private function toBool($val): bool
    {
        return in_array(strtolower(trim($val)), ['1', 'true', 'yes', 'y'], true);
    }

    /**
     * Merge multi-row records into single rows.
     *
     * Many formal Excel documents split one person's data across multiple rows:
     *   Row 1: 1 | Dr. John Doe      | Professor | PhD, MSc | AI    | Active | HOD
     *   Row 2:   | john@email.com     |           |          |       |        |
     *   Row 3:   | 08012345678        |           |          |       |        |
     *
     * This method detects the "index" column (S/N) and merges continuation rows
     * (those without an S/N value) into the previous main row by appending
     * non-empty cell values with a newline separator.
     *
     * If no S/N column is found, it uses a heuristic: rows with data in 3+
     * columns are "main" records; rows with data in only 1-2 columns are
     * continuation rows that get merged into the previous main row.
     */
    private function mergeMultiRowRecords(array $dataRows, array $headers): array
    {
        if (count($dataRows) <= 1) {
            return $dataRows;
        }

        // Normalise: pad every row to the same length as headers
        $colCount = count($headers);
        foreach ($dataRows as &$row) {
            $row = array_pad($row, $colCount, '');
        }
        unset($row);

        // Find the S/N column index — it's the column whose header slugifies to
        // a skip pattern AND whose first data value looks like a number (1, 2, etc.)
        $sluggedHeaders = array_map(fn ($h) => Str::slug(trim($h), '_'), $headers);
        $skipPatterns = ['s_n', 'sn', 'serial', 'serial_number', 'no', 'number', 's_no', 'sr_no', 'sl_no', 'num'];

        $snColIndex = null;
        foreach ($sluggedHeaders as $idx => $slug) {
            if (in_array($slug, $skipPatterns)) {
                $snColIndex = $idx;
                break;
            }
        }

        // If no S/N column found via header, check ANY column for sequential
        // numeric pattern (1, 2, 3...) — that column is likely S/N
        if ($snColIndex === null) {
            for ($ci = 0; $ci < min($colCount, 2); $ci++) {
                $firstVal = trim($dataRows[0][$ci] ?? '');
                if (is_numeric($firstVal) && (int) $firstVal <= 3) {
                    // Verify at least a few data rows follow the numeric pattern
                    $numericCount = 0;
                    foreach (array_slice($dataRows, 0, 20) as $row) {
                        $v = trim($row[$ci] ?? '');
                        if ($v !== '' && is_numeric($v)) {
                            $numericCount++;
                        }
                    }
                    if ($numericCount >= 2) {
                        $snColIndex = $ci;
                        break;
                    }
                }
            }
        }

        // --- S/N-based merge ---
        if ($snColIndex !== null) {
            return $this->mergeUsingSn($dataRows, $snColIndex);
        }

        // --- Heuristic merge (no S/N column) ---
        // Detect multi-row pattern: "main" rows have data in many columns,
        // "continuation" rows have data in only 1-2 columns.
        $sparseRows = 0;
        $denseRows  = 0;

        foreach ($dataRows as $row) {
            $nonEmpty = count(array_filter(array_map('trim', $row), fn ($c) => $c !== ''));
            if ($nonEmpty >= 3) {
                $denseRows++;
            } elseif ($nonEmpty >= 1) {
                $sparseRows++;
            }
        }

        // If there are more sparse rows than dense rows, it's multi-row format
        if ($denseRows > 0 && $sparseRows > $denseRows) {
            return $this->mergeUsingDensity($dataRows);
        }

        // No multi-row pattern detected — return as-is
        return $dataRows;
    }

    /**
     * Merge rows using S/N column: rows with a numeric S/N value start a new
     * record; rows with empty S/N are continuation rows.
     */
    private function mergeUsingSn(array $dataRows, int $snColIndex): array
    {
        $merged = [];
        $currentRecord = null;

        foreach ($dataRows as $row) {
            $snValue = trim($row[$snColIndex] ?? '');

            if ($snValue !== '' && is_numeric($snValue)) {
                if ($currentRecord !== null) {
                    $merged[] = $currentRecord;
                }
                $currentRecord = $row;
            } elseif ($currentRecord !== null) {
                foreach ($row as $ci => $cellValue) {
                    if ($ci === $snColIndex) continue;
                    $cellValue = trim($cellValue);
                    if ($cellValue === '') continue;

                    $existing = trim($currentRecord[$ci] ?? '');
                    if ($existing === '') {
                        $currentRecord[$ci] = $cellValue;
                    } else {
                        $currentRecord[$ci] = $existing . "\n" . $cellValue;
                    }
                }
            } else {
                $merged[] = $row;
            }
        }

        if ($currentRecord !== null) {
            $merged[] = $currentRecord;
        }

        return $merged;
    }

    /**
     * Merge rows using density heuristic: rows with 3+ non-empty cells are
     * "main" records; rows with 1-2 non-empty cells are continuations.
     */
    private function mergeUsingDensity(array $dataRows): array
    {
        $merged = [];
        $currentRecord = null;

        foreach ($dataRows as $row) {
            $nonEmpty = count(array_filter(array_map('trim', $row), fn ($c) => $c !== ''));

            if ($nonEmpty >= 3) {
                if ($currentRecord !== null) {
                    $merged[] = $currentRecord;
                }
                $currentRecord = $row;
            } elseif ($currentRecord !== null && $nonEmpty > 0) {
                foreach ($row as $ci => $cellValue) {
                    $cellValue = trim($cellValue);
                    if ($cellValue === '') continue;

                    $existing = trim($currentRecord[$ci] ?? '');
                    if ($existing === '') {
                        $currentRecord[$ci] = $cellValue;
                    } else {
                        $currentRecord[$ci] = $existing . "\n" . $cellValue;
                    }
                }
            } elseif ($nonEmpty > 0) {
                // No current record yet but has data — standalone row
                $merged[] = $row;
            }
        }

        if ($currentRecord !== null) {
            $merged[] = $currentRecord;
        }

        return $merged;
    }
}
