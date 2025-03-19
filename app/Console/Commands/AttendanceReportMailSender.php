<?php

namespace App\Console\Commands;

use App\Mail\AttendanceReportMail;
use App\Models\Attendance;
use App\Models\MailLog;
use App\Models\MailSetting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AttendanceReportMailSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:attendance-report-mail-sender';

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
        // Log::info("Running Mail Sender And Checking Time To Send Mail Attendance Report");

        $mail_setting = MailSetting::first();
        if (empty($mail_setting)) {
            return;
        }

        $current_time = Carbon::now();
        $mail_sent_time = Carbon::parse($mail_setting->mail_sent_time);
        $today = Carbon::today();

        $mail_sent_date = MailLog::whereDate('mail_sent', $today)->first();

        // Log::info([
        //     'current Time' =>$current_time->format("H:i"),
        //     'mail sender time' => $mail_sent_time->format("H:i"),
        //     'today' => $today->format("Y-m-d"),

        // ]);

        if ($current_time->isSameMinute($mail_sent_time)) {
            if (!$mail_sent_date) {
                Log::info("Sending Mail ");
                $yesterday = Carbon::yesterday()->format("Y-m-d");
                $attendances = Attendance::where("attendance_date", $yesterday)->get();
                if ($attendances->isNotEmpty()) {
                    $this->sendMail($attendances, $mail_setting, $today);

                    // Log::info("Yesterdays Attendances: " . $attendances);

                } else {
                    return;
                }
            }
        }
    }

    private function sendMail($attendances, $mail_setting, $today)
    {
        $reportDate = Carbon::yesterday()->format('Y_m_d');
        $fileName = 'attendance_report_' . $reportDate . '.csv';
        $directory = public_path("assets/report");
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true);
        }

        $filePath = $directory . '/' . $fileName;

        $file = fopen($filePath, 'w');

        fputcsv($file, [
            'Employee ID',
            'Employee Name',
            'Attendance Date',
            'Hours Worked',
            'Check-In Time',
            'Check-Out Time',
            'Status',
            'Leave Type',
        ]);

        foreach ($attendances as $attendance) {

            $attendance_checkin = null;
            $attendance_checkout = null;

            if ($attendance->attendance_status == "Absent" || $attendance->attendance_status == "Holiday") {
                $attendance_checkin = $attendance->attendance_checkin;
                $attendance_checkout = $attendance->attendance_checkout;
            } else {
                $attendance_checkin = Carbon::parse($attendance->attendance_checkin)->format("h:i A");
                $attendance_checkout = Carbon::parse($attendance->attendance_checkout)->format("h:i A");
            }

            $HoursWorked = number_format($attendance->hours_worked / 60, 2);
            fputcsv($file, [
                $attendance->employee->employee_id,
                $attendance->employee->employee_name,
                $attendance->attendance_date,
                $HoursWorked,
                $attendance_checkin,
                $attendance_checkout,
                $attendance->attendance_status,
                $attendance->leave_type ?? "Employee is Present",
            ]);
        }
        fclose($file);

        if (!file_exists($filePath)) {
            // Log::error("Failed to generate attendance report file: " . $filePath);
            return;
        }

        $mailTo = $mail_setting->mail_to;
        // Send the email with the generated file attached
        Mail::to($mailTo)
            ->send(new AttendanceReportMail($filePath));

        if (file_exists($filePath)) {
            unlink($filePath);
        }


        MailLog::create(['mail_sent' => $today]);
        // Log::info("Mail sent successfully with the attendance report: " . $filePath);

    }
}
