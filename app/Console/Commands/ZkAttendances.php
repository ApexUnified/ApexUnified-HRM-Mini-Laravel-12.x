<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\OvertimePay;
use App\Models\ZktecoDevice;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Rats\Zkteco\Lib\ZKTeco;

class ZkAttendances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:zk-attendances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Log::info("Checking Attendances From Device");

        $devices = ZktecoDevice::all();
        if ($devices->isNotEmpty()) {
            $timeout = 3;
            foreach ($devices as $device) {
                $isConnected = false;
                $socket = stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
                if ($socket) {
                    fclose($socket);
                    $isConnected = true;
                }

                if ($isConnected) {
                    $zk = new ZKTeco($device->ip_address, $device->port);

                    if ($zk->connect()) {
                        // $zk->testVoice();
                        $attedances = $zk->getAttendance();
                        foreach ($attedances as $attendance) {

                            if ($attendance['type'] == 1) {
                                // Log::info("Checkin Attendance");
                                $this->checkin($attendance, $zk);
                                $zk->clearAttendance();
                            } elseif ($attendance['type'] == 2) {
                                // Log::info("Checkout Attendance");
                                $this->checkout($attendance, $zk);
                                $zk->clearAttendance();
                            }
                        }
                    }
                } else {
                    continue;
                }
            }
        } else {
            Log::info("No Device found");
        }
    }

    private function checkin($attendance, $zk)
    {

        // $checkin = $attendance['timestamp'];
        // $checkout = $request->attendance_checkout;

        // $checkinTime = Carbon::parse($checkin);
        // $checkoutTime = Carbon::parse($checkout);

        // if ($checkoutTime->lessThanOrEqualTo($checkinTime)) {
        //     $checkoutTime->addDay();
        // }

        // $totalMinutes = $checkinTime->diffInMinutes($checkoutTime);

        $attendance_status = null;
        $employee = Employee::where("device_user_id", $attendance['id'])->first();
        $Schedules = $employee->schedules;

        foreach ($Schedules as $schedule) {
            if ($schedule) {
                $scheduled_checkin = Carbon::parse($schedule->checkin);
                $scheduled_checkout = Carbon::parse($schedule->checkout);

                $allowed_early_checkin = $scheduled_checkin->copy()->subMinutes($schedule->num_of_min_before_checkin);
                $shift_start_time = $scheduled_checkin->copy()->subMinutes($schedule->shift_start_time);
                $shift_end_time = $scheduled_checkout->copy()->addMinutes($schedule->shift_end_time);

                if ($scheduled_checkout->lte($scheduled_checkin)) {
                    $shift_end_time->addDay();
                }

                $chekin_time = Carbon::parse($attendance['timestamp']);

                $attendance_checkin = Carbon::parse($chekin_time);


                if ($attendance_checkin->lt($shift_start_time)) {
                    $attendance_checkin->addDay();
                }

                $existingCheckin = Attendance::where("employee_id", $employee->id)->where("attendance_checkout", '=', null,)->where("attendance_checkin", $attendance_checkin)->first();
                $existingCheckin_today = Attendance::where("employee_id", $employee->id)->where("attendance_checkout", '=', null,)->where("attendance_date", \Carbon\Carbon::now()->format("Y-m-d"))->first();

                if ($existingCheckin || $existingCheckin_today) {
                    // Log::info("Employee Checkin Already Exists");
                    continue;
                }

                if ($attendance_checkin->between($shift_start_time, $shift_end_time)) {

                    if ($attendance_checkin->between($allowed_early_checkin, $scheduled_checkin)) {
                        $attendance_status = "On-Time"; // Valid on-time check-in
                    } elseif ($attendance_checkin->gt($scheduled_checkin)) {
                        $attendance_status = "Late"; // Late check-in
                    } elseif ($attendance_checkin->lt($allowed_early_checkin)) {
                        $attendance_status = "Early"; // Early check-in
                    }
                }
            }
        }

        // If $attendance_status is not set, handle it
        if (!isset($attendance_status)) {
            // Log::info("Employee is Out Of Shift");
            return;
        }

        $create = Attendance::create([
            'employee_id' => $employee->id,
            'attendance_checkin' => $attendance['timestamp'],
            'attendance_status' => $attendance_status,
            'attendance_date' => Carbon::now()->format("Y-m-d"),
            'leave_type' => "Employee Is Present",
            'hours_worked' => null,
        ]);
        if ($create) {
            Log::info("created Attendance " . $create);
            Log::info("attendance_created");
            Log::info("Attendance Checkin Created Status: " . $attendance_status);
        } else {
            // Log::info("Error Occured While Attendance Checkin Creation Status:");

        }
    }

    private function checkout($attendance, $zk)
    {
        $employee = Employee::where("device_user_id", $attendance['id'])->first();
        $attendanceTime = Carbon::parse($attendance['timestamp']);
        Log::info($attendanceTime);
        // exit();
        $currentDate = $attendanceTime->copy()->format("Y-m-d");
        $shiftEndTime = null;
        $Schedules = $employee->schedules;
        $atttendance_hours_worked = null;


        foreach ($Schedules as $schedule) {
            if ($schedule) {
                $scheduled_checkin = Carbon::parse($schedule->checkin);
                $scheduled_checkout = Carbon::parse($schedule->checkout);

                if ($scheduled_checkout->lte($scheduled_checkin)) {
                    $scheduled_checkout->addDay();
                }

                $chekout_time = Carbon::parse($attendance['timestamp']);

                $attendance_checkout = Carbon::parse($chekout_time);

                $shift_start_time = $scheduled_checkin->copy()->subMinutes($schedule->shift_start_time);
                $shift_end_time = $scheduled_checkout->copy()->addMinutes($schedule->shift_end_time);



                if (!$attendance_checkout->between($shift_start_time, $shift_end_time)) {
                    Log::info('Attendance is NOT within the current schedule.');
                    continue;
                }



                $shiftEndTime = $shift_end_time;
                // Log::info("Checkout Time " . $attendance_checkout);
                // Log::info("Shift End Time " . $shiftEndTime);

            } else {
                continue;
            }
        }

        $ExistsAttendance = Attendance::where("employee_id", $employee->id)
            ->whereNull("attendance_checkout")
            ->first();
        // ->where("attendance_date",Carbon::now()->format("Y-m-d"))
        // ->where(function ($query) use ($currentDate, $attendanceTime) {
        //     $query->where("attendance_date", $currentDate)
        //         ->orWhere("attendance_date", $attendanceTime->subDay()->format("Y-m-d"));
        // })

        //    Multiple Shifts Seprate Checkout   Query
        // ->where(function ($query) use ($currentDate, $attendanceTime, $currentShift) {
        //     $query->where("attendance_date", $currentDate)
        //         ->where("shift_id", $currentShift->id) // Match the correct shift
        //         ->orWhere(function ($subQuery) use ($attendanceTime, $currentShift) {
        //             $subQuery->where("attendance_date", $attendanceTime->subDay()->format("Y-m-d"))
        //                 ->where("shift_id", $currentShift->id);
        //         });
        // })

        if (!empty($ExistsAttendance)) {
            // Log::info(Carbon::now()->format("Y-m-d"));

            $checkout = $attendance['timestamp'];

            $checkinTime = Carbon::parse($ExistsAttendance->attendance_checkin);
            $checkoutTime = Carbon::parse($checkout);

            if ($checkoutTime->lessThanOrEqualTo($checkinTime)) {
                $checkoutTime->addDay();
            }


            $atttendance_hours_worked = $checkinTime->diffInMinutes($checkoutTime);

            // Log::info($shiftEndTime);
            // exit();
            // Log::info("End Shift InCheckout " . $shiftEndTime);
            // if ($shiftEndTime instanceof Carbon) {
            //     // Log::info("Yes, this is a Carbon instance._");
            // } else {
            //     // Log::info("No, this is not a Carbon instance." . $shiftEndTime);
            // }
            //    exit();





            if ($attendance_checkout->gt($scheduled_checkout)) {
                $difference = $scheduled_checkout->diffInHours($attendance_checkout);
                $overtime_pay = OvertimePay::first();


                if (!empty($overtime_pay)) {
                    $overtime = Overtime::create([
                        "employee_id" => $employee->id,
                        "hours_worked" => $difference,
                        "rate_per_hour" => $overtime_pay->overtime_pay,
                        "total_overtime_pay" => $difference  * $overtime_pay->overtime_pay
                    ]);
                }
            }

            $ExistsAttendance->attendance_checkout = $attendance_checkout;
            $ExistsAttendance->hours_worked = $atttendance_hours_worked;
            $ExistsAttendance->save();

            //  Log::info("Attendance Checkout Created");

        }
    }
}
