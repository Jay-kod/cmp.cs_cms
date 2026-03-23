<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\MediaOptimizationController;
use App\Http\Controllers\SuperAdmin\MediaOptimizationController as SuperAdminMediaOptimizationController;
use App\Jobs\OptimizeImageToWebpJob;
use App\Models\MediaDerivative;
use App\Models\MediaFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MediaDashboardSmokeTestCommand extends Command
{
    protected $signature = 'media:dashboard-smoke-test
        {--derivative-width=320 : Which derivative width to toggle for the requeue test}';

    protected $description = 'Verify media optimization dashboards are DB-driven and requeue manipulates data.';

    public function handle(): int
    {
        $width = (int) $this->option('derivative-width');
        if ($width <= 0) {
            $width = 320;
        }

        $mediaFile = MediaFile::query()->where('type', 'image')->orderByDesc('id')->first();
        if (! $mediaFile) {
            $this->error('No media_files[type=image] found.');
            return self::FAILURE;
        }

        $this->info("Using media_file_id={$mediaFile->id} original={$mediaFile->original_path}");

        $counts = MediaFile::query()
            ->where('type', 'image')
            ->select('status')
            ->get()
            ->groupBy('status')
            ->map(fn($group) => $group->count());

        $this->line('media_files status counts: ' . $counts->map(fn($c, $k) => "{$k}={$c}")->implode(', '));

        // 1) Confirm dashboards read from DB (controller index -> view data).
        $adminView = app(MediaOptimizationController::class)->index();
        $adminData = $adminView->getData();
        $adminStatusCounts = $adminData['statusCounts'] ?? collect();
        $this->line('admin dashboard statusCounts keys: ' . $adminStatusCounts->keys()->implode(','));

        $superView = app(SuperAdminMediaOptimizationController::class)->index();
        $superData = $superView->getData();
        $superStatusCounts = $superData['statusCounts'] ?? collect();
        $this->line('super-admin dashboard statusCounts keys: ' . $superStatusCounts->keys()->implode(','));

        $lastConvertedAt = MediaDerivative::query()
            ->where('format', 'webp')
            ->where('status', 'ready')
            ->max('updated_at');

        $this->line('last webp conversion (ready): ' . ($lastConvertedAt ? $lastConvertedAt : '—'));

        $lastFailedAt = MediaDerivative::query()
            ->where('format', 'webp')
            ->where('status', 'failed')
            ->max('updated_at');

        $this->line('last webp failure (failed): ' . ($lastFailedAt ? $lastFailedAt : '—'));

        // 2) Simulate dashboard requeue for this media_file by running the job.
        $derivative = MediaDerivative::query()
            ->where('media_file_id', $mediaFile->id)
            ->where('format', 'webp')
            ->where('width', $width)
            ->first();

        if (! $derivative) {
            $this->error("No existing webp derivative row found for width={$width}. Requeue test cannot proceed.");
            return self::FAILURE;
        }

        $this->line("Before: derivative width={$width} status={$derivative->status}");
        $derivative->update(['status' => 'pending', 'error_message' => null]);

        $job = new OptimizeImageToWebpJob($mediaFile->id);
        $job->handle();

        $derivative->refresh();
        $this->line("After: derivative width={$width} status={$derivative->status}");

        $fullPath = Storage::disk('public')->path($derivative->path);
        $exists = is_file($fullPath);
        $this->line("Derivative file exists: " . ($exists ? 'yes' : 'no') . " ({$derivative->path})");

        if ($derivative->status !== 'ready' || ! $exists) {
            $this->error('Requeue manipulation test failed.');
            return self::FAILURE;
        }

        $this->info('Dashboard smoke-test passed.');
        return self::SUCCESS;
    }
}

