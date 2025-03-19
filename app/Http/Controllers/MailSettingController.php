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
            new Middleware("permission:Settings View", ["only" => "index"])
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
            $create = MailSetting::create($validated_req);
        } else {
            $mail_setting->update($validated_req);
        }


        dispatch(new QueueEnvRefresh("MAIL_MAILER",      $validated_req['mail_mailer']))->delay(now()->addSecond(4));
        dispatch(new QueueEnvRefresh("MAIL_HOST",        $validated_req['mail_host']))->delay(now()->addSecond(4));
        dispatch(new QueueEnvRefresh("MAIL_PORT",        $validated_req['mail_port']))->delay(now()->addSecond(4));
        dispatch(new QueueEnvRefresh("MAIL_USERNAME",    $validated_req['mail_username']))->delay(now()->addSecond(4));
        dispatch(new QueueEnvRefresh("MAIL_PASSWORD",    $validated_req['mail_password']))->delay(now()->addSecond(4));
        dispatch(new QueueEnvRefresh("MAIL_ENCRYPTION",  $validated_req['mail_encryption']))->delay(now()->addSecond(4));
        dispatch(new QueueEnvRefresh("MAIL_FROM_ADDRESS", $validated_req['mail_from']))->delay(now()->addSecond(4));
        dispatch(new QueueEnvRefresh("MAIL_FROM_NAME",   $validated_req['mail_from_name']))->delay(now()->addSecond(4));



        Toastr()->success("Mail setting Setup Succesfully");
        return redirect()->route('mail-setting.index');
    }
}
