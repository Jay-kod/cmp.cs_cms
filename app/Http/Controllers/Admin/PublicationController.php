<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\Staff;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::with('staff')
            ->orderByDesc('year')
            ->orderByDesc('created_at')
            ->paginate(20);
        return view('admin.publications.index', compact('publications'));
    }

    public function create()
    {
        $staff = Staff::orderBy('name')->get();
        return view('admin.publications.form', ['publication' => new Publication(), 'staff' => $staff]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'title' => 'required|string',
            'journal' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'doi' => 'nullable|string|max:255',
            'type' => 'nullable|string|in:journal,conference,book,chapter',
            'abstract' => 'nullable|string',
            'url' => 'nullable|url|max:500',
        ]);

        Publication::create($data);

        return redirect()->route('admin.publications.index')
            ->with('success', 'Publication added successfully.');
    }

    public function edit(Publication $publication)
    {
        $staff = Staff::orderBy('name')->get();
        return view('admin.publications.form', compact('publication', 'staff'));
    }

    public function update(Request $request, Publication $publication)
    {
        $data = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'title' => 'required|string',
            'journal' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'doi' => 'nullable|string|max:255',
            'type' => 'nullable|string|in:journal,conference,book,chapter',
            'abstract' => 'nullable|string',
            'url' => 'nullable|url|max:500',
        ]);

        $publication->update($data);

        return redirect()->route('admin.publications.index')
            ->with('success', 'Publication updated successfully.');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('admin.publications.index')
            ->with('success', 'Publication deleted successfully.');
    }
}
