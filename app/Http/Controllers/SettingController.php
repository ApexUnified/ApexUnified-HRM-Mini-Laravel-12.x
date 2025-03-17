<?php

namespace App\Http\Controllers;

use App\Events\QueueEnvRefresh;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:Settings View", ["only" => "index"]),
            new Middleware("permission:Settings View", ["only" => "roles"]),
            new Middleware("permission:Settings View", ["only" => "roleCreate"]),
            new Middleware("permission:Settings View", ["only" => "roleDestroy"]),
            new Middleware("permission:Settings View", ["only" => "permissions"]),
        ];
    }
    public function index()
    {

        $setting = Setting::first();
        $currencies = Currency::all();
        $timezones = timezone_identifiers_list();
        return view('setting.general_setting.index', compact('setting', 'timezones', 'currencies'));
    }


    public function store(Request $request)
    {

        $validated_req = $request->validate([
            'system_title' => 'nullable',
            'system_logo' => 'nullable|mimes:png,jpg,jpeg,webp',
            'favicon' => "nullable|mimes:png,jpg,jpeg,webp",
            'auth_logo' => "nullable|mimes:png,jpg,jpeg,webp",
            'time_zone' => 'nullable|timezone',
            'currency' => 'nullable',
            'company_name' => 'nullable',
            'developed_by' => 'nullable'
        ]);



        if (!empty($validated_req["system_logo"])) {
            $logo_exists = Setting::find(1);
            if ($logo_exists->system_logo) {
                File::delete(public_path("assets/images/logo/" . $logo_exists->system_logo));
            }
            sleep(1);
            $logo = $validated_req['system_logo'];
            $ext = $logo->getClientOriginalExtension();
            $newLogo = time() . uniqid() . '.' . $ext;
            $directory = public_path("assets/images/logo");

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
            $logo->move($directory, $newLogo);
            $validated_req['system_logo'] = $newLogo;
        }

        if (!empty($validated_req["favicon"])) {

            $favicon_exists = Setting::find(1);
            if (!empty($favicon_exists->favicon)) {
                File::delete(public_path("assets/images/logo/" . $favicon_exists->favicon));
            }

            $favicon = $validated_req["favicon"];
            $ext = $favicon->getClientOriginalExtension();
            $new_favicon = time() . uniqid() . "." . $ext;
            $directory = public_path("assets/images/logo");

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            $favicon->move($directory, $new_favicon);
            $validated_req['favicon'] = $new_favicon;
        }

        if (!empty($validated_req["auth_logo"])) {

            $auth_logo_exists = Setting::find(1);
            if (!empty($auth_logo_exists->auth_logo)) {
                File::delete(public_path("assets/images/logo/" . $auth_logo_exists->auth_logo));
            }

            $auth_logo = $validated_req["auth_logo"];
            $ext = $auth_logo->getClientOriginalExtension();
            $new_auth_logo = time() . uniqid() . "." . $ext;
            $directory = public_path("assets/images/logo");

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            $auth_logo->move($directory, $new_auth_logo);
            $validated_req['auth_logo'] = $new_auth_logo;
        }

        if (!empty($validated_req['time_zone'])) {
            dispatch(new QueueEnvRefresh("APP_TIMEZONE", $validated_req["time_zone"]))->delay(now()->addSecond(5));
        }
        if (!empty($validated_req["system_title"])) {
            dispatch(new QueueEnvRefresh("APP_NAME", $validated_req["system_title"]))->delay(now()->addSecond(5));
        }
        $exists = Setting::find(1);
        if (!empty($exists)) {
            // dump("Updating");
            $setting = Setting::find(1);
            $update =  $setting->update($validated_req);
            // dump("Updated");
            if ($update) {
                Toastr()->success("Setting Has Been Updated");
                return redirect()->route('setting.index');
            } else {
                Toastr()->error("Failed To Update Setting");
                return redirect()->route('setting.index');
            }
        } else {
            // dump("Creating");
            $setting = Setting::create($validated_req);
            // dump("Created");
            if ($setting) {
                Toastr()->success("Setting Has Been Created");
                return redirect()->route('setting.index');
            } else {
                Toastr()->error("Failed to create setting");
                return redirect()->route('setting.index');
            }
        }
    }





    public function roles()
    {
        $roles = Role::orderBy("created_at", "DESC")->get();
        return view("setting.role_permission.index", compact("roles"));
    }

    public function roleCreate()
    {
        return view("setting.role_permission.create");
    }

    public function roleStore(Request $request)
    {
        $validated_req = $request->validate([
            'name' => 'required',
            'guard_name' => "web"
        ]);

        if (Role::where("name", $request->input("name"))->exists()) {
            Toastr()->error('The Role You Are Trying To Add Its already exists');
            return redirect()->back()->withInput($request->all());
        }

        $create = Role::create($validated_req);
        if ($create) {
            Toastr()->success('Role created successfully');
            return redirect()->route('setting.roles');
        } else {
            Toastr()->error('Failed to create role');
            return redirect()->route('setting.roles');
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("role_ids");

        if (in_array(1, $ids) || in_array(2, $ids)) {
            return response()->json([
                'status' => false,
                'message' => 'You cannot delete System Reserved Roles'
            ]);
        }


        $delete = Role::whereIn("id", $ids)->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => 'Roles deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete roles'
            ]);
        }
    }

    public function roleDestroy(string $id)
    {
        $role = Role::find($id);

        if ($id == 1 || $id == 2) {
            Toastr()->warning("You Cannot Delete System Reserved Roles");
            return back();
        }


        if (!empty($role)) {
            $delete = $role->delete();
            if ($delete) {
                Toastr()->success('Role deleted successfully');
                return redirect()->route('setting.roles');
            } else {
                Toastr()->error('Failed to delete role');
                return redirect()->route('setting.roles');
            }
        } else {
            Toastr()->error('Role not found');
            return redirect()->route('setting.roles');
        }
    }


    public function permissions(string $id)
    {
        $permissions = Permission::all();
        $role_id = $id;
        $role = Role::find($role_id);
        $hasPermissions = $role->permissions;
        return view("setting.role_permission.permissions", compact("permissions", "role_id", "hasPermissions"));
    }

    public function permissionCreate()
    {
        if (config("app.app_protocol") == "http" && config("app.env") == "local") {
            return view("setting.role_permission.permission_create");
        } else {
            Toastr()->error("You Dont Access To This Page This Page is Only For Developers");
            return back();
        }
    }

    public function permissionStore(Request $request)
    {
        $validated_req = $request->validate([
            'name' => 'required'
        ]);

        $create = Permission::create($validated_req);
        if ($create) {
            Toastr()->success('Permission created successfully');
            return redirect()->back();
        } else {
            Toastr()->error('Failed to create permission');
            return redirect()->back();
        }
    }

    public function permissionAssign(Request $request)
    {
        if (empty($request->input("name"))) {
            Toastr()->error("Please Select any Permission");
            return redirect()->back();
        }

        $role_id = $request->input("role_id");
        $role = Role::find($role_id);

        $currentPermissions = $role->permissions()->pluck("name")->toArray() ?? [];
        $newPermissions = $request->input("name");

        $permissionsToAdd = array_diff($newPermissions, $currentPermissions);
        $permissionsToRemove = array_diff($currentPermissions, $newPermissions);



        if (!empty($permissionsToAdd)) {
            $role->givePermissionTo($permissionsToAdd);
        }

        if (!empty($permissionsToRemove)) {
            $role->revokePermissionTo($permissionsToRemove);
        }

        Toastr()->success('Permission assigned successfully');
        return redirect()->route('setting.roles');
    }
}
