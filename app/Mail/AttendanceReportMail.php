<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AttendanceReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $file_path;
    public function __construct($file_path)
    {
        $this->file_path = $file_path;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {

        return $this->view('mail.AttendanceReport')
            ->subject('Attendance Report')
            ->attach($this->file_path, [
                'as' => 'attendance_report.csv',
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
    }
}
