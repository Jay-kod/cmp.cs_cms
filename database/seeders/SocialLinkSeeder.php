<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'name' => 'Facebook',
                'url' => '#',
                'icon' => 'fa-brands fa-facebook-f',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Twitter / X',
                'url' => '#',
                'icon' => 'fa-brands fa-x-twitter',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'LinkedIn',
                'url' => '#',
                'icon' => 'fa-brands fa-linkedin-in',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'YouTube',
                'url' => '#',
                'icon' => 'fa-brands fa-youtube',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(
                ['name' => $link['name']],
                $link
            );
        }
    }
}
