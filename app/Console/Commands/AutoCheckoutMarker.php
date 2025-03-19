<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutoCheckoutMarker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-checkout-marker';

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
        $attendances = Attendance::whereNot("attendance_status", "Absent")->whereNot("attendance_status", "Holiday")->get();
        if ($attendances->isNotEmpty()) {
            foreach ($attendances as $attendance) {
                $schedules = $attendance->employee->schedules;
                $attendance_checkin = Carbon::parse($attendance->attendance_checkin);
                $checkoutMarked = false; // Track if checkout is marked for logs

                foreach ($schedules as $schedule) {
                    $scheduled_checkin = Carbon::parse($schedule->checkin);
                    $scheduled_checkout = Carbon::parse($schedule->checkout);



                    // Handle schedules spanning midnight
                    if ($scheduled_checkout->lte($scheduled_checkin)) {
                        $scheduled_checkout->addDay();
                    }

                    $shift_start_time = $scheduled_checkin->copy()->subMinutes($schedule->shift_start_time);
                    $shift_end_time = $scheduled_checkout->copy()->addMinutes($schedule->shift_end_time);
                    // Log::info( $shift_end_time->isTomorrow() );
                    // Log::info("Current Time: " . Carbon::now()->toDateTimeString());
                    // Log::info("Shift End Time: " . $shift_end_time->toDateTimeString());
                    // exit();
                    if ($attendance_checkin->between($shift_start_time, $shift_end_time)) {

                        $currentTime = Carbon::now()->format('H:i:s');
                        $shiftEndTime = $shift_end_time->format('H:i:s');


                        // Log::info("Current Time Converted : " .$currentTime);
                        // Log::info("Shift End Time Converted : " . $shiftEndTime);


                        if (Carbon::parse($currentTime)->greaterThan($shiftEndTime) && $attendance->attendance_checkout === null) {
                            // Update attendance record
                            $attendance->attendance_checkout = "__________";
                            $attendance->save();

                            Log::info("Automatic checkout marked for Attendance ID: " . $attendance->id . " (Shift End: $shift_end_time)");
                            $checkoutMarked = true;
                        }
                    }
                }

                if (!$checkoutMarked) {
                    // Log::info("No shift has ended for Attendance ID: " . $attendance->id . " or checkout already marked.");
                }
            }
        } else {
            // Log::info("No Attendance Found");
        }
    }
}
