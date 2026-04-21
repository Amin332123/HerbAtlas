<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdatePhoneRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateNameRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UpdatePhotoRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAddressRequest;
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

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Name updated successfully!',
                'user' => [
                    'firstName' => $user->firstName,
                    'lastName' => $user->lastName,
                ],
            ]);
        }

        return back()->with('success', 'Name updated successfully!');
    }


    public function updatePassword(PasswordUpdateRequest $request)
    {

        $user = $request->user();
        if (!Hash::check($request->old_password, $user->password)) {

            return response()->json([
                'message' => 'The provided current password does not match our records.',
                'errors' => [
                    'old_password' => ['Incorrect current password.']
                ]
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!'
        ]);
    }

    public function updatePhone(UpdatePhoneRequest $request)
    {
        $request->user()->update([
            'phone_number' => $request->phone_number,
        ]);

        return response()->json(['message' => 'Phone number updated successfully!']);

    }




    public function updateImage(UpdatePhotoRequest $request)
    {
        $user = $request->user();

        if ($request->hasFile('photo')) {

            $newPath = $request->file('photo')->store('profiles', 'public');


            if ($user->picture) {

                Storage::disk('public')->delete($user->picture->img_path);


                $user->picture()->update([
                    'img_path' => $newPath
                ]);
            } else {

                $user->picture()->create([
                    'img_path' => $newPath
                ]);
            }
        }

        return back()->with('success', 'Profile picture updated successfully!');
    }




    public function updateAddress(UpdateAddressRequest $request)
    {
        $user = $request->user();

        
        $user->update(
            [
                'street' => $request->street,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'region' => $request->region,
            ]
        );

        return back()->with('success', 'Address updated successfully!');
    }



}
