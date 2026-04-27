<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tables = ['programmes', 'courses', 'news', 'events', 'staff', 'department_settings'];
        foreach ($tables as $t) {
            $this->info("Indexes for $t");
            try {
                $indexes = \DB::select("SHOW INDEXES FROM $t");
                foreach ($indexes as $index) {
                    $this->line('  ' . $index->Key_name . ' (' . $index->Column_name . ')');
                }
            } catch (\Exception $e) {
                $this->error("Table $t not found");
            }
        }
    }
}
