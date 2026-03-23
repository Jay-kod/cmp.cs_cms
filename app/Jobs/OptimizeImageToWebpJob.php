<?php

namespace App\Jobs;

use App\Models\MediaDerivative;
use App\Models\MediaFile;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OptimizeImageToWebpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;

    public function __construct(public int $mediaFileId)
    {
    }

    public function handle(): void
    {
        $mediaFile = MediaFile::query()->find($this->mediaFileId);
        if (! $mediaFile) {
            return;
        }

        if ($mediaFile->type !== 'image') {
            $mediaFile->update([
                'status' => 'failed',
                'error_message' => "OptimizeImageToWebpJob only supports type=image.",
            ]);
            return;
        }

        $widths = [320, 640, 1024];

        $disk = Storage::disk('public');
        $originalRelativePath = ltrim($mediaFile->original_path, '/');
        $originalFullPath = $disk->path($originalRelativePath);

        if (! is_file($originalFullPath)) {
            $mediaFile->update([
                'status' => 'failed',
                'error_message' => "Original file not found: {$originalRelativePath}",
            ]);
            return;
        }

        // If all 3 derivatives are already ready, do nothing.
        $readyCount = MediaDerivative::query()
            ->where('media_file_id', $mediaFile->id)
            ->where('format', 'webp')
            ->where('width', '!=', null)
            ->whereIn('width', $widths)
            ->where('status', 'ready')
            ->count();

        if ($readyCount === count($widths)) {
            return;
        }

        $mediaFile->update([
            'status' => 'processing',
            'error_message' => null,
        ]);

        $baseName = pathinfo($originalRelativePath, PATHINFO_FILENAME);
        $quality = 80;
        $hadFailure = false;
        $failureReasons = [];

        foreach ($widths as $width) {
            $derivative = MediaDerivative::query()->firstOrNew([
                'media_file_id' => $mediaFile->id,
                'format' => 'webp',
                'width' => $width,
            ]);

            if ($derivative->exists && $derivative->status === 'ready') {
                continue;
            }

            $outRelativePath = "media/{$mediaFile->id}/webp/{$width}/{$baseName}.webp";
            $outFullPath = $disk->path($outRelativePath);
            $outDir = dirname($outFullPath);

            try {
                if (! is_dir($outDir)) {
                    mkdir($outDir, 0755, true);
                }

                [$dstW, $dstH, $gd] = $this->createResizedGdResource($originalFullPath, $width);

                $saved = imagewebp($gd, $outFullPath, $quality);

                imagedestroy($gd);

                if (! $saved) {
                    throw new Exception("imagewebp failed to save output for width={$width}");
                }

                $derivative->fill([
                    'status' => 'ready',
                    'path' => $outRelativePath,
                    'error_message' => null,
                ])->save();
            } catch (\Throwable $e) {
                $hadFailure = true;
                $reason = $e->getMessage();
                $failureReasons[] = "width={$width}: {$reason}";

                Log::warning('Media optimize to webp failed', [
                    'media_file_id' => $mediaFile->id,
                    'original_path' => $originalRelativePath,
                    'width' => $width,
                    'error' => $reason,
                ]);

                $derivative->fill([
                    'status' => 'failed',
                    'error_message' => $reason,
                ])->save();
            }
        }

        // Mark aggregate status.
        $allReady = MediaDerivative::query()
            ->where('media_file_id', $mediaFile->id)
            ->where('format', 'webp')
            ->whereIn('width', $widths)
            ->where('status', 'ready')
            ->count() === count($widths);

        if ($allReady) {
            $mediaFile->update([
                'status' => 'ready',
                'error_message' => null,
            ]);
        } elseif ($hadFailure) {
            $mediaFile->update([
                'status' => 'failed',
                'error_message' => implode(' | ', $failureReasons),
            ]);
        } else {
            // Partial progress (some widths existed already as ready)
            $mediaFile->update([
                'status' => 'pending',
                'error_message' => null,
            ]);
        }
    }

    /**
     * Load the original image into GD and resize it to the target width while preserving aspect ratio.
     *
     * @return array{0:int,1:int,2:resource}
     */
    private function createResizedGdResource(string $originalFullPath, int $targetWidth): array
    {
        if (! function_exists('imagewebp')) {
            throw new Exception('GD imagewebp() is not available in this PHP runtime.');
        }

        $type = @exif_imagetype($originalFullPath);
        if (! $type) {
            throw new Exception('Unable to detect input image type.');
        }

        switch ($type) {
            case IMAGETYPE_JPEG:
                $src = imagecreatefromjpeg($originalFullPath);
                break;
            case IMAGETYPE_PNG:
                $src = imagecreatefrompng($originalFullPath);
                break;
            case IMAGETYPE_GIF:
                $src = imagecreatefromgif($originalFullPath);
                break;
            case IMAGETYPE_WEBP:
                $src = imagecreatefromwebp($originalFullPath);
                break;
            default:
                throw new Exception("Unsupported image type code: {$type}");
        }

        if (! $src) {
            throw new Exception('Failed to load source image into GD.');
        }

        $srcW = imagesx($src);
        $srcH = imagesy($src);

        if ($srcW <= 0 || $srcH <= 0) {
            imagedestroy($src);
            throw new Exception('Invalid source dimensions.');
        }

        $targetWidth = max(1, $targetWidth);
        $ratio = $targetWidth / $srcW;
        $targetHeight = (int) max(1, round($srcH * $ratio));

        $dst = imagecreatetruecolor($targetWidth, $targetHeight);

        // Preserve alpha channel for PNG/GIF when possible.
        if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_GIF) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        }

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $targetWidth, $targetHeight, $srcW, $srcH);

        imagedestroy($src);

        return [$targetWidth, $targetHeight, $dst];
    }
}

