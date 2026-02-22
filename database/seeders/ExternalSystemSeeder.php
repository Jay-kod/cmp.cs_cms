<?php

namespace Database\Seeders;

use App\Models\ExternalSystem;
use Illuminate\Database\Seeder;

class ExternalSystemSeeder extends Seeder
{
    public function run(): void
    {
        $systems = [
            [
                'name' => 'Departmental Due Payment',
                'url' => '#',
                'icon' => 'fa-solid fa-credit-card',
                'description' => 'Online portal for departmental due payments',
                'is_active' => true,
                'open_in_new_tab' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Project Management System',
                'url' => '#',
                'icon' => 'fa-solid fa-diagram-project',
                'description' => 'Student project submission and management system',
                'is_active' => true,
                'open_in_new_tab' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($systems as $system) {
            ExternalSystem::updateOrCreate(
                ['name' => $system['name']],
                $system
            );
        }
    }
}
