<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\OptimizeImageToWebpJob;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('admin.media-optimization.index', [
            'statusCounts' => $statusCounts,
            'mediaFiles' => $mediaFiles,
        ]);
    }

    public function requeue(MediaFile $mediaFile)
    {
        if ($mediaFile->type !== 'image') {
            abort(404);
        }

        OptimizeImageToWebpJob::dispatch($mediaFile->id)->onQueue('media-optimization');

        return back()->with('success', 'WebP optimization job re-queued.');
    }
}

