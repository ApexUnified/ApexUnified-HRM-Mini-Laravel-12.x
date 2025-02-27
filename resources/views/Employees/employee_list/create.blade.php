@extends('layouts.app')

@section('title', 'Employee')

@section('content')

    <div class="main-content-inner">
        <div class="row">

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Employee</h2>
                            <a href="{{ route('employee.index') }}" class="btn btn-primary">Back To Employees</a>
                        </div>

                        <form action="{{ route('employee.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="employee_name" class="col-form-label">Employee Name *</label>
                                <input class="form-control" type="text" name="employee_name" id="employee_name"
                                    value="{{ old('employee_name') }}">
                                @error('employee_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="father_name" class="col-form-label">Father Name *</label>
                                <input class="form-control" type="text" name="father_name" id="father_name"
                                    value="{{ old('father_name') }}">
                                @error('father_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="employee_dob" class="col-form-label">Employee Date of Birth *</label>
                                <input class="form-control" type="text" name="employee_dob" id="employee_dob"
                                    value="{{ old('employee_dob') }}">
                                @error('employee_dob')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="date_of_hiring" class="col-form-label">Date Of Hiring *</label>
                                <input class="form-control" type="text" name="date_of_hiring" id="employee_dob"
                                    value="{{ old('date_of_hiring') }}">
                                @error('date_of_hiring')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="designation" class="col-form-label">Designation *</label>
                                <input class="form-control" type="text" name="designation" id="designation"
                                    value="{{ old('designation') }}">
                                @error('designation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="department_id" class="col-form-label">Department *</label>
                                <select class="form-control" type="text" name="department_id" id="department_id"
                                    style="cursor: pointer;">
                                    <option value="" hidden>Select Department </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="employee_schedule" class="col-form-label">Schedule *</label>
                                <select multiple class="form-control" type="text" name="employee_schedule[]"
                                    id="employee_schedule" style="cursor: pointer;">
                                    <option value="" hidden>Select Schedule </option>
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}">{{ $schedule->name . ' ' }}
                                            {{ $schedule->FormattedTimes['checkin'] . ' - ' . $schedule->FormattedTimes['checkout'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_schedule')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="device_id" class="col-form-label">ZkTeco Devices *</label>
                                <select class="form-control" type="text" name="device_id[]" id="device_id"
                                    style="cursor: pointer;" multiple>
                                    <option value="" hidden>Select Device </option>
                                    @foreach ($devices as $device)
                                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                                    @endforeach
                                </select>
                                @error('device_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="device_user_id" class="col-form-label">Device User Id *</label>
                                <input class="form-control" type="number" name="device_user_id" id="device_user_id"
                                    value="{{ old('device_user_id') }}">
                                @error('device_user_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <button class="btn btn-primary" type="submit">Create Employee</button>


                    </div>
                </div>
            </div>


        </div>

    @endsection

    @section('js')



        <script>
            $(document).ready(function() {
                $("#user_checkbox").on("change", function() {
                    const name_label = $("#name-label");
                    const name = $("#name");

                    const email_label = $("#email-label");
                    const email = $("#email");

                    const password_label = $("#password-label");
                    const password = $("#password");

                    const password_confirmation_label = $("#password_confirmation-label");
                    const password_confirmation = $("#password_confirmation");

                    const role_label = $("#role-label");
                    const role = $("#role");

                    const name_message = $("#name-message");
                    const email_message = $("#email-message");
                    const password_message = $("#password-message");
                    const password_confirmation_message = $("#password_confirmation-message");
                    const role_message = $("#role-message");

                    if ($(this).is(":checked")) {
                        name_label.css("display", "block");
                        name.css("display", "block");

                        email_label.css("display", "block");
                        email.css("display", "block");

                        password_label.css("display", "block");
                        password.css("display", "block");

                        password_confirmation_label.css("display", "block");
                        password_confirmation.css("display", "block");

                        role_label.css("display", "block");
                        role.css("display", "block");

                        name_message.css("display", "block");
                        email_message.css("display", "block");
                        password_message.css("display", "block");
                        password_confirmation_message.css("display", "block");
                        role_message.css("display", "block");

                    } else {
                        name_label.css("display", "none");
                        name.css("display", "none");

                        email_label.css("display", "none");
                        email.css("display", "none");

                        password_label.css("display", "none");
                        password.css("display", "none");

                        password_confirmation_label.css("display", "none");
                        password_confirmation.css("display", "none");

                        role_label.css("display", "none");
                        role.css("display", "none");


                        name_message.css("display", "none");
                        email_message.css("display", "none");
                        password_message.css("display", "none");
                        password_confirmation_message.css("display", "none");
                        role_message.css("display", "none");

                    }

                });
            });
        </script>
    @endsection
