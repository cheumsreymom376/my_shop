<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function index()
    {
        return view('frontend.contact.index');
    }

    /**
     * Handle a submitted contact message.
     */
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // For now the message is just validated and acknowledged.
        // To actually deliver it, either:
        //   1) Send an email, e.g.:
        //      Mail::to(config('mail.admin_address'))->send(new ContactMessageMail($request->all()));
        //   2) Or store it in the database via a ContactMessage model/migration.

        return back()->with('success', 'Thanks for reaching out! We will get back to you soon.');
    }
}