<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentSetting;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactNacosController extends Controller
{
    /**
     * Show the Contact page
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Show the public NACOS Presidents page
     */
    public function presidents()
    {
        $presidents = \App\Models\NacosPresident::orderBy('tenure_end', 'desc')->get();
        return view('pages.nacos-presidents', compact('presidents'));
    }

    /**
     * Handle the contact form submission
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $recipientEmail = DepartmentSetting::where('key', 'contact_email')->value('value') 
                         ?? config('university.contact_email');

        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(new ContactMessage($validated));
            } catch (\Exception $e) {
                return back()->with('error', 'There was a problem sending your message. Please try again later.');
            }
        }

        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon.');
    }
}
