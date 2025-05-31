@php
    $setting = \App\Models\Setting::first();
@endphp


@if(!empty($setting->system_logo))

    <img src="{{ asset('assets/images/logo/' . $setting->system_logo) }}" alt="logo"
    style="width: 100px; object-fit:contain; border-radius:1rem">


    @else

    <img src="{{ asset('assets/images/SystemLogo.png')}}" alt="logo"
    style="width: 100px; object-fit:contain; border-radius:1rem">
@endif
