<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class PayslipPDFSentMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(protected $file_path) {}

    public function build()
    {

        return $this->view('mail.payslip-pdf-sent')
            ->subject('Payslip Of The Month')
            ->attach($this->file_path, [
                'as' => 'payslip.pdf',
                'mime' => 'application/pdf',
            ])
            ->withSwiftMessage(function ($message) {
                if (file_exists($this->file_path)) {
                    unlink($this->file_path);
                }
            });
    }
}
