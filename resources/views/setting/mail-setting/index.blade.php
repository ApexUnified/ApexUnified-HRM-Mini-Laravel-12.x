@extends('layouts.app')

@section('title', 'Mail Setting')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Mail Setting</h2>
                        </div>

                        <div class="card-body mb-5">
                            <form method="POST" action="{{ route('mail-setting.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Mailer *</label>
                                            <input type="text" name="mail_mailer" class="form-control"
                                                value="{{ $mail_setting->mail_mailer ?? old('mail_host') }}" required=""
                                                placeholder="SMTP">
                                            <small class="text-danger">
                                                @error('mail_mailer')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Host *</label>
                                            <input type="text" name="mail_host" class="form-control"
                                                value="{{ $mail_setting->mail_host ?? old('mail_host') }}" required=""
                                                placeholder="Mail Host">
                                            <small class="text-danger">
                                                @error('mail_host')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Port *</label>
                                            <input type="text" name="mail_port" class="form-control"
                                                value="{{ $mail_setting->mail_port ?? old('mail_port') }}" required=""
                                                placeholder="Mail Port">
                                            <small class="text-danger">
                                                @error('mail_port')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail UserName Email *</label>
                                            <input type="email" name="mail_username" class="form-control"
                                                value="{{ $mail_setting->mail_username ?? old('mail_username') }}"
                                                required="" placeholder="Mail UserName">
                                            <small class="text-danger">
                                                @error('mail_username')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Password *</label>
                                            <input type="password" name="mail_password" class="form-control"
                                                value="{{ $mail_setting->mail_password ?? old('mail_password') }}"
                                                required="" placeholder="Mail Host">
                                            <small class="text-danger">
                                                @error('mail_password')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Encryption *</label>
                                            <input type="text" name="mail_encryption" class="form-control"
                                                value="{{ $mail_setting->mail_encryption ?? old('mail_encryption') }}"
                                                required="" placeholder="Mail Encryption">
                                            <small class="text-danger">
                                                @error('mail_encryption')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail From Email *</label>
                                            <input email="text" name="mail_from" class="form-control"
                                                value="{{ $mail_setting->mail_from ?? old('mail_from') }}" required=""
                                                placeholder="Mail From">
                                            <small class="text-danger">
                                                @error('mail_from')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail From Name *</label>
                                            <input type="text" name="mail_from_name" class="form-control"
                                                value="{{ $mail_setting->mail_from_name ?? old('mail_from_name') }}"
                                                required="" placeholder="Mail From Name">
                                            <small class="text-danger">
                                                @error('mail_from_name')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Attendance Report Receiver Email (HR Email) *</label>
                                            <input type="email" name="mail_to" class="form-control"
                                                value="{{ $mail_setting->mail_to ?? old('mail_to') }}" required=""
                                                placeholder="Mail To">
                                            <small class="text-danger">
                                                @error('mail_to')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Mail Sent Time *</label>
                                            <input type="text" name="mail_sent_time" id="timepicker"
                                                class="form-control"
                                                value="{{ $mail_setting->mail_sent_time ?? old('mail_sent_time') }}"
                                                required="" placeholder="Mail Sent Time">
                                            <small class="text-danger">
                                                @error('mail_sent_time')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mb-3">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
