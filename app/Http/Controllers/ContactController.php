<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactTicket;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    public function show()
    {
        return view('contacts');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|min:5|max:100',
            'message' => 'required|string|min:1|max:2000'
        ]);

        $ticket = ContactTicket::create([
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip_address' => $request->ip()
        ]);

        // TODO: Send email notification
        // Mail::to('info@pawnshop.bg')->send(new ContactFormSubmitted($ticket));

        return redirect()->route('contact.show')->with('success', 'Ticket successfully submitted!');
    }
}