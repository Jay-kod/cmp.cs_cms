<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Create or update the default admin accounts.
     * Two roles only: admin and super_admin.
     */
    public function run(): void
    {
        // ── Super Admin ──
        User::updateOrCreate(
            ['email' => 'admin@dcms.nsuk.edu.ng'],
            [
                'name'              => 'Super Admin',
                'password'          => Hash::make('password'),
                'is_admin'          => true,
                'role'              => User::ROLE_SUPER_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // ── Regular Admin ──
        User::updateOrCreate(
            ['email' => 'staff@dcms.nsuk.edu.ng'],
            [
                'name'              => 'Admin User',
                'password'          => Hash::make('password'),
                'is_admin'          => true,
                'role'              => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('');
        $this->command->info('  ┌───────────────────────────────────────────────────────┐');
        $this->command->info('  │  SEEDED USERS                                        │');
        $this->command->info('  ├───────────────────────────────────────────────────────┤');
        $this->command->info('  │  Super Admin: admin@dcms.nsuk.edu.ng / password       │');
        $this->command->info('  │  Admin:       staff@dcms.nsuk.edu.ng / password       │');
        $this->command->info('  └───────────────────────────────────────────────────────┘');
        $this->command->info('');
    }
}
