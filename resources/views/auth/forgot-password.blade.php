@extends('layouts.auth')

@section('title',"Forgot Password")

@section('content')

<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="login-form-head">
                    <h4>Fotgot Password?</h4>
                    <p>Dont Worry Here You Can Reset Your Password</p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="email">Enter Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}">
                        <i class="ti-email"></i>
                        <div class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="submit-btn-area mt-5">
                        <button id="form_submit" type="submit">Get Reset Link <i class="ti-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection















{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
