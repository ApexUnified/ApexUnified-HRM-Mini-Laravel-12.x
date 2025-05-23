<?php

namespace App\Jobs;

use App\Mail\PayslipPDFSentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPayslipPdfJob implements ShouldQueue
{
    use Queueable;


    public function __construct(protected $email, protected $path) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Path Of PDF In Payslip PDF Send JOB " . $this->path);

        // Changed Into URL From public_path Because On Laravel Cloud it wasnt wokring but now working with url
        Mail::to($this->email)->send(new PayslipPDFSentMail(url("assets/pdfs/$this->path")));
    }
}
