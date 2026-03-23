<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\MediaOptimizationService;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.form', ['partner' => new Partner()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $data['logo'] = $logoFile->store('partners', 'public');

            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['logo'],
                $logoFile->getClientMimeType()
            );
        }

        if(!$request->has('is_active')) $data['is_active'] = false;
        if(!$request->has('sort_order')) $data['sort_order'] = 0;

        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner added successfully.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.form', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('logo')) {
            if ($partner->logo) Storage::disk('public')->delete($partner->logo);
            $logoFile = $request->file('logo');
            $data['logo'] = $logoFile->store('partners', 'public');

            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['logo'],
                $logoFile->getClientMimeType()
            );
        }

        if(!$request->has('is_active')) $data['is_active'] = false;
        if(!$request->has('sort_order')) $data['sort_order'] = 0;

        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) Storage::disk('public')->delete($partner->logo);
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }
}
