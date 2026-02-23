<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NacosPresident;
use Illuminate\Support\Facades\Storage;

class NacosPresidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presidents = NacosPresident::orderBy('tenure_end', 'desc')->get();
        return view('admin.nacos-presidents.index', compact('presidents'));
    }

    public function create()
    {
        $president = new NacosPresident();
        return view('admin.nacos-presidents.form', compact('president'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'tenure_start' => 'nullable|string|max:50',
            'tenure_end' => 'nullable|string|max:50',
            'current_status' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('nacos-presidents', 'public');
        }

        NacosPresident::create($data);

        return redirect()->route('admin.nacos-presidents.index')
            ->with('success', 'President added successfully.');
    }

    public function edit(NacosPresident $nacos_president)
    {
        $president = $nacos_president; // matching route binding name
        return view('admin.nacos-presidents.form', compact('president'));
    }

    public function update(Request $request, NacosPresident $nacos_president)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'tenure_start' => 'nullable|string|max:50',
            'tenure_end' => 'nullable|string|max:50',
            'current_status' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($nacos_president->photo) {
                Storage::disk('public')->delete($nacos_president->photo);
            }
            $data['photo'] = $request->file('photo')->store('nacos-presidents', 'public');
        }

        $nacos_president->update($data);

        return redirect()->route('admin.nacos-presidents.index')
            ->with('success', 'President updated successfully.');
    }

    public function destroy(NacosPresident $nacos_president)
    {
        if ($nacos_president->photo) {
            Storage::disk('public')->delete($nacos_president->photo);
        }
        $nacos_president->delete();

        return back()->with('success', 'President deleted successfully.');
    }
}
