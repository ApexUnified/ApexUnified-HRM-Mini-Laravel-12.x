@php
    $setting = \App\Models\Setting::first();
@endphp
<img src="{{ asset('assets/images/logo/' . $setting->system_logo) }}" alt="logo"
    style="width: 100px; object-fit:contain; border-radius:1rem">
