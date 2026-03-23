<?php

namespace App\Console\Commands;

use App\Jobs\OptimizeImageToWebpJob;
use App\Models\MediaDerivative;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaDerivativeIntegrityCheckCommand extends Command
{
    protected $signature = 'media:integrity-check
        {--status=ready : ready|processing|all}
        {--dry-run : no DB updates or requeue}';

    protected $description = 'Detect missing WebP derivative files and optionally auto-heal by resetting status + requeue.';

    public function handle(): int
    {
        $statusOpt = strtolower(trim((string) $this->option('status')));
        $dryRun = (bool) $this->option('dry-run');

        if (! in_array($statusOpt, ['ready', 'processing', 'all'], true)) {
            $this->error("Invalid --status value: {$statusOpt}. Use ready|processing|all.");
            return self::FAILURE;
        }

        $statusList = match ($statusOpt) {
            'ready' => ['ready'],
            'processing' => ['processing'],
            'all' => ['ready', 'processing'],
        };

        $disk = Storage::disk('public');

        $checked = 0;
        $missingTotal = 0;
        $missingReady = 0;
        $missingProcessing = 0;

        $missingMediaFileIds = [];

        MediaDerivative::query()
            ->where('format', 'webp')
            ->whereIn('status', $statusList)
            ->select(['id', 'media_file_id', 'status', 'path'])
            ->orderByDesc('id')
            ->chunkById(200, function ($chunk) use (&$checked, &$missingTotal, &$missingReady, &$missingProcessing, &$missingMediaFileIds, $dryRun, $disk) {
                foreach ($chunk as $derivative) {
                    /** @var \App\Models\MediaDerivative $derivative */
                    $checked++;

                    $relativePath = ltrim((string) $derivative->path, '/');
                    // `exists()` works with both local disk and Storage fakes.
                    if (! $disk->exists($relativePath)) {
                        $missingTotal++;

                        if ($derivative->status === 'ready') {
                            $missingReady++;
                        } else {
                            $missingProcessing++;
                        }

                        $missingMediaFileIds[] = (int) $derivative->media_file_id;

                        if (! $dryRun) {
                            $derivative->status = 'pending';
                            $derivative->error_message = null;
                            $derivative->save();
                        }
                    }
                }
            });

        $missingMediaFileIds = array_values(array_unique($missingMediaFileIds));

        if (! $dryRun && count($missingMediaFileIds) > 0) {
            foreach ($missingMediaFileIds as $mediaFileId) {
                OptimizeImageToWebpJob::dispatch($mediaFileId)
                    ->onQueue('media-optimization');
            }
        }

        $this->info("Media derivative integrity check completed.");
        $this->line("Checked: {$checked}");
        $this->line("Missing derivatives: {$missingTotal} (ready={$missingReady}, processing={$missingProcessing})");
        $this->line('Dry-run: ' . ($dryRun ? 'yes' : 'no'));
        $this->line('Requeued media_file_ids: ' . (! $dryRun ? count($missingMediaFileIds) : 0));

        return self::SUCCESS;
    }
}

