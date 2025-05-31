@extends('layouts.auth')

@section('title',"Forgot Password")

@section('content')

<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <div class="login-form-head">
                    <h4>Reset Password</h4>
                    <p>Choose Strong Password For The Security</p>
                </div>
                
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

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


                    <div class="form-gp">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password">
                        <i class="ti-lock"></i>
                        <div class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-gp">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        <i class="ti-lock"></i>
                        <div class="text-danger">
                            @error('password_confirmation')
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


























