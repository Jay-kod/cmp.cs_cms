<?php

namespace Database\Seeders;

use App\Models\ResourceCategory;
use Illuminate\Database\Seeder;

class ResourceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'handbook', 'name' => 'Department Handbook', 'sort_order' => 10],
            ['slug' => 'timetable', 'name' => 'Departmental Timetable', 'sort_order' => 5],
            ['slug' => 'rules', 'name' => 'Rules & Regulations', 'sort_order' => 20],
            ['slug' => 'forms', 'name' => 'Forms & Documents', 'sort_order' => 30],
            ['slug' => 'other', 'name' => 'Other Downloads', 'sort_order' => 40],
        ];

        foreach ($categories as $c) {
            ResourceCategory::updateOrCreate(
                ['slug' => $c['slug']],
                [
                    'name' => $c['name'],
                    'sort_order' => $c['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}

