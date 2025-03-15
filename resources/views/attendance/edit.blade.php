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
                            <h2 class="display-5">Edit Attendance</h2>
                            <a href="{{ route('attendance.index') }}" class="btn btn-primary">Back To Attendance</a>
                        </div>

                        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST" class="w-50">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="employee_name" class="col-form-label">Employee *</label>
                                <input class="form-control" type="text" hidden name="employee_id"
                                    value="{{ $attendance->employee_id }}" />
                                <input class="form-control" type="text"
                                    value="{{ $attendance->employee->employee_name }}" id="employee_id" disabled />
                                @error('employee_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="attendance_date" class="col-form-label">Attendance Date *</label>
                                <input class="form-control" type="text" name="attendance_date" id="attendance_date"
                                    value="{{ $attendance->attendance_date }}">
                                @error('attendance_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            @php
                            if($attendance->leave_type == "Present")
                                {$checkin = \Carbon\Carbon::parse($attendance->attendance_checkin)->format('H:i');}
                            else {$checkin = null;}
                            @endphp
                            <div class="form-group">
                                <label for="checkin" class="col-form-label">Check In Time *</label>
                                <input class="form-control" type="text" name="attendance_checkin" id="checkin"
                                    value="{{ $checkin }}">
                                @error('attendance_checkin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="checkout" class="col-form-label">Check Out Time *</label>
                                @if ($attendance->attendance_checkout == 5)
                                    <input class="form-control" type="text" name="attendance_checkout" id="checkout">
                                @else
                                    <input class="form-control" type="text" name="attendance_checkout" id="checkout"
                                        value="{{ $attendance->attendance_checkout }}">
                                @endif
                                @error('attendance_checkout')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label for="leave_type" class="col-form-label">Leave Type (If Employee Is On Leave)</label>
                                <select class="form-control" name="leave_type" id="leave_type">
                                    <option value="" hidden>Select Leave Type
                                    </option>
                                    <option value="Absent" {{ $attendance->leave_type == 'Absent' ? 'selected' : '' }}>
                                        Absent</option>
                                    <option value="Sick" {{ $attendance->leave_type == 'Sick' ? 'selected' : '' }}>Sick
                                    </option>
                                    <option value="Casual" {{ $attendance->leave_type == 'Casual' ? 'selected' : '' }}>
                                        Casual</option>
                                    <option value="Medical" {{ $attendance->leave_type == 'Medical' ? 'selected' : '' }}>
                                        Medical</option>
                                    <option value="Emergency"
                                        {{ $attendance->leave_type == 'Emergency' ? 'selected' : '' }}>
                                        Emergency</option>
                                </select>
                                @error('leave_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <button class="btn btn-primary" type="submit">Update Attendance</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
