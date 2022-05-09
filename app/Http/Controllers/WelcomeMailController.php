<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WelcomeMailController extends Controller
{
    public function send()
    {
        Mail::to('ansellmaximilian@gmail.com')->send(new WelcomeMail());
        return redirect('/booking');
    }

    public function upload()
    {
        return view('emails.uploastest');
    }

    public function uploadStore(Request $request)
    {
        if($request->hasFile('photo')){
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('avatars', 'public_uploads');
            dd($photoPath);
        }

        
    }
}
