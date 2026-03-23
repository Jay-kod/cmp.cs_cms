<?php

namespace Tests\Feature;

use App\Jobs\OptimizeImageToWebpJob;
use App\Models\MediaDerivative;
use App\Models\MediaFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaIntegrityCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_ready_derivative_missing_file_is_reset_and_requeued(): void
    {
        Storage::fake('public');
        Queue::fake();

        $mediaFile = MediaFile::create([
            'type' => 'image',
            'original_path' => 'tests/original-example.jpg',
            'status' => 'ready',
        ]);

        $derivative = MediaDerivative::create([
            'media_file_id' => $mediaFile->id,
            'format' => 'webp',
            'width' => 320,
            'path' => "media/{$mediaFile->id}/webp/320/example-320.webp",
            'status' => 'ready',
            'error_message' => null,
        ]);

        $this->artisan('media:integrity-check', [
            '--status' => 'ready',
        ])->assertExitCode(0);

        $this->assertDatabaseHas('media_derivatives', [
            'id' => $derivative->id,
            'status' => 'pending',
            'error_message' => null,
        ]);

        Queue::assertPushedOn('media-optimization', OptimizeImageToWebpJob::class, function ($job) use ($mediaFile) {
            return $job->mediaFileId === $mediaFile->id;
        });
    }

    public function test_ready_derivative_existing_file_is_not_changed_or_requeued(): void
    {
        Storage::fake('public');
        Queue::fake();

        $mediaFile = MediaFile::create([
            'type' => 'image',
            'original_path' => 'tests/original-example.jpg',
            'status' => 'ready',
        ]);

        $derivativePath = "media/{$mediaFile->id}/webp/320/example-320.webp";

        Storage::disk('public')->put($derivativePath, 'dummy-webp-content');

        $derivative = MediaDerivative::create([
            'media_file_id' => $mediaFile->id,
            'format' => 'webp',
            'width' => 320,
            'path' => $derivativePath,
            'status' => 'ready',
            'error_message' => 'previous error',
        ]);

        $this->artisan('media:integrity-check', [
            '--status' => 'ready',
        ])->assertExitCode(0);

        $this->assertDatabaseHas('media_derivatives', [
            'id' => $derivative->id,
            'status' => 'ready',
            'error_message' => 'previous error',
        ]);

        Queue::assertNotPushed(OptimizeImageToWebpJob::class);
    }
}

