<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
            DepartmentSeeder::class,
            ProgrammeCategorySeeder::class,
            PageSeeder::class,
            ExternalSystemSeeder::class,
            SocialLinkSeeder::class,
            CarouselSlideSeeder::class,
            HomepageSampleSeeder::class,
            ResourceCategorySeeder::class,
        ]);
    }
}
