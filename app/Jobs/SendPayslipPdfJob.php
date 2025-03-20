<?php

namespace App\Jobs;

use App\Mail\PayslipPDFSentMail;
use App\Trait\CustomMailConfigTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
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
        Mail::to($this->email)->send(new PayslipPDFSentMail($this->path));

        if (file_exists($this->path)) {
            unlink($this->path);
        }
    }
}
