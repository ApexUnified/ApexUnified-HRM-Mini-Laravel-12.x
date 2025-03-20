@extends("layouts.mail")
@use("App\Models\Setting")
@php
    $setting = Setting::first();
@endphp

@section("main-content")
 <!-- Header Section -->
 <div class="header">
    Payslip Is Ready Take a Look
 </div>

 <!-- Email Content -->
 <div class="content">
        <p>Dear Employee,</p>
        <p>Your payslip for this month is now available. You can download and review your payment details by clicking the Attachment below.</p>
        <p>If you have any questions, please contact HR.</p>
        <p>Best Regards,<br><strong>{{$setting->company_name}}</strong></p>
 </div>


@endsection