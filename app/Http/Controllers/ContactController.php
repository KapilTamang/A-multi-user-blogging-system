<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class ContactController extends Controller
{
    public function contact() {
        return view('emails.contact');
    }

    public function send(Request $request) {
        $rules = [
            'name' => ['required', 'max:32'],
            'email' => ['required', 'max:32', 'email'],
            'subject' => ['required', 'max:50'],
            'mail_message' => ['required', 'max:2000']
        ];

        $this->validate($request, $rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'mail_message' => $request->mail_message
        ];

        Mail::send('emails.send', $data, function($message) {
            $message->to('tamang.kapil11235@gmail.com', 'Kapil')->subject('Mail has been recieved from laravel blog site.');
        });
        
        // Session::flash('demo_msg', 'Hello this is demo msg');

        return back()->with('messageSuccess', 'Message has been sent successfully.');
    } 
}
