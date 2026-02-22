<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PastHod;
use Illuminate\Support\Facades\Storage;

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
            'tenure_start' => 'nullable|string|max:50',
            'tenure_end' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('past-hods', 'public');
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
            'tenure_start' => 'nullable|string|max:50',
            'tenure_end' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($past_hod->photo) {
                Storage::disk('public')->delete($past_hod->photo);
            }
            $data['photo'] = $request->file('photo')->store('past-hods', 'public');
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
