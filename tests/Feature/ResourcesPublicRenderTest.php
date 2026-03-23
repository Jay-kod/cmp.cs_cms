<?php

namespace Tests\Feature;

use Database\Seeders\ResourceCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourcesPublicRenderTest extends TestCase
{
    use RefreshDatabase;

    public function test_resources_page_renders_categories_and_timetable_empty_state(): void
    {
        $this->seed(ResourceCategorySeeder::class);

        $response = $this->get('/resources');

        $response
            ->assertOk()
            ->assertSee('Department Timetable')
            ->assertSee('No timetable uploaded yet')
            ->assertSee('Department Handbook')
            ->assertSee('Rules & Regulations')
            ->assertSee('Forms & Documents');
    }
}

