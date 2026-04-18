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
            ->get();
            
        $staff = Staff::where('sub_department_id', $subDept->id)
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        return view('pages.sub-department', compact('subDept', 'programmes', 'staff'));
    }
}
