<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoSatSunAttendanceMarker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-sat-sun-attendance-marker';

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
        $now = Carbon::now();
        $employees = Employee::all();

        $employees_count = $employees->count();
        $attendances_count = Attendance::whereDate("attendance_date", $now)->count();



        if ($employees_count == $attendances_count) {
            info("Attendance Already Marked for " . $now->dayName);
            return;
        }

        $sat_attendances = [];
        $sun_attendances = [];

        if ($now->isSaturday()) {
            foreach ($employees as $employee) {

                $sat_attendances[] =  [
                    "employee_id" => $employee->id,
                    "attendance_date" => $now->format("Y-m-d"),
                    "attendance_status" => "Saturday",
                    "attendance_checkin" => "Saturday",
                    "attendance_checkout" => "Saturday",
                    "leave_type" => "Saturday",
                    "hours_worked" => 0,
                    "created_at" => $now,
                    "updated_at" => $now,
                ];
            }

            info("Saturday Attendance Marked");
        } elseif ($now->isSunday()) {

            foreach ($employees as $employee) {

                $sun_attendances = [
                    "employee_id" => $employee->id,
                    "attendance_date" => $now->format("Y-m-d"),
                    "attendance_status" => "Sunday",
                    "attendance_checkin" => "Sunday",
                    "attendance_checkout" => "Sunday",
                    "leave_type" => "Sunday",
                    "hours_worked" => 0,
                    "created_at" => $now,
                    "updated_at" => $now,

                ];


                info("Sunday Attendance Marked");
            }
        } else {

            info("No Given Day Found To Mark Attendance");
        }




        if (isset($sat_attendances) && count($sat_attendances) > 0) {
            Attendance::insert($sat_attendances);
        } elseif (isset($sun_attendances) && count($sun_attendances) > 0) {
            Attendance::insert($sun_attendances);
        }
    }
}
