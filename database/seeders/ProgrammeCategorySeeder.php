<?php

namespace Database\Seeders;

use App\Models\ProgrammeCategory;
use Illuminate\Database\Seeder;

class ProgrammeCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Undergraduate (Full-Time)',
                'slug'        => 'undergraduate-full-time',
                'description' => 'Full-time undergraduate degree programmes designed for students pursuing a comprehensive on-campus learning experience.',
                'icon'        => 'fa-solid fa-graduation-cap',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'name'        => 'Undergraduate (Part-Time)',
                'slug'        => 'undergraduate-part-time',
                'description' => 'Part-time undergraduate programmes for working professionals and students who prefer a flexible study schedule.',
                'icon'        => 'fa-solid fa-clock',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'name'        => 'Masters',
                'slug'        => 'masters',
                'description' => 'Postgraduate masters programmes offering advanced specialization and research opportunities in computer science.',
                'icon'        => 'fa-solid fa-award',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
            [
                'name'        => 'PhD',
                'slug'        => 'phd',
                'description' => 'Doctor of Philosophy programmes focused on original research contributions and academic excellence.',
                'icon'        => 'fa-solid fa-flask',
                'sort_order'  => 4,
                'is_active'   => true,
            ],
            [
                'name'        => 'Doctorate',
                'slug'        => 'doctorate',
                'description' => 'Professional doctorate programmes combining advanced academic study with practical application in industry and leadership.',
                'icon'        => 'fa-solid fa-user-graduate',
                'sort_order'  => 5,
                'is_active'   => true,
            ],
        ];

        foreach ($categories as $category) {
            ProgrammeCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
