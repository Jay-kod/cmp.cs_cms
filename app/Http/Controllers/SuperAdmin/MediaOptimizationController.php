<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Jobs\OptimizeImageToWebpJob;
use App\Models\MediaFile;
use Illuminate\Support\Facades\DB;
use Throwable;

class MediaOptimizationController extends Controller
{
    public function index()
    {
        $statusCounts = MediaFile::query()
            ->select('status', DB::raw('count(*) as total'))
            ->where('type', 'image')
            ->groupBy('status')
            ->pluck('total', 'status');

        $mediaFiles = MediaFile::query()
            ->where('type', 'image')
            ->with(['derivatives' => fn($q) => $q->where('format', 'webp')])
            ->orderByDesc('id')
            ->take(50)
            ->get();

        return view('super-admin.media-optimization.index', [
            'statusCounts' => $statusCounts,
            'mediaFiles' => $mediaFiles,
        ]);
    }

    public function requeue(MediaFile $mediaFile)
    {
        if ($mediaFile->type !== 'image') {
            abort(404);
        }

        // Requeue a single media file from the super-admin dashboard.
        OptimizeImageToWebpJob::dispatch($mediaFile->id)->onQueue('media-optimization');

        return back()->with('success', 'WebP optimization job re-queued.');
    }

    public function requeueAllNonReady()
    {
        $nonReadyStatuses = ['pending', 'processing', 'failed'];

        MediaFile::query()
            ->where('type', 'image')
            ->whereIn('status', $nonReadyStatuses)
            ->orderByDesc('id')
            ->chunkById(100, function ($chunk) {
                foreach ($chunk as $mediaFile) {
                    OptimizeImageToWebpJob::dispatch($mediaFile->id)->onQueue('media-optimization');
                }
            });

        return back()->with('success', 'Re-queued all non-ready image optimizations.');
    }
}

