<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutoAbsentMarker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-absent-marker';

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

        if (Employee::exists()) {
            $now = Carbon::now();
            if ($now->gt(Carbon::today()->setHour(23)) && $now->lt(Carbon::today()->setHour(23)->setMinute(30))) {
                Log::info("Scheudle Matched And Starting Marking Auto Absent");

                // Logic to Mark Auto Absent Employees Here 

                $current_date = Carbon::now()->format("Y-m-d");
                $holiday = Holiday::whereDate("holiday_date", $current_date)->first();

                $batchSIZE = 1000;
                $absentData = [];
                $now = Carbon::now();


                $existing_attendance = Attendance::whereDate("attendance_date", $current_date)
                    ->pluck("employee_id")
                    ->toArray();


                $absent_employees = Employee::whereNotIn("id", $existing_attendance);
                $absent_employees->chunk(1000, function ($employees) use (&$absentData, $current_date, $now, $holiday, $batchSIZE) {
                    foreach ($employees as $employee) {

                        if (!empty($holiday)) {
                            $absentData[] = [
                                "employee_id" => $employee->id,
                                "attendance_date" => $current_date,
                                "attendance_status" => "Holiday",
                                "attendance_checkin" => "Holiday",
                                "attendance_checkout" => "Holiday",
                                "leave_type" => "Holiday",
                                "hours_worked" => 0,
                                "created_at" => $now,
                                "updated_at" => $now,
                            ];
                        } else {
                            $absentData[] = [
                                "employee_id" => $employee->id,
                                "attendance_date" => $current_date,
                                "attendance_status" => "Absent",
                                "attendance_checkin" => "Absent",
                                "attendance_checkout" => "Absent",
                                "leave_type" => "Absent",
                                "hours_worked" => 0,
                                "created_at" => $now,
                                "updated_at" => $now,
                            ];
                        }
                    }

                    if (count($absentData) >= $batchSIZE) {
                        Attendance::insert($absentData);
                        $absentData = [];
                    }
                });




                if (isset($absentData) && count($absentData) > 0) {
                    Attendance::insert($absentData);
                    Log::info(count($absentData) . " employees marked absent.");
                } else {
                    Log::info("No Absent Employee Found");
                }
            } else {
                Log::info("Currently Not In Time To Run Absent Marker Schedular");
            }
        } else {
            Log::info("currently No Employee Exists So Process Has Been Terminated");
        }
    }
}
