<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactFormSubmission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a new contact message submission
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // Create a new contact entry
        $contact = Contact::create($validated);

        // Send email notification
        try {
            Mail::to(config('mail.admin_address'))->send(new ContactFormSubmission($contact));
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            Log::error('Failed to send contact email: ' . $e->getMessage());
        }

        // Return a successful response
        return response()->json([
            'message' => 'Your message has been received. We will contact you shortly.',
            'contact' => $contact
        ], 201);
    }


    public function index()
    {
        $contacts = Contact::all();

        return response()->json($contacts);
    }
}
