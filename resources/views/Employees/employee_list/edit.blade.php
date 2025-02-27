@extends('layouts.app')

@section('title', 'Employee')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Employee</h2>
                            <a href="{{ route('employee.index') }}" class="btn btn-primary">Back To Employees</a>
                        </div>

                        <form action="{{ route('employee.update', $employee) }}" method="POST" class="w-50">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="employee_name" class="col-form-label">Employee Name *</label>
                                <input class="form-control" type="text" name="employee_name" id="employee_name"
                                    value="{{ $employee->employee_name }}">
                                @error('employee_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="father_name" class="col-form-label">Father Name *</label>
                                <input class="form-control" type="text" name="father_name" id="father_name"
                                    value="{{ $employee->father_name }}">
                                @error('father_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="employee_dob" class="col-form-label">Employee Date of Birth *</label>
                                <input class="form-control" type="text" name="employee_dob" id="employee_dob"
                                    value="{{ $employee->employee_dob }}">
                                @error('employee_dob')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="hiring_date" class="col-form-label">Date Of Hiring *</label>
                                <input class="form-control" type="text" name="date_of_hiring" id="hiring_date"
                                    value="{{ $employee->date_of_hiring }}">
                                @error('date_of_hiring')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="designation" class="col-form-label">Designation *</label>
                                <input class="form-control" type="text" name="designation" id="designation"
                                    value="{{ $employee->designation }}">
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
                                            {{ $department->id == $employee->department_id ? 'selected' : '' }}>
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
                                        <option value="{{ $schedule->id }}"
                                            {{ in_array($schedule->id, explode(',', $employee->employee_schedule)) ? 'selected' : '' }}>
                                            {{ $schedule->name . ' ' }}
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
                                    @php
                                        // Decode the JSON string into a PHP array
                                        $selected_device_ids = json_decode($employee->device_id, true);

                                        // Ensure $selected_device_ids is always an array
                                        if (!is_array($selected_device_ids)) {
                                            $selected_device_ids = [];
                                        }
                                    @endphp

                                    @foreach ($devices as $device)
                                        <option value="{{ $device->id }}"
                                            {{ in_array($device->id, $selected_device_ids) ? 'selected' : '' }}>
                                            {{ $device->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('device_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="device_user_id" class="col-form-label">Device User Id *</label>
                                <input class="form-control" type="number" name="device_user_id" id="device_user_id"
                                    value="{{ $employee->device_user_id }}">
                                @error('device_user_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Update Employee</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
