<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PastHod;
use Illuminate\Support\Facades\Storage;
use App\Services\MediaOptimizationService;

class PastHodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hods = PastHod::orderBy('tenure_end', 'desc')->get();
        return view('admin.past-hods.index', compact('hods'));
    }

    public function create()
    {
        $hod = new PastHod();
        return view('admin.past-hods.form', compact('hod'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_current' => 'nullable|boolean',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'rank' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string|max:255',
            'area_of_specialization' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'tenure_start' => 'nullable|string|max:50',
            'tenure_end' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $data['is_current'] = $request->has('is_current') ? true : false;
        if ($data['is_current']) {
            PastHod::query()->update(['is_current' => false]);
        }

        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $data['photo'] = $photoFile->store('past-hods', 'public');

            // Enqueue WebP optimization in the background.
            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['photo'],
                $photoFile->getClientMimeType()
            );
        }

        PastHod::create($data);

        return redirect()->route('admin.past-hods.index')
            ->with('success', 'HOD added successfully.');
    }

    public function edit(PastHod $past_hod)
    {
        $hod = $past_hod;
        return view('admin.past-hods.form', compact('hod'));
    }

    public function update(Request $request, PastHod $past_hod)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_current' => 'nullable|boolean',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'rank' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string|max:255',
            'area_of_specialization' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'tenure_start' => 'nullable|string|max:50',
            'tenure_end' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $data['is_current'] = $request->has('is_current') ? true : false;
        if ($data['is_current']) {
            PastHod::where('id', '!=', $past_hod->id)->update(['is_current' => false]);
        }

        if ($request->hasFile('photo')) {
            if ($past_hod->photo) {
                Storage::disk('public')->delete($past_hod->photo);
            }
            $photoFile = $request->file('photo');
            $data['photo'] = $photoFile->store('past-hods', 'public');

            // Enqueue WebP optimization in the background.
            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['photo'],
                $photoFile->getClientMimeType()
            );
        }

        $past_hod->update($data);

        return redirect()->route('admin.past-hods.index')
            ->with('success', 'HOD updated successfully.');
    }

    public function destroy(PastHod $past_hod)
    {
        if ($past_hod->photo) {
            Storage::disk('public')->delete($past_hod->photo);
        }
        $past_hod->delete();

        return back()->with('success', 'HOD deleted successfully.');
    }
}
