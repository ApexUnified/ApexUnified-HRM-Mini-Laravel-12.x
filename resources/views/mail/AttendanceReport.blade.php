@extends("layouts.mail")
@use("App\Models\Setting")
@php
    $setting = Setting::first();
@endphp

@section("main-content")


<div class="header">
   Attendance Yesterdays Report Ready 
 </div>

<div class="content">
    <p>Dear HR,</p>
    <p>Please find all employee yesterday attendance report for reference and record purpose.</p>
    <p>Best Regards,<br><strong>{{$setting->company_name}}</strong></p>
</div>
@endsection
