<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::orderBy('graduation_year', 'desc')->orderBy('name')->paginate(20);
        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.alumni.form', ['alumnus' => new Alumni()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1990|max:'.(date('Y') + 1),
            'programme' => 'required|string|max:255',
            'employer' => 'nullable|string|max:255',
            'current_role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('public/alumni_photos');
            $data['photo'] = str_replace('public/', '', $data['photo']);
        }

        Alumni::create($data);
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni record added successfully.');
    }

    public function edit(Alumni $alumnus)
    {
        return view('admin.alumni.form', compact('alumnus'));
    }

    public function update(Request $request, Alumni $alumnus)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1990|max:'.(date('Y') + 1),
            'programme' => 'required|string|max:255',
            'employer' => 'nullable|string|max:255',
            'current_role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            if($alumnus->photo) Storage::delete('public/'.$alumnus->photo);
            $data['photo'] = $request->file('photo')->store('public/alumni_photos');
            $data['photo'] = str_replace('public/', '', $data['photo']);
        }

        $alumnus->update($data);
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni record updated successfully.');
    }

    public function destroy(Alumni $alumnus)
    {
        if($alumnus->photo) Storage::delete('public/'.$alumnus->photo);
        $alumnus->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni record deleted successfully.');
    }
}
