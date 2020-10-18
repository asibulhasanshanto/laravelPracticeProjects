<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function show()
    {
        return view('emails.submitEmailForm');
    }
    public function store()
    {
        request()->validate(['email' => 'required|email']);
        // Mail::raw('It works', function ($message) {
        //     $message->from('john@johndoe.com', 'John Doe');
        //     $message->sender('john@johndoe.com', 'John Doe');
        //     $message->to(request('email'), 'John Doe');
        //     $message->cc('john@johndoe.com', 'John Doe');
        //     $message->subject('Hello');
        // });

        Mail::to(request('email'))->send(new ContactMe('Asibul'));
        return redirect('/email')->with('message', 'email sent');
    }
}
