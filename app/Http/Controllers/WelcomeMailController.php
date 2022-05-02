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
}
