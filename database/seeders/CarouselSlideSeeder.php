<?php

namespace Database\Seeders;

use App\Models\CarouselSlide;
use Illuminate\Database\Seeder;

class CarouselSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Empowering the Future of Computing',
                'subtitle' => 'Discover world-class education, pioneering research, and a community dedicated to solving global challenges through technology.',
                'button_text' => 'Explore Department',
                'button_url' => '/about',
                'image' => 'carousel/slide-1.jpg',
                'overlay_color' => 'rgba(0,60,30,0.55)',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Department of Computer Science',
                'subtitle' => 'Faculty of Natural & Applied Sciences, Nasarawa State University, Keffi — Bridging the Digital Divide in an Emerging Economy.',
                'button_text' => 'View Programmes',
                'button_url' => '/academics',
                'image' => 'carousel/slide-2.jpg',
                'overlay_color' => 'rgba(0,50,30,0.6)',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'A Community of Innovation',
                'subtitle' => 'Learn, collaborate, and grow in an environment built for the next generation of tech professionals and thought leaders.',
                'button_text' => 'Meet Our Team',
                'button_url' => '/people',
                'image' => 'carousel/slide-3.jpg',
                'overlay_color' => 'rgba(0,40,20,0.55)',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            CarouselSlide::updateOrCreate(
                ['sort_order' => $slide['sort_order']],
                $slide
            );
        }
    }
}
