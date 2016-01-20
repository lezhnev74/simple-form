<?php

namespace App\Http\Controllers;


use Mail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactFormController extends Controller
{
    /**
     * Show contact form
     */
    public function form()
    {
        return view('form');
    }

    /**
     * Send a message to admin
     */
    public function send(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'  => 'required|min:3',
            'email' => 'required|email',
            'photo' => 'image|max:1024',
            'to'    => 'email' // for reviewer input
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ok good to go

        // prepare message to send
        // inline (we could use separated view)
        $msg = "
New message

From: " . $request->input('name') . " " . $request->input('surname') . "
Email: " . $request->input('email') . "

" . $request->input('message') . "
        ";


        // make sending (synchronously)
        Mail::raw($msg, function ($message) use ($request) {
            $message->to($request->input('to', env('ADMIN_EMAIL')))->subject('You have new message from website');

            if ($request->hasFile('photo')) {
                $message->attach($request->file('photo')->getRealPath(),
                    ['as' => $request->file('photo')->getClientOriginalName()]);
            }
        });

        return redirect()->back()->with('message', trans('contactform.success_message'));

    }
}
