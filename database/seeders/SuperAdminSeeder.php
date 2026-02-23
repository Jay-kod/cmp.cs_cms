<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Create or update the default super admin account.
     */
    public function run(): void
    {
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

        $this->command->info('Super Admin seeded: admin@dcms.nsuk.edu.ng / password');
    }
}
