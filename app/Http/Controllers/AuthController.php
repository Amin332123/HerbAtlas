<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showRegister()
    {
        return view('Auth.register');
    }
    public function showVerification()
    {
        return view('Auth.verification');
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('verification.notice');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return view('Auth.login');
    }


    public function resendVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');

    }

}

