<?php

namespace App\Http\Controllers;

use App\Events\QueueEnvRefresh;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MailSettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:Settings View", ["only" => "index"]),
            new Middleware("permission:Settings View", ["only" => "store"])
        ];
    }

    public function index()
    {
        $mail_setting = MailSetting::first();
        return view("setting.mail-setting.index", compact("mail_setting"));
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'mail_mailer' => 'required|min:2',
            'mail_host' => 'required',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|email',
            'mail_password' => 'required|min:2',
            'mail_encryption' => 'required|min:2',
            'mail_from' => 'required|email',
            'mail_from_name' => 'required|min:3',
            'mail_to' => 'required|email',
            'mail_sent_time' => 'required'
        ]);


        $mail_setting = MailSetting::first();
        if (empty($mail_setting)) {
            MailSetting::create($validated_req);
        } else {
            $mail_setting->update($validated_req);
        }


        Toastr()->success("Mail setting Setup Succesfully");
        return redirect()->route('mail-setting.index');
    }
}
