@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Attendance</h2>
                            <a href="{{ route('attendance.index') }}" class="btn btn-primary">Back To Attendance</a>
                        </div>

                        <form action="{{ route('attendance.store') }}" method="POST" class="w-50">
                            @csrf

                            <div class="form-group">
                                <label for="employee_name" class="col-form-label">Employee *</label>
                                <select class="form-control" type="text" name="employee_id" id="employee_id">
                                    <option value="" hidden>Select Employee </option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="attendance_date" class="col-form-label">Attendance Date *</label>
                                <input class="form-control" type="text" name="attendance_date" id="attendance_date"
                                    value="{{ old('attendance_date') }}">
                                @error('attendance_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="checkin" class="col-form-label">Check In Time *</label>
                                <input class="form-control" type="text" name="attendance_checkin" id="checkin"
                                    value="{{ old('attendance_checkin') }}">
                                @error('attendance_checkin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="checkout" class="col-form-label">Check Out Time *</label>
                                <input class="form-control" type="text" name="attendance_checkout" id="checkout"
                                    value="{{ old('attendance_checkout') }}">
                                @error('attendance_checkout')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label for="leave_type" class="col-form-label">Leave Type (If Employee Is On Leave)</label>
                                <select class="form-control" name="leave_type" id="leave_type">
                                    <option value="" hidden>Select Leave Type</option>
                                    <option value="Absent">Absent</option>
                                    <option value="Sick">Sick</option>
                                    <option value="Casual">Casual</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Emergency">Emergency</option>
                                </select>
                                @error('leave_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <button class="btn btn-primary" type="submit">Create Attendance</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
