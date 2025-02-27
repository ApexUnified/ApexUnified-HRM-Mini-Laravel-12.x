@extends('layouts.auth')

@section('title', 'Login')


@section('content')

    @php
        $setting = \App\Models\Setting::first();
    @endphp

    <div class="login-area login-s3">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <img src="{{ asset('assets/images/logo/' . $setting->auth_logo) }}" alt=""
                            style="width: 100px;border-radius:2rem;" class="mb-3">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your System</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="exampleInputEmail1" name="email" value="{{ old('email') }}">
                            <i class="ti-email"></i>
                            <div class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6 text-left">
                                <div class="d-flex align-items-center align-content-center">
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="remember" name="remember">
                                        <div class="checkmark"></div>
                                    </label>
                                    <label for="remember">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.email') }}" style="color:#6e33fb">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>

                        <div class="form-footer text-center mt-5">
                            <p>Dont Have An Account? <a class="fw-bold" style="color:#6e33fb"
                                    href="{{ route('register') }}">Sign Up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
