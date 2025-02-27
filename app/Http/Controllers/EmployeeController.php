<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\JobNature;
use App\Models\Position;
use App\Models\Schedule;
use App\Models\User;
use App\Models\ZktecoDevice;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Rats\Zkteco\Lib\ZKTeco;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller implements HasMiddleware
{
    public static function middleware() :array 
    {
        return [
            new Middleware("permission:Employee View",["only" => "index"]),
            new Middleware("permission:Employee Create",["only" => "create"]),
            new Middleware("permission:Employee Edit",["only" => "edit"]),
            new Middleware("permission:Employee Delete",["only" => "destroy"]),
        ];
    }

    public function index()
    {
        $employees = Employee::orderBy("created_at","DESC")->get();

        return view("Employees.employee_list.index",compact("employees"));
    }

    public function create()
    {
        $departments = Department::all();
        $schedules = Schedule::all();
        $devices = ZktecoDevice::all();
        return view("Employees.employee_list.create",compact("departments","schedules","devices"));
    }


    public function store(Request $request)
    {

        $validated_req = $request->validate([
            'employee_name' => 'required|min:3',
            'father_name' => 'required|min:3',
            'employee_dob' => 'required|date',
            'date_of_hiring' => 'required|date',
            'department_id' => 'required|numeric',
            'employee_schedule' => 'required',
            'device_id' => 'required|array',
            'device_user_id' => 'required|numeric',
            'designation' => 'required|min:3',
        ]);

        $schedules = $request->employee_schedule;
        $exploded_schedule = implode(",",$schedules);
        $validated_req['employee_schedule'] = $exploded_schedule;
        // return $validated_req;

        $employeeId = rand(0000000000,9999999999);
        $validated_req['employee_id'] = $employeeId;

        $devices = ZktecoDevice::whereIn("id",$validated_req["device_id"])->get();
        $this->CreateOnZktecoDevice($devices,$validated_req);

        $device_ids = $validated_req['device_id'];
        $validated_req['device_id'] = json_encode($device_ids,true);
        // return $validated_req;
        $create = Employee::create($validated_req);

        if($create){
            Toastr()->success("Employee Created Successfully");
            return redirect()->route('employee.index');
        }else{
            Toastr()->success("Employee Created Successfully");
            return redirect()->route('employee.index');
        }

    }


    public function CreateOnZktecoDevice($devices,$validated_req){
        Log::info("Inside CreateOnZktecoDevice method.");
        $timeout = 10;
        try {
            foreach($devices as $device){
                $socket = @stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
                if ($socket) {
                    fclose($socket);
                    $isConnected = true;
                }

                // Display connection status
                if ($isConnected) {
                    $exists = Employee::where("device_user_id", $validated_req['device_user_id'])
                    ->where("device_id", $device->id)
                    ->first();
                if($exists){
                        Toastr()->error("This Device User ID already exists in the system");
                        return redirect()->back();
                    }else{
                        $employee_id = $validated_req['device_user_id'];
                        $employee_name = $validated_req['employee_name'];
                }


                    $zk = new ZKTeco($device->ip_address,$device->port);
                    if($zk->connect()){
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




    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $schedules = Schedule::all();
        $devices = ZktecoDevice::all();
        return view("Employees.employee_list.edit",compact('employee',"departments","schedules","devices"));
    }


    public function update(Request $request, string $id)
    {


        $validated_req = $request->validate([
            'employee_name' => 'required|min:3',
            'father_name' => 'required|min:3',
            'employee_dob' => 'required|date',
            'date_of_hiring' => 'required|date',
            'department_id' => 'required|numeric',
            'employee_schedule' => 'required',
            'device_id' => 'required|array',
            'device_user_id' => 'required|numeric',
            'designation' => 'required|min:3',

        ]);

        $schedules = $request->employee_schedule;
        $exploded_schedule = implode(",",$schedules);
        $validated_req['employee_schedule'] = $exploded_schedule;

        $employee = Employee::find($id);
        if(!empty($employee)){

            $devices = ZktecoDevice::whereIn("id",$validated_req["device_id"])->get();

            foreach($devices as $device){
                $employee_with_same_uid_and_device = Employee::where("device_user_id", $validated_req['device_user_id'])
                ->where("device_id", $device->id)
                ->where("id", "!=", $employee->id)
                ->first();

                if ($employee_with_same_uid_and_device) {
                Log::info("Conflict: UID {$validated_req['device_user_id']} already exists on Device {$device->id}.");
                Toastr()->error("This Device User ID is already assigned to another employee.");
                return redirect()->back();
                }
            }


            Log::info("No conflicts found. Proceeding to update or create on the ZKTeco device.");

            $employee_id = $validated_req['device_user_id'];
            $employee_name = $validated_req['employee_name'];

            $devices = ZktecoDevice::whereIn("id",$validated_req["device_id"])->get();

            $device_ids = $validated_req['device_id'];
            $validated_req['device_id'] = json_encode($device_ids,true);

            $this->UpdateOnZktecoDevice($devices, $employee_id, $employee_name);


            $update = $employee->update($validated_req);
            if($update){
                Toastr()->success("Employee Updated Successfully");
                return redirect()->route('employee.index');
            }else{
                Toastr()->error("Failed to Update Employee");
                return redirect()->back();
            }
        }else{
            Toastr()->error("Employee Not Found");
            return redirect()->back();
        }


    }


    public function UpdateOnZktecoDevice($devices,$employee_id,$employee_name){
        Log::info("Inside UpdateOnZktecoDevice method.");
        $timeout = 10;
        try {
            foreach($devices as $device) {
                $socket = @stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
                if ($socket) {
                    fclose($socket);
                    $isConnected = true;
                }

                // Display connection status
                if ($isConnected) {

                        $zk = new ZKTeco($device->ip_address,$device->port);
                        if($zk->connect()){
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


    public function deletebyselection(Request $request){

        $ids = $request->input("employee_ids");

        $delete = Employee::whereIn('id',$ids)->delete();

        if($delete){
            return response()->json([
                'status' => true,
                'message' => 'Employees deleted successfully'
            ]);
        }else{
            return response()->json([
               'status' => false,
               'message' => 'Failed to delete employees'
            ]);
        }
        Log::info($ids);

    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if(!empty($employee)){
            $delete = $employee->delete();
            if($delete){
                Toastr()->success("Employee Deleted Successfully");
                return redirect()->route('employee.index');
            } else{
                Toastr()->error("Failed to Delete Employee");
                return redirect()->back();
            }
        } else{
            Toastr()->error("Employee Not Found");
            return redirect()->back();
        }
    }
}
