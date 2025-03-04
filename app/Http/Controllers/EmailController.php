<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $toEmail="kakadiyatrupes01@gmail.com";
        $message="Testing Mail";
        $subject= "Lareval Mail";

        $request = Mail::to($toEmail)->send(new welcomeemail($message,$subject));
        dd($request);
    }
}
