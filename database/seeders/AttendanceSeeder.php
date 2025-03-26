<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $attendances = [];
        for ($i = 0; $i <= 1000; $i++) {

            $attendances[] = [
                "employee_id" => 1,
                "attendance_date" => Carbon::yesterday()->format("Y-m-d"),
                "attendance_checkin" => "8:00",
                "attendance_checkout" => "19:30",
                "hours_worked" => "11",
                "attendance_status" => "Late",
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }


        info(count($attendances));
        Attendance::insert($attendances);
    }
}
