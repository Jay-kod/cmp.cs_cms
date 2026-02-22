<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExternalSystem;
use Illuminate\Http\Request;

class ExternalSystemController extends Controller
{
    public function index()
    {
        $systems = ExternalSystem::ordered()->get();
        return view('admin.external-systems.index', compact('systems'));
    }

    public function create()
    {
        return view('admin.external-systems.form', [
            'system' => null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:500',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'open_in_new_tab' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['open_in_new_tab'] = $request->has('open_in_new_tab');
        $validated['icon'] = $validated['icon'] ?: 'fa-solid fa-arrow-up-right-from-square';

        ExternalSystem::create($validated);

        return redirect()->route('admin.external-systems.index')
            ->with('success', 'External system added successfully.');
    }

    public function edit(ExternalSystem $externalSystem)
    {
        return view('admin.external-systems.form', [
            'system' => $externalSystem,
        ]);
    }

    public function update(Request $request, ExternalSystem $externalSystem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:500',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'open_in_new_tab' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['open_in_new_tab'] = $request->has('open_in_new_tab');
        $validated['icon'] = $validated['icon'] ?: 'fa-solid fa-arrow-up-right-from-square';

        $externalSystem->update($validated);

        return redirect()->route('admin.external-systems.index')
            ->with('success', 'External system updated successfully.');
    }

    public function destroy(ExternalSystem $externalSystem)
    {
        $externalSystem->delete();

        return redirect()->route('admin.external-systems.index')
            ->with('success', 'External system deleted successfully.');
    }
}
