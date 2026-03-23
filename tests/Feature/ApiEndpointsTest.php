<?php

namespace Tests\Feature;

use App\Models\DepartmentSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_api_rejects_query_over_100_characters(): void
    {
        $response = $this->getJson('/api/search?q=' . str_repeat('a', 101));

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['q']);
    }

    public function test_search_api_returns_page_matches_for_valid_query(): void
    {
        $response = $this->getJson('/api/search?q=about');

        $response
            ->assertOk()
            ->assertJsonStructure(['results'])
            ->assertJsonFragment([
                'title' => 'About Us',
                'type' => 'Page',
                'url' => '/about',
            ]);
    }

    public function test_content_updated_api_returns_ts_and_updated_at_from_database(): void
    {
        DepartmentSetting::create([
            'key' => 'api_test_setting',
            'value' => 'ok',
            'group' => 'tests',
        ]);

        $response = $this->getJson('/api/content-updated');

        $response
            ->assertOk()
            ->assertJsonStructure(['updated_at', 'ts']);

        $data = $response->json();

        $this->assertNotEmpty($data['updated_at']);
        $this->assertIsInt($data['ts']);
        $this->assertGreaterThan(0, $data['ts']);
    }
}

