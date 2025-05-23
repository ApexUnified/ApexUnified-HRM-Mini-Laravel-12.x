<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\JobNature;
use App\Models\Position;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\User;
use App\Models\ZktecoDevice;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Rats\Zkteco\Lib\ZKTeco;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:Employee View", ["only" => "index"]),
            new Middleware("permission:Employee Create", ["only" => "create"]),
            new Middleware("permission:Employee Show", ["only" => "show"]),
            new Middleware("permission:Employee Edit", ["only" => "edit"]),
            new Middleware("permission:Employee Delete", ["only" => "destroy"]),
        ];
    }

    public function index(Request $request)
    {

        $employees = Employee::query()->orderBy("created_at", "DESC");

        if (!empty($request->input("department_id"))) {
            $employees = $employees->where("department_id", $request->input("department_id"));
        }

        if (!empty($request->input("gender"))) {
            $employees = $employees->where("gender", $request->input("gender"));
        }

        if (!empty($request->input("position_id"))) {
            $employees = $employees->where("position_id", $request->input("position_id"));
        }

        if (!empty($request->input("marital_status"))) {
            $employees = $employees->where("marital_status", $request->input("marital_status"));
        }

        if (!empty($request->input("device_id"))) {
            $employees = $employees->whereJsonContains("device_id", $request->input("device_id"));
        }

        if (!empty($request->input("blood_group"))) {
            $employees = $employees->where("blood_group", $request->input("blood_group"));
        }






        $employees = $employees->paginate(10);

        if ($request->hasAny(["department_id", "gender", "position_id", "marital_status", "device_id", "blood_group"]) && $employees->isEmpty()) {
            Toastr()->info("No Results Found From Your Given Search");
        }

        if ($request->ajax()) {
            $setting = Setting::first();
            return view("Partials.Employees.table_body", compact("employees", "setting"))->render();
        }

        $departments = Department::all();
        $positions = Position::all();
        $devices = ZktecoDevice::all();


        return view("Employees.employee_list.index", compact("employees", "departments", "positions", "devices"));
    }

    public function create()
    {
        $departments = Department::all();
        $schedules = Schedule::all();
        $devices = ZktecoDevice::all();
        $positions = Position::all();
        return view("Employees.employee_list.create", compact("departments", "schedules", "devices", "positions"));
    }


    public function store(Request $request)
    {

        // return $request->all();


        $validated_req = $request->validate([
            'employee_name' => 'required|min:3',
            'parent_name' => 'required|min:3',
            'employee_dob' => 'required|date',
            'date_of_hiring' => 'required|date',
            'department_id' => 'required|numeric',
            'employee_schedule' => 'required',
            'device_id' => 'required|array',
            'device_user_id' => 'required|numeric',
            'designation' => 'required|min:3',
            'gender' => 'required|in:Male,Female,Other',
            'position_id' => 'required|exists:positions,id',
            'joining_date' => 'required|date',
            'religion' => 'required',
            'marital_status' => 'required|in:Single,Married,Divorced,Widowed,Separated',
            'home_address' => 'required',
            'contact_number' => 'required|numeric',
            'email' => 'required|email|unique:employees,email',
            'cnic_number' => 'required|regex:/^\d{5}-\d{7}-\d{1}$/',
            'eobi_number' => 'nullable|numeric|digits:10',
            'sessi_number' => 'nullable|numeric|digits:10',
            'salary' => 'required|numeric',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'qualification' => 'required',
            'emergency_contact_details' => 'required',
            'emergency_contact_number' => 'required|numeric',
            'family_member_details' => 'nullable',
            'family_member_details.fullname' => 'nullable',
            'family_member_details.relation' => 'nullable',
            'family_member_details.age' => 'nullable|numeric',
            'family_member_details.contact_number' => 'nullable|numeric',
            'family_member_details.address' => 'nullable',
            'profile' => "nullable|mimes:jpg,jpeg,png|max:5242880",
            'resume' => 'nullable|mimes:pdf|max:2048',
            'joining_letter' => 'nullable|mimes:pdf|max:2048',
            'cnic.*' => 'nullable|mimes:pdf|max:5242880',
            'others.*' => 'nullable',
            'remarks' => 'nullable',
        ], [
            'cnic_number.regex' => "Cnic Number Must Be Valid"
        ]);


        $selectedDeviceIds = $validated_req["device_id"];
        $exists = Employee::where("device_user_id", $validated_req["device_user_id"])
            ->where(function ($query) use ($selectedDeviceIds) {
                foreach ($selectedDeviceIds as $device_id) {
                    $query->orWhereJsonContains("device_id", $device_id);
                }
            })

            ->exists();

        if ($exists) {
            Toastr()->error("This Device User ID For Selected Devices Its Already Exists In The System already exists in the system Please Choose A Different Device User Id For Assigning On Employee");
            return redirect()->back()->withInput($request->all());
        }




        $allDocs = [];

        if (!empty($request->file("profile"))) {
            $profile = $request->file("profile");
            $profileName = time() . uniqid() . '.' . $profile->getClientOriginalExtension();
            $directory = public_path('/assets/images/employee/profile');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $profile->move($directory, $profileName);
            $validated_req['profile'] = $profileName;
        }


        if (!empty($request->file("others"))) {
            $documents = $request->file("others");

            foreach ($documents as $document) {
                $newDocument = time() . uniqid() . '.' . $document->getClientOriginalExtension();

                $directory = public_path("/assets/images/employee/documents");

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }
                $document->move($directory, $newDocument);
                $allDocs[] = $newDocument;
            }
            $validated_req["others"] = json_encode($allDocs);
        }


        if (!empty($request->file("resume"))) {
            $resume = $request->file("resume");
            $ext = $resume->getClientOriginalExtension();

            $new_resume = "Resume_" . time() . "_" . uniqid() . "." . $ext;
            $directory = public_path('/assets/images/employee/resume');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $resume->move($directory, $new_resume);
            $validated_req['resume']  = $new_resume;
        }


        if (!empty($request->file("joining_letter"))) {
            $joining_letter = $request->file("joining_letter");
            $ext = $joining_letter->getClientOriginalExtension();

            $new_joining_letter = "Joining_Letter_" . time() . "_" . uniqid() . "." . $ext;
            $directory = public_path('/assets/images/employee/joining_letter');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $joining_letter->move($directory, $new_joining_letter);
            $validated_req['joining_letter'] = $new_joining_letter;
        }


        $allcnic = [];
        if (!empty($request->file("cnic"))) {
            $cnics = $request->file("cnic");

            foreach ($cnics as $cnic) {
                $ext = $cnic->getClientOriginalExtension();
                $new_cnic = "Cnic_" . time() . "_" . uniqid() . "." . $ext;
                $directory = public_path('/assets/images/employee/cnic');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                $cnic->move($directory, $new_cnic);
                $allcnic[] = $new_cnic;
            }
            $validated_req['cnic'] = json_encode($allcnic);
        }



        // return $validated_req;



        $schedules = $request->employee_schedule;
        $exploded_schedule = implode(",", $schedules);
        $validated_req['employee_schedule'] = $exploded_schedule;

        $employeeId = "EMP-" . rand(0000, 99999) . substr(uniqid(), -2);
        $validated_req['employee_id'] = $employeeId;


        $devices = ZktecoDevice::whereIn("id", $validated_req["device_id"])->get();
        $device_ids = $validated_req['device_id'];

        $validated_req['device_id'] = json_encode($device_ids, true);

        $this->CreateOnZktecoDevice($devices, $validated_req);
        $validated_req["created_by"] = Auth::user()->name;

        // return $validated_req;
        $create = Employee::create($validated_req);

        if ($create) {
            Toastr()->success("Employee Created Successfully");
            return redirect()->route('employee.index');
        } else {
            Toastr()->success("Employee Created Successfully");
            return redirect()->route('employee.index');
        }
    }


    public function CreateOnZktecoDevice($devices, $validated_req)
    {
        $timeout = 5;
        try {
            foreach ($devices as $device) {

                $socket = stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
                if ($socket) {
                    fclose($socket);
                    $isConnected = true;
                }


                if ($isConnected) {

                    $employee_id = $validated_req['device_user_id'];
                    $employee_name = $validated_req['employee_name'];


                    $zk = new ZKTeco($device->ip_address, $device->port);
                    if ($zk->connect()) {
                        $zk->testVoice();
                        $uid = $employee_id;
                        $userid = $employee_id;
                        $name = $employee_name;
                        $password = '';
                        $role = 0;

                        Log::info("Updating User on Device", [
                            'uid' => $uid,
                            'userid' => $userid,
                            'name' => $name,
                            'device_ip' => $device->ip_address,
                            'device_port' => $device->port,
                        ]);

                        $set = $zk->setUser($uid, $userid, $name, $password, $role);
                        Log::info("User Updated" . $set);
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any other exceptions
            Toastr()->error("Error Occured While Creating  Employee in Device Please Check Your Device Connection With The System");
            return redirect()->back();
        }
    }



    public function show(string $id)
    {
        $employee = Employee::find($id);
        if (empty($employee)) {
            Toastr()->error("Employee Not Found");
            return back();
        }
        return view("Employees.employee_list.show", compact("employee"));
    }

    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $schedules = Schedule::all();
        $devices = ZktecoDevice::all();
        $positions = Position::all();
        return view("Employees.employee_list.edit", compact('employee', "departments", "schedules", "devices", "positions"));
    }


    public function update(Request $request, string $id)
    {
        $validated_req = $request->validate([
            'employee_name' => 'required|min:3',
            'parent_name' => 'required|min:3',
            'employee_dob' => 'required|date',
            'date_of_hiring' => 'required|date',
            'department_id' => 'required|numeric',
            'employee_schedule' => 'required',
            'device_id' => 'required|array',
            'device_user_id' => 'required|numeric',
            'designation' => 'required|min:3',
            'gender' => 'required|in:Male,Female,Other',
            'position_id' => 'required|exists:positions,id',
            'joining_date' => 'required|date',
            'religion' => 'required',
            'marital_status' => 'required|in:Single,Married,Divorced,Widowed,Separated',
            'home_address' => 'required',
            'contact_number' => 'required|numeric',
            'email' => 'required|email|unique:employees,email,' . $id,
            'cnic_number' => 'required|regex:/^\d{5}-\d{7}-\d{1}$/',
            'eobi_number' => 'nullable|numeric|digits:10',
            'sessi_number' => 'nullable|numeric|digits:10',
            'salary' => 'required|numeric',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'qualification' => 'required',
            'emergency_contact_details' => 'required',
            'emergency_contact_number' => 'required|numeric',
            'family_member_details' => 'nullable',
            'family_member_details.fullname' => 'nullable',
            'family_member_details.relation' => 'nullable',
            'family_member_details.age' => 'nullable|numeric',
            'family_member_details.contact_number' => 'nullable|numeric',
            'family_member_details.address' => 'nullable',
            'profile' => "nullable|mimes:jpg,jpeg,png|max:5242880",
            'resume' => 'nullable|mimes:pdf|max:2048',
            'joining_letter' => 'nullable|mimes:pdf|max:2048',
            'cnic.*' => 'nullable|mimes:pdf|max:5242880',
            'others.*' => 'nullable',
            'remarks' => 'nullable',
        ], [
            'cnic_number.regex' => "Cnic Number Must Be Valid"
        ]);

        $employee = Employee::find($id);
        if (!empty($employee)) {

            $selectedDeviceIds = $validated_req["device_id"];
            $exists = Employee::where("device_user_id", $validated_req["device_user_id"])
                ->where("id", "!=", $id)
                ->where(function ($query) use ($selectedDeviceIds) {
                    foreach ($selectedDeviceIds as $device_id) {
                        $query->orWhereJsonContains("device_id", $device_id);
                    }
                })
                ->exists();

            if ($exists) {
                Toastr()->error("This Device User ID For Selected Devices Its Already Exists In The System already exists in the system Please Choose A Different Device User Id For Assigning On Employee");
                return redirect()->back()->withInput($request->all());
            }


            $allDocs = [];

            if (!empty($request->file("profile"))) {

                if (!empty($employee->profile)) {
                    File::delete(public_path('/assets/images/employee/profile/' . $employee->profile));
                }

                $profile = $request->file("profile");
                $profileName = time() . uniqid() . '.' . $profile->getClientOriginalExtension();
                $directory = public_path('/assets/images/employee/profile');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                $profile->move($directory, $profileName);
                $validated_req['profile'] = $profileName;
            }


            if (!empty($request->file("others"))) {

                if (!empty($employee->others)) {
                    foreach (json_decode($employee->others) as $doc) {
                        File::delete(public_path('/assets/images/employee/documents/' . $doc));
                    }
                }

                $documents = $request->file("others");

                foreach ($documents as $document) {
                    $newDocument = time() . uniqid() . '.' . $document->getClientOriginalExtension();

                    $directory = public_path("/assets/images/employee/documents");

                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }
                    $document->move($directory, $newDocument);
                    $allDocs[] = $newDocument;
                }
                $validated_req["others"] = json_encode($allDocs);
            }

            if (!empty($request->file("resume"))) {

                if (!empty($employee->resume)) {
                    File::delete(public_path('/assets/images/employee/resume/' . $employee->resume));
                }

                $resume = $request->file("resume");
                $ext = $resume->getClientOriginalExtension();

                $new_resume = "Resume_" . time() . "_" . uniqid() . "." . $ext;
                $directory = public_path('/assets/images/employee/resume');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                $resume->move($directory, $new_resume);
                $validated_req['resume'] = $new_resume;
            }


            if (!empty($request->file("joining_letter"))) {

                if (!empty($employee->joining_letter)) {
                    File::delete(public_path('/assets/images/employee/joining_letter/' . $employee->joining_letter));
                }
                $joining_letter = $request->file("joining_letter");
                $ext = $joining_letter->getClientOriginalExtension();

                $new_joining_letter = "Joining_Letter_" . time() . "_" . uniqid() . "." . $ext;
                $directory = public_path('/assets/images/employee/joining_letter');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                $joining_letter->move($directory, $new_joining_letter);
                $validated_req['joining_letter'] = $new_joining_letter;
            }


            $allcnic = [];
            if (!empty($request->file("cnic"))) {

                if (!empty($employee->cnic)) {

                    foreach (json_decode($employee->cnic) as $cnic) {
                        File::delete(public_path('/assets/images/employee/cnic/' . $cnic));
                    }
                }

                $cnics = $request->file("cnic");
                foreach ($cnics as $cnic) {
                    $ext = $cnic->getClientOriginalExtension();
                    $new_cnic = "Cnic_" . time() . "_" . uniqid() . "." . $ext;
                    $directory = public_path('/assets/images/employee/cnic');

                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0777, true);
                    }

                    $cnic->move($directory, $new_cnic);
                    $allcnic[] = $new_cnic;
                }
                $validated_req['cnic'] = json_encode($allcnic);
            }


            $schedules = $request->employee_schedule;
            $exploded_schedule = implode(",", $schedules);
            $validated_req['employee_schedule'] = $exploded_schedule;



            $employee_id = $validated_req['device_user_id'];
            $employee_name = $validated_req['employee_name'];

            $devices = ZktecoDevice::whereIn("id", $validated_req["device_id"])->get();

            $device_ids = $validated_req['device_id'];
            $validated_req['device_id'] = json_encode($device_ids, true);

            $this->UpdateOnZktecoDevice($devices, $employee_id, $employee_name);


            $update = $employee->update($validated_req);
            if ($update) {
                Toastr()->success("Employee Updated Successfully");
                return redirect()->route('employee.index');
            } else {
                Toastr()->error("Failed to Update Employee");
                return redirect()->back();
            }
        } else {
            Toastr()->error("Employee Not Found");
            return redirect()->back();
        }
    }


    public function UpdateOnZktecoDevice($devices, $employee_id, $employee_name)
    {
        $timeout = 5;
        try {
            foreach ($devices as $device) {
                $socket = stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
                if ($socket) {
                    fclose($socket);
                    $isConnected = true;
                }

                if ($isConnected) {

                    $zk = new ZKTeco($device->ip_address, $device->port);
                    if ($zk->connect()) {
                        $zk->testVoice();
                        $uid = $employee_id;
                        $userid = $employee_id;
                        $name = $employee_name;
                        $password = '';
                        $role = 0;

                        Log::info("Updating User on Device", [
                            'uid' => $uid,
                            'userid' => $userid,
                            'name' => $name,
                            'device_ip' => $device->ip_address,
                            'device_port' => $device->port,
                        ]);

                        $set = $zk->setUser($uid, $userid, $name, $password, $role);
                        Log::info("User Updated" . $set);
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any other exceptions
            Toastr()->error("Error Occured While  Updating Employee in Device Please Check Your Device Connection With The System");
            return redirect()->back();
        }
    }


    public function deletebyselection(Request $request)
    {

        $ids = $request->input("employee_ids");

        $employees = Employee::whereIn('id', $ids)->get();

        if ($employees->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete employees'
            ]);
        }

        foreach ($employees as $employee) {
            if (!empty($employee->profile)) {
                File::delete(public_path("assets/images/employee/profile/" . $employee->profile));
            }

            if (!empty($employee->others)) {
                foreach (json_decode($employee->others) as $doc) {
                    File::delete(public_path("assets/images/employee/documents/" . $doc));
                }
            }


            if (!empty($employee->resume)) {
                File::delete(public_path("assets/images/employee/resume/" . $employee->resume));
            }

            if (!empty($employee->joining_letter)) {
                File::delete(public_path("assets/images/employee/joining_letter/" . $employee->joining_letter));
            }



            if (!empty($employee->cnic)) {
                foreach (json_decode($employee->cnic) as $cnic) {
                    File::delete(public_path("assets/images/employee/cnic/" . $cnic));
                }
            }

            $employee->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Employees deleted successfully'
        ]);
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (!empty($employee)) {

            if (!empty($employee->profile)) {
                File::delete(public_path("assets/images/employee/profile/" . $employee->profile));
            }

            if (!empty($employee->others)) {
                foreach (json_decode($employee->others) as $doc) {
                    File::delete(public_path("assets/images/employee/documents/" . $doc));
                }
            }


            if (!empty($employee->resume)) {
                File::delete(public_path("assets/images/employee/resume/" . $employee->resume));
            }

            if (!empty($employee->joining_letter)) {
                File::delete(public_path("assets/images/employee/joining_letter/" . $employee->joining_letter));
            }



            if (!empty($employee->cnic)) {
                foreach (json_decode($employee->cnic) as $cnic) {
                    File::delete(public_path("assets/images/employee/cnic/" . $cnic));
                }
            }

            $delete = $employee->delete();
            if ($delete) {
                Toastr()->success("Employee Deleted Successfully");
                return redirect()->route('employee.index');
            } else {
                Toastr()->error("Failed to Delete Employee");
                return redirect()->back();
            }
        } else {
            Toastr()->error("Employee Not Found");
            return redirect()->back();
        }
    }
}
