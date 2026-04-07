<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentSetting;
use App\Models\ResourceCategory;

class SiwesController extends Controller
{
    public function index()
    {
        $settings = DepartmentSetting::where('group', 'page_siwes')->pluck('value', 'key')->toArray();
        $downloads = ResourceCategory::where('name', 'like', '%SIWES%')->with(['items' => function($q){
            $q->where('is_active', true)->orderBy('sort_order');
        }])->first();
        
        return view('pages.siwes', compact('settings', 'downloads'));
    }
}
