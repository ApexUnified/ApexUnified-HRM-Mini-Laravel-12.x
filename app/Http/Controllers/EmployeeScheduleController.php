<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EmployeeScheduleController extends Controller implements HasMiddleware
{

    public static function middleware() :array 
    {
        return [
            new Middleware("permission:Employee View",["only" => "index"]),
            new Middleware("permission:Employee Edit schedule",["only" => "edit"]),
        ];
    }

    public function index()
    {
        $employees = Employee::orderBy("created_at","DESC")->get();
        return view("Employees.employee_schedule.index",compact("employees"));
    }  

    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $schedules = Schedule::all();
        return view("Employees.employee_schedule.edit",compact("employee","schedules"));
    }


    public function update(Request $request, string $id)
    {

        $validated_req = $request->validate([
            'employee_schedule' => 'required|numeric',
        ]);

        $employee = Employee::find($id);

        if(!empty($employee)){
           $update =  $employee->update($validated_req);

           if($update){
            Toastr()->success("Employee Schedule has been updated");
            return redirect()->route('employeeschedule.index');
           }else{
            Toastr()->error("Failed to update Employee Schedule");
            return redirect()->back();
           }
        }else{
            Toastr()->error("Employee not found");
            return redirect()->back();
        }

    }
}
