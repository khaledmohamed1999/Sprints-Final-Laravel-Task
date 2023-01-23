<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    //

    function index()
    {
        return view('contact');
    }

    function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message_text' => 'required'
        ]);

        
        /*$file = Storage::disk('public')->path('categories/2pTycSuCVKTwemsSMD7ajFKk47V78ehjVeVIqM7a.jpg');

        Mail::send('mail.contact', $request->all(), function ($message) use ($file) {
            $message->to('ramymibrahim@yahoo.com', 'Ramy')->subject('Contact Message');
            //$message->attach($file);
        });
        */
        Mail::to('ramymibrahim@yahoo.com')->send(new ContactMail($request->all()));

        return redirect()->route('contact')->with('success', 'Email has been send successfully!');
    }
}