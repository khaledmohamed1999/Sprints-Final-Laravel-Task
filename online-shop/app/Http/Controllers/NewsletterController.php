<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    function subscribe(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        Mail::to($request['email'])->send(new NewsletterMail($request->all()));
        return redirect()->route('home_index')->with('success', 'Email has been send successfully!');
    }
}
