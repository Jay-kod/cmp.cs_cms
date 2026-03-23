<?php

namespace Tests\Feature;

use App\Models\MediaDerivative;
use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardMediaAnalysisTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_media_analysis_panel_from_database(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        $media = MediaFile::create([
            'type' => 'image',
            'original_path' => 'tests/example.jpg',
            'status' => 'ready',
        ]);

        MediaDerivative::create([
            'media_file_id' => $media->id,
            'format' => 'webp',
            'width' => 320,
            'path' => 'media/tests/example-320.webp',
            'status' => 'ready',
        ]);

        $response = $this->actingAs($admin, 'web')->get('/admin');

        $response
            ->assertOk()
            ->assertSee('Media Optimization (WebP)')
            ->assertSee('Last WebP Conversion')
            ->assertSee('Failed');
    }

    public function test_super_admin_dashboard_shows_media_analysis_panel_from_database(): void
    {
        $superAdmin = User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
            'email_verified_at' => now(),
        ]);

        $media = MediaFile::create([
            'type' => 'image',
            'original_path' => 'tests/example-super.jpg',
            'status' => 'ready',
        ]);

        MediaDerivative::create([
            'media_file_id' => $media->id,
            'format' => 'webp',
            'width' => 640,
            'path' => 'media/tests/example-super-640.webp',
            'status' => 'ready',
        ]);

        $response = $this->actingAs($superAdmin, 'super_admin')->get('/super-admin');

        $response
            ->assertOk()
            ->assertSee('Media Optimization (WebP)')
            ->assertSee('Last WebP Conversion')
            ->assertSee('Failed');
    }
}

