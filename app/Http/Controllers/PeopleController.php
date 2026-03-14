<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $hod = Staff::where('is_hod', true)->with('courses')->first();

        $query = Staff::orderByDesc('is_hod')->orderBy('sort_order');

        // Search filter
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('rank', 'like', "%{$search}%")
                  ->orWhere('specialisation', 'like', "%{$search}%")
                  ->orWhere('qualifications', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $staff = $query->with('courses')->get();

        return view('pages.people.index', compact('hod', 'staff'));
    }

    public function search(Request $request)
    {
        $query = Staff::orderByDesc('is_hod')->orderBy('sort_order');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('rank', 'like', "%{$search}%")
                  ->orWhere('specialisation', 'like', "%{$search}%")
                  ->orWhere('qualifications', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $staff = $query->with('courses')->get();
        $hod = Staff::where('is_hod', true)->first();
        $isFiltering = $request->query('search') || $request->query('status');

        return response()->json([
            'staff' => $staff->map(function ($member) use ($hod, $isFiltering) {
                $skipAsHod = $hod && $member->id === $hod->id && !$isFiltering;
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'title' => $member->title,
                    'rank' => $member->rank,
                    'status' => $member->status,
                    'specialisation' => $member->specialisation,
                    'slug' => $member->slug,
                    'photo' => $member->photo ? asset('storage/' . $member->photo) : null,
                    'is_hod' => (bool) $member->is_hod,
                    'skip_as_hod' => $skipAsHod,
                    'courses' => $member->courses->map(fn($c) => ['code' => $c->code]),
                    'profile_url' => route('people.show', $member->slug),
                ];
            }),
            'count' => $staff->count(),
        ]);
    }

    public function show($slug)
    {
        $staff = Staff::where('slug', $slug)
            ->with(['publications' => fn($q) => $q->orderByDesc('year'), 'courses'])
            ->firstOrFail();
            
        return view('pages.people.show', compact('staff'));
    }
}
