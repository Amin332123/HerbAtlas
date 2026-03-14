<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateNameRequest;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }



    public function profilePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password updated');
    }


    public function updateName(UpdateNameRequest $request)
    {

        $user = $request->user();

        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
        ]);

        return back()->with('success', 'Name updated successfully!');
    }




}
