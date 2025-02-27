<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class UserListController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:User View", ["only" => "index"]),
            new Middleware("permission:User Create", ["only" => "create"]),
            new Middleware("permission:User Edit", ["only" => "edit"]),
            new Middleware("permission:User Delete", ["only" => "destroy"]),
        ];
    }
    public function index()
    {
        $users = User::orderBy("created_at", "DESC")->get();
        // dd( Auth::user()->roles->pluck("name"));
        return view("user_list.index", compact("users"));
    }


    public function create()
    {
        $roles = Role::all();
        return view("user_list.create", compact("roles"));
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($request->hasFile('profile')) {
            $request->validate([
                'mimes:png,jpg,jpeg'
            ]);
            $profile = $request->file('profile');
            $ext = $profile->getClientOriginalExtension();
            $newProfile = time() . '-' . uniqid() . '.' . $ext;
            $directory = public_path("assets/images/user-profile");
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true, true);
            }
            $profile->move($directory, $newProfile);
            $validated_req['profile'] = $newProfile;
        }


        $password = $validated_req['password'];
        $encryped_pass =  bcrypt($password);
        $validated_req['password'] = $encryped_pass;

        $user = User::create($validated_req);
        if ($user) {
            $role_id = $request->input("role");
            $role = Role::find($role_id);
            $user->syncRoles($role);
            Toastr()->success("User Created Successfully");
            return redirect()->route("user-list.index");
        } else {
            Toastr()->error("Failed to create User");
            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view("user_list.edit", compact('user', 'roles'));
    }


    public function update(Request $request, string $id)
    {

        $validated_req = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        $request->validate([
            'current_password' => "nullable|required_with:password|current_password"
        ]);

        if (!empty($request->password)) {
            $validated_req = $request->validate([
                'password' => 'confirmed',
            ]);
            $password = $validated_req['password'];
            $encryped_pass =  bcrypt($password);
            $validated_req['password'] = $encryped_pass;
        }
        $user = User::find($id);

        if ($request->hasFile('profile')) {

            if (!empty($user->profile)) {
                File::delete(public_path("assets/images/user-profile/" . $user->profile));
            }
            $request->validate([
                'mimes:png,jpg,jpeg'
            ]);
            $profile = $request->file('profile');
            $ext = $profile->getClientOriginalExtension();
            $newProfile = time() . '-' . uniqid() . '.' . $ext;
            $directory = public_path("assets/images/user-profile");
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true, true);
            }
            $profile->move($directory, $newProfile);
            $validated_req['profile'] = $newProfile;
        }




        if (!empty($user)) {
            $user->update($validated_req);
            $role_id = $request->input("role");
            $role = Role::find($role_id);
            $user->syncRoles($role);
            Toastr()->success("User updated successfully");
            return redirect()->route("user-list.index");
        } else {
            Toastr()->error("Failed to update user");
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("user_list_ids");


        if (in_array(1, $ids)) {
            return response()->json([
                'status' => false,
                'message' => "You Have Selected Default User The Default User Cannot be Deleted"
            ]);
        }




        $delete = User::whereIn('id', $ids)->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => "Users deleted successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete users"
            ]);
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $delete = $user->delete();

            if ($delete) {
                Toastr()->success("User deleted successfully");
                return redirect()->route('user-list.index');
            } else {
                Toastr()->error("Failed to delete user");
                return redirect()->route('user-list.index');
            }
        } else {
            Toastr()->error("User not found");
            return redirect()->route('user-list.index');
        }
    }
}
