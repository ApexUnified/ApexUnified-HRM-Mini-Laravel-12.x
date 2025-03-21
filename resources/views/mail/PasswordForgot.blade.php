@extends("layouts.mail")
@use("App\Models\Setting")
@php
    $setting = Setting::first();
@endphp


@section("css")


<style>
     .btn-div{
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        }

        .reset-button{
            background: #435ebe;
            align-content: center !important;
            color: white !important;
            text-decoration: none;
            padding: 6px;
            border-radius: 10px;
        }
</style>

@endsection

@section("main-content")


<div class="header">
   Password Reset Request
 </div>

<div class="content">
    <h3>Hello !</h3>
    <p>You are receiving this email because we received a password reset request for your account.</p>

   <div class="btn-div">
      <a href="{{ config("app.url") . route("password.reset",$token, false) }}" class="reset-button">Reset Password</a>
   </div>

    <p>If you did not request a password reset, no further action is required</p>
    <p>Best Regards,<br><strong>{{$setting->company_name}}</strong></p>



    <div style="margin-top:20px">
        <hr>

        <p style="color: grey">
            if You are Having Trouble For Clicking The Button So You Can Access Directly Link From Here
        </p>
        <a href="{{ config("app.url") . route("password.reset",$token, false) }}">{{ config("app.url") . route("password.reset",$token, false) }}</a>
    </div>
</div>
@endsection
