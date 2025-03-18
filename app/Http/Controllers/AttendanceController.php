<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\OvertimePay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AttendanceController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Attendance View", ["only" => "index"]),
            new Middleware("permission:Attendance Create", ["only" => "create", "store"]),
            new Middleware("permission:Attendance Edit", ["only" => "edit", "update"]),
            new Middleware("permission:Attendance Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index(Request $request)
    {
        $attendances = Attendance::query();

        if (!empty($request->from) && !empty($request->to)) {
            $fromDate = Carbon::parse($request->from)->format("Y-m-d");
            $toDate = Carbon::parse($request->to)->endOfDay()->format("Y-m-d H:i:s");
            $attendances = $attendances->whereBetween("attendance_date", [$fromDate, $toDate]);
        } else if (!empty($request->from)) {
            $fromDate = Carbon::parse($request->from)->format("Y-m-d");
            $attendances = Attendance::whereDate("attendance_date", $fromDate);
        } else if (!empty($request->to)) {
            $toDate = Carbon::parse($request->to)->format("Y-m-d");
            $attendances = Attendance::whereDate("attendance_date", $toDate);
        }

        $attendances = $attendances->orderBy("created_at", "Desc")->get();

        return view("attendance.index", compact("attendances"));
    }

    public function create()
    {
        $employees = Employee::all();
        return view("attendance.create", compact("employees"));
    }

    public function store(Request $request)
    {

        // return $request->all();

        $rules = [
            'employee_id' => 'required|numeric',
            'attendance_date' => 'required|date',
            'leave_type' => 'nullable|string',
        ];

        if (!empty($request["leave_type"])) {
            $rules['attendance_checkin'] = 'nullable';
            $rules['attendance_checkout'] = 'nullable';
            $rules['hours_worked'] = 'nullable|numeric';
        } else {
            $rules['attendance_checkin'] = 'required';
            $rules['attendance_checkout'] = 'required';
        }

        $validated_req = $request->validate($rules);

        $checkin = $request->attendance_checkin;
        $checkout = $request->attendance_checkout;

        $checkinTime = Carbon::parse($checkin);
        $checkoutTime = Carbon::parse($checkout);

        if ($checkoutTime->lessThanOrEqualTo($checkinTime)) {
            $checkoutTime->addDay();
        }

        $totalMinutes = $checkinTime->diffInMinutes($checkoutTime);
        $validated_req['hours_worked'] = $totalMinutes;

        // return $validated_req;
        if (!empty($request["leave_type"])) {
            $validated_req['attendance_checkin'] = "Absent";
            $validated_req['attendance_checkout'] = "Absent";
            $validated_req['hours_worked'] = 0;
            $validated_req['attendance_status'] = "Absent";
        }

        // No More Needed
        // $attendance = Attendance::where('employee_id',$validated_req['employee_id'])->where('attendance_date',$validated_req['attendance_date'])->first();

        // if(!empty($attendance))
        // {
        //     $searching_employee = Employee::find($validated_req["employee_id"]);
        //     foreach($searching_employee->schedules as $schedule){
        //         if($schedule){
        //             $schedule_exists_in_attendance = Attendance::where("attendance_checkin",$schedule->checkin)->where('employee_id',$validated_req['employee_id'])->where('attendance_date',$validated_req['attendance_date'])->first();
        //             return $schedule_exists_in_attendance;
        //         }
        //     }

        //         Toastr()->error("Attendance already taken for the selected date Of This Employee");
        //         return redirect()->back();
        // }

        if (empty($request["leave_type"])) {
            $attendance_status = null;
            $employee = Employee::find($validated_req['employee_id']);
            $Schedules = $employee->schedules;
            foreach ($Schedules as $schedule) {
                if ($schedule) {

                    // Parse shift times
                    $scheduled_checkin = Carbon::parse($schedule->checkin);
                    $scheduled_checkout = Carbon::parse($schedule->checkout);

                    $allowed_early_checkin = $scheduled_checkin->copy()->subMinutes($schedule->num_of_min_before_checkin);
                    $shift_start_time = $scheduled_checkin->copy()->subMinutes($schedule->shift_start_time);
                    $shift_end_time = $scheduled_checkout->copy()->addMinutes($schedule->shift_end_time);

                    if ($scheduled_checkout->lte($scheduled_checkin)) {
                        $shift_end_time->addDay();
                        // return $scheduled_checkout->format("g:i:A y-m-d");
                    }

                    $attendance_checkin = Carbon::parse($validated_req['attendance_checkin']);
                    $attendance_checkout = Carbon::parse($validated_req['attendance_checkout']);


                    if ($attendance_checkout->lt($attendance_checkin)) {
                        $attendance_checkout->addDay();
                    }

                    if ($attendance_checkin->lt($shift_start_time)) {
                        $attendance_checkin->addDay();
                    }

                    if ($attendance_checkin->between($shift_start_time, $shift_end_time)) {

                        // return $shift_end_time->format("H:i");


                        if ($attendance_checkin->between($allowed_early_checkin, $scheduled_checkin)) {
                            $attendance_status = "On-Time"; // Valid on-time check-in
                            // return "On time";
                        } elseif ($attendance_checkin->gt($scheduled_checkin)) {
                            $attendance_status = "Late"; // Late check-in
                            // return "Late";
                        } elseif ($attendance_checkin->lt($allowed_early_checkin)) {
                            $attendance_status = "Early"; // Early check-in
                            // return "Early";
                        }
                    }

                    if ($attendance_checkout->gt($scheduled_checkout)) {

                        $difference = $scheduled_checkout->diffInHour($attendance_checkout);
                        $overtime_pay = OvertimePay::first();

                        if (!empty($overtime_pay)) {
                            $overtime = Overtime::create([
                                "employee_id" => $validated_req['employee_id'],
                                "hours_worked" => $difference,
                                "rate_per_hour" => $overtime_pay->overtime_pay,
                                "total_overtime_pay" => $difference  * $overtime_pay->overtime_pay
                            ]);

                            if ($overtime) {
                                Toastr()->success("Overtime Also Added");
                            } else {
                                Toastr()->error("Failed to Add Overtime");
                            }
                        }
                    }
                }
            }


            // If $attendance_status is not set, handle it

            if (!isset($attendance_status)) {
                Toastr()->error("Employee is Out Of Shift");
                return redirect()->back();
            }

            $validated_req["attendance_status"] = $attendance_status;
            // return $validated_req;
        }
        // return $validated_req;
        $create = Attendance::create($validated_req);
        if ($create) {
            Toastr()->success("attendance created successfully");
            return redirect()->route('attendance.index');
        } else {
            Toastr()->error("Failed to create attendance");
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("attendance_ids");
        $attendaces = Attendance::whereIn('id', $ids)->delete();
        if (!empty($attendaces)) {
            return response()->json([
                'status' => true,
                'message' => "Attendance deleted successfully",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete attendance",
            ]);
        }
    }

    public function edit(string $id)
    {

        $attendance = Attendance::find($id);
        if (empty($attendance)) {
            Toastr()->error("Attendance not found");
            return redirect()->back();
        }
        return view("attendance.edit", compact("attendance"));
    }

    public function update(Request $request, string $id)
    {
        $rules = [
            'employee_id' => 'required|numeric',
            'attendance_date' => 'required|date',
            'leave_type' => 'nullable|string',
        ];

        if (!empty($request["leave_type"])) {
            $rules['attendance_checkin'] = 'nullable';
            $rules['attendance_checkout'] = 'nullable';
            $rules['hours_worked'] = 'nullable|numeric';
        } else {
            $rules['attendance_checkin'] = 'required';
        }

        $validated_req = $request->validate($rules);
        $attendance = Attendance::find($id);

        if ($attendance->hours_worked != 9999999999) {

            $checkin = $request->attendance_checkin;
            $checkout = $request->attendance_checkout;

            $checkinTime = Carbon::parse($checkin);
            $checkoutTime = Carbon::parse($checkout);

            if ($checkoutTime->lessThanOrEqualTo($checkinTime)) {
                $checkoutTime->addDay();
            }

            $totalMinutes = $checkinTime->diffInMinutes($checkoutTime);
            $validated_req['hours_worked'] = $totalMinutes;
        } else {
            $validated_req['hours_worked'] = $attendance->hours_worked;
        }

        if ($request->attendance_checkout == null) {
            $validated_req['attendance_checkout'] = $attendance->attendance_checkout;
        } else {
            $validated_req['attendance_checkout'] = $request->attendance_checkout;
        }
        if (!empty($request["leave_type"])) {

            $validated_req['attendance_checkin'] = "Absent";
            $validated_req['attendance_checkout'] = "Absent";
            $validated_req['hours_worked'] = 0;
            $validated_req['attendance_status'] = "Absent";
        }

        if ($attendance->update($validated_req)) {
            Toastr()->success("Attendance updated successfully");
            return redirect()->route('attendance.index');
        } else {
            Toastr()->error("Failed to update attendance");
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        $attendance = Attendance::find($id);
        if ($attendance->delete()) {
            Toastr()->success("Attendance deleted successfully");
            return redirect()->route('attendance.index');
        } else {
            Toastr()->error("Failed to delete attendance");
            return redirect()->back();
        }
    }
}
