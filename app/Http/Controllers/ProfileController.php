<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $user = $request->user();

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if($request->file('user-photo')){
            $file = $request-> file('user-photo');
            @unlink(public_path('upload/user_images/'.$user->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $user['photo'] = $filename;
        }

        $user->save();
        $notification = array(
            'message' => 'Profile Info Updated Successfully',
            'alert-type' => 'success'
        );
        //return Redirect::route('profile.edit')->with('status', 'profile-updated');
        return Redirect::route('profile.edit')->with($notification);
    }

    /**
     * Update the user's profile i9 information.
     */
    public function useri9InfoUpdate(Request $request): RedirectResponse
    {

        $user = $request->user();

        $request->validate([
            'state' => ['nullable', 'size:2'],
            'status' => ['nullable', 'string'],
        ]);

        $user->save();
        // firstOrNew finds the profile or creates a fresh instance if it doesn't exist
        $profile = $user->profile ?: new UserProfile(['user_id' => $user->id]);

        // Personal Details
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->middle_initial = $request->middle_initial;
        $profile->other_last_names = $request->other_last_names;

        // Contact & Address
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->street_address = $request->street_address;
        $profile->apt = $request->apt;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->zip = $request->zip;

        // Legal & Sensitive
        $profile->date_of_birth = $request->date_of_birth;
        $profile->ssn = $request->ssn;
        $profile->status = $request->status;
        $profile->uscis_a_number = $request->uscis_a_number;
        $profile->i94_admission_number = $request->i94_admission_number;
        $profile->passport_number = $request->passport_number;
        $profile->passport_country = $request->passport_country;
        $profile->work_authorization_expiration = $request->work_authorization_expiration;

        $profile->save();

        $notification = array(
            'message' => 'Profiles I9 Info Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect::route('profile.edit')->with($notification);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
