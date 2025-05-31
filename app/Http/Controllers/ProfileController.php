<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function userProfile(string $id)
    {
        $user = User::find($id);
        if ($user && $id == Auth::id()) {
            return view('user_profile.user-profile', compact('user'));
        } else {
            $id != Auth::id() ? Toastr()->error("You Cannot See Anybody's Profile You Can See Only Your's") : "";
            return back();
        }
    }




    public function userProfileUpdate(string $id, Request $request)
    {


        $validated_req = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required'
        ]);

        if ($request->hasFile("profile")) {

            $profile_exists = User::find($id);
            if ($profile_exists->profile) {
                File::delete(public_path("assets/images/user-profile/" . $profile_exists->profile));
            }

            $profile = $request->file("profile");
            $ext = $profile->getClientOriginalExtension();
            $newProfile = time() . uniqid() . '.' . $ext;
            $directory = public_path("assets/images/user-profile");

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            $profile->move($directory, $newProfile);
            $validated_req['profile'] = $newProfile;
        }

        $user = User::find($id);
        if (!empty($user)) {
            $update = $user->update($validated_req);
            if ($update) {
                Toastr()->success("User Profile Has Been Updated");
                return redirect()->route('user.profile', ['id' => $id]);
            } else {
                Toastr()->error("Failed To Update User Profile");
                return redirect()->route('user.profile', ['id' => $id]);
            }
        } else {
            Toastr()->error("User Not Found");
            return redirect()->route('user.profile', ['id' => $id]);
        }
    }


    public function userPasswordUpdate(string $id, Request $request)
    {

        $validated_req = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);


        $user = User::find($id);
        if (!empty($user)) {
            $password = Hash::make($request->password);
            $update = $user->update(["password" => $password]);
            if ($update) {
                Toastr()->success('Password updated successfully');
                return redirect()->route('user.profile', ['id' => $id]);
            } else {
                Toastr()->error('Failed to update password');
                return redirect()->route('user.profile', ['id' => $id]);
            }
        } else {
            Toastr()->error('User not found');
            return redirect()->route('user.profile', ['id' => $id]);
        }
    }
}
