<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\DepartmentSetting;

class ContactAlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::orderBy('graduation_year', 'desc')->get();
        $settings = DepartmentSetting::pluck('value', 'key');
        
        return view('pages.contact-alumni', compact('alumni', 'settings'));
    }
    
    public function send(Request $request) 
    {
        return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you shortly.');
    }
}
