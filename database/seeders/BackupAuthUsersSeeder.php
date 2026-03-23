<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackupAuthUsersSeeder extends Seeder
{
    /**
     * Restore only the login users (Admin + Super Admin) from the project SQL backup.
     *
     * This is intentionally "filtered" to avoid importing the entire dump.
     */
    public function run(): void
    {
        // Values extracted from:
        // database backup/dcms_backup_2026-03-18_11-47-19.sql
        // INSERT INTO `users` VALUES (... admin@dcms.nsuk.edu.ng ...), (... staff@dcms.nsuk.edu.ng ...)
        $users = [
            [
                'email' => 'admin@dcms.nsuk.edu.ng',
                'name' => 'Super Admin',
                'is_admin' => 1,
                'role' => 'super_admin',
                'email_verified_at' => '2026-02-23 14:25:01',
                'password' => '$2y$12$gjgp.PVvCCG5uB5Y/s4wHOkN6apDw7igS.kYGp61bKQ1WFSVuziqe',
                'remember_token' => 'UGqMyb597QnEmGiSzqjdZJRGoCznNb0fGVuNjPgB6M8woZF3MQXw6yCVZf8c',
                'created_at' => '2026-02-22 19:50:06',
                'updated_at' => '2026-02-23 14:25:01',
            ],
            [
                'email' => 'staff@dcms.nsuk.edu.ng',
                'name' => 'Admin User',
                'is_admin' => 1,
                'role' => 'admin',
                'email_verified_at' => '2026-02-23 14:25:01',
                'password' => '$2y$12$a2U1i61NNH/bw75fiaZMlOyT1z0LMPDodrW1UL3mPctQM2mz6B0eu',
                'remember_token' => 'CRVlqPoBhWhRectpHWJo9LuvOI93fRL8xNtdE1R6DB2SPLUL3a341duaP4dN',
                'created_at' => '2026-02-23 14:25:01',
                'updated_at' => '2026-02-23 14:25:01',
            ],
        ];

        foreach ($users as $u) {
            DB::table('users')->updateOrInsert(['email' => $u['email']], $u);
        }
    }
}

