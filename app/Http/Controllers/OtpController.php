<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{

    public function loginwithotp(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email|max:50',
        ]);
        $checkIsUser = users::where('email', $request->email)->first();
        if (is_null($checkIsUser)) {
            return redirect()->route('login.with.otp')->with('error', 'Your account is not registered with us.');
        } else {
            $otp = rand(1234, 9999);
            $userupdate = users::where('email', $request->email)->update([
                'otp' => $otp,
            ]); 

            Mail::send('login', ['otp' => $otp], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Login with OTP - Bill.in');
            });

            return redirect('confirm-login-with-otp')->withSuccess('Reset password link sent to your email address. Please check your Inbox/Spam Folder for reset password link.');
        }
    }

    public function confirmloginwithotp(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
        ]);
        $checkUser = Users::where('otp', $request->otp)->where('email', $request->email)->first();
        if (is_null($checkUser)) {
            return redirect()->route('confirm.login.with.otp')->with('error', 'OTP or Email is incorrect.');
        } else {
            $user = users::where('email', $request->email)->first();
            if ($user) {
                $userupdate = users::where('email', $request->email)->update([
                    'otp' => NULL
                ]);
                Auth::login($user);
                return redirect()->route('dashboard')->with('success', 'Welcome to user dashboard.');
            }
            return redirect()->back()->with('error', 'Login with otp failed.');
        }
    }
}
