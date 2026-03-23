<?php

namespace App\Services;

use App\Jobs\OptimizeImageToWebpJob;
use App\Models\MediaFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaOptimizationService
{
    /**
     * Create a media record and enqueue WebP optimization (3 sizes) in the background.
     */
    public function enqueueImageToWebp(string $publicRelativePath, ?string $mimeType = null, ?int $uploadedBy = null): MediaFile
    {
        $disk = Storage::disk('public');
        $fullPath = $disk->path($publicRelativePath);
        $originalPath = ltrim($publicRelativePath, '/');

        $checksum = null;
        try {
            if (is_file($fullPath)) {
                $checksum = hash_file('sha256', $fullPath);
            }
        } catch (\Throwable $e) {
            // Checksum is only for reporting/backfill; conversion can still proceed.
            $checksum = null;
        }

        if ($uploadedBy === null) {
            $uploadedBy = Auth::id();
        }

        $mimeType = $mimeType ?: null;

        // Idempotency: reuse an existing media_file for the same original image path.
        $mediaFile = MediaFile::query()
            ->where('type', 'image')
            ->where('original_path', $originalPath)
            ->latest('id')
            ->first();

        if (! $mediaFile) {
            $mediaFile = MediaFile::create([
                'type' => 'image',
                'mime_type' => $mimeType,
                'size_bytes' => is_file($fullPath) ? (int) filesize($fullPath) : null,
                'original_path' => $originalPath,
                'checksum_sha256' => $checksum,
                'status' => 'pending',
                'error_message' => null,
                'uploaded_by' => $uploadedBy,
            ]);
        } else {
            // Opportunistically fill missing metadata.
            $updates = [];
            if ($mediaFile->mime_type === null && $mimeType) {
                $updates['mime_type'] = $mimeType;
            }
            if ($mediaFile->size_bytes === null && is_file($fullPath)) {
                $updates['size_bytes'] = (int) filesize($fullPath);
            }
            if ($mediaFile->checksum_sha256 === null && $checksum) {
                $updates['checksum_sha256'] = $checksum;
            }

            if (! empty($updates)) {
                $mediaFile->update($updates);
            }
        }

        // Queue conversion; job itself is idempotent per-width/ready derivatives.
        OptimizeImageToWebpJob::dispatch($mediaFile->id)->onQueue('media-optimization');

        return $mediaFile;
    }

    /**
     * Used by the image views: return a derivative WebP URL when ready, else fall back to the original.
     */
    public function webpOrOriginalUrl(string $publicRelativePath, int $width): string
    {
        $disk = Storage::disk('public');
        $originalPath = ltrim($publicRelativePath, '/');

        // Cache result aggressively; when conversions complete we can safely bump the TTL.
        $cacheKey = "media:webp_or_original:{$width}:" . $originalPath;

        $cached = cache()->get($cacheKey);
        if (is_string($cached) && $cached !== '') {
            return $cached;
        }

        $mediaFile = MediaFile::query()
            ->where('type', 'image')
            ->where('original_path', $originalPath)
            ->orderByDesc('id')
            ->first();

        if (! $mediaFile) {
            $value = asset('storage/' . $originalPath);
            cache()->put($cacheKey, $value, now()->addMinute());
            return $value;
        }

        $derivative = $mediaFile->derivatives()
            ->where('format', 'webp')
            ->where('width', $width)
            ->where('status', 'ready')
            ->first();

        if (! $derivative) {
            $value = asset('storage/' . $originalPath);
            cache()->put($cacheKey, $value, now()->addMinute());
            return $value;
        }

        $value = asset('storage/' . ltrim($derivative->path, '/'));
        cache()->put($cacheKey, $value, now()->addMinutes(60));

        return $value;
    }
}

