<?php

namespace App\Http\Controllers;
use App\Http\Requests\LogoutRequest;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginRequest;
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
        $customerRole = Role::where('status', 'customer')->first();

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $customerRole->id,
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


    // login code : 

    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $user = Auth::user();

        if ($user->is_banned) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Your account has been banned and cannot log in.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }


    public function showLogin() {
        return view('Auth.login');
    }



    public function logout(LogoutRequest $request) {
        Auth::logout();

        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
