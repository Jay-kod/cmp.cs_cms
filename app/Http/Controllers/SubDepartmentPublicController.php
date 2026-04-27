<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubDepartment;
use App\Models\Programme;
use App\Models\Staff;

class SubDepartmentPublicController extends Controller
{
    public function show($slug)
    {
        $subDept = SubDepartment::where('slug', $slug)->firstOrFail();
        
        $programmes = Programme::where('sub_department_id', $subDept->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();
            
        $staff = Staff::where('sub_department_id', $subDept->id)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // If no staff explicitly assigned to the sub-department, load general lecturers
        if ($staff->isEmpty()) {
            $staff = Staff::whereNotNull('name')
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        // If no programmes explicitly assigned to the sub-department, load random programmes
        if ($programmes->isEmpty()) {
            $programmes = Programme::where('is_active', true)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return view('pages.sub-department', compact('subDept', 'programmes', 'staff'));
    }
}
