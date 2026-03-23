<?php

namespace App\Console\Commands;

use App\Models\MediaFile;
use App\Services\MediaOptimizationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaBackfillWebpCommand extends Command
{
    protected $signature = 'media:backfill-webp
        {--limit=0 : Max number of original images to process (0 = no limit)}
        {--skip-ready=1 : Skip originals where derivatives are already marked ready}
        {--dry-run : Do not dispatch conversions; only report what would be done}';

    protected $description = 'Backfill WebP derivatives (320/640/1024) for existing uploaded images.';

    public function handle(): int
    {
        $limit = (int) $this->option('limit');
        $skipReady = (bool) $this->option('skip-ready');
        $dryRun = (bool) $this->option('dry-run');

        $disk = Storage::disk('public');
        $rootPath = $disk->path('');

        if (! is_dir($rootPath)) {
            $this->error("Storage public root not found: {$rootPath}");
            return self::FAILURE;
        }

        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $processed = 0;
        $queued = 0;
        $skipped = 0;

        $directoryIterator = new \RecursiveDirectoryIterator(
            $rootPath,
            \FilesystemIterator::SKIP_DOTS
        );
        $iterator = new \RecursiveIteratorIterator($directoryIterator);

        foreach ($iterator as $file) {
            /** @var \SplFileInfo $file */
            if (! $file->isFile()) {
                continue;
            }

            $fullPath = $file->getPathname();
            $ext = strtolower($file->getExtension());
            if (! in_array($ext, $extensions, true)) {
                continue;
            }

            // Compute relative path inside the disk.
            $relativePath = str_replace($rootPath, '', $fullPath);
            $relativePath = ltrim(str_replace('\\', '/', $relativePath), '/');

            // Avoid converting our own derivatives again (prevents endless media/media recursion).
            if (Str::startsWith($relativePath, 'media/')) {
                continue;
            }

            if ($limit > 0 && $processed >= $limit) {
                break;
            }

            $processed++;

            if ($skipReady) {
                $media = MediaFile::query()
                    ->where('type', 'image')
                    ->where('original_path', $relativePath)
                    ->first();

                if ($media && $media->status === 'ready') {
                    $skipped++;
                    continue;
                }
            }

            if ($dryRun) {
                $this->line("[dry-run] Would enqueue: {$relativePath}");
                $queued++;
                continue;
            }

            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $relativePath,
                null,
                null
            );

            $queued++;

            // Progress output every 25 items.
            if ($queued % 25 === 0) {
                $this->info("Progress: queued={$queued}, skipped={$skipped}, processed={$processed}");
            }
        }

        $this->info("Backfill complete: queued={$queued}, skipped={$skipped}, processed={$processed}.");

        return self::SUCCESS;
    }
}

