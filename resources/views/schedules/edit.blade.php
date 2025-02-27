@extends('layouts.app')

@section('title', 'Schedule')

@section('css')

    <style>
        .info-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #3d3f5a;
            color: #fff;
            font-size: 14px;
            margin-left: 5px;
            cursor: pointer;
            position: relative;
        }

        .info-icon i {
            font-size: 12px;
        }

        .info-icon::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 150%;
            left: 50%;
            background-color: #3d3f5a;
            color: #fff;
            padding: 5px 8px;
            border-radius: 4px;
            white-space: nowrap;
            font-size: 12px;
            white-space: pre-line;
            width: 250px;
            max-width: 300px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s;
            z-index: 1;
        }

        .info-icon:hover::after {
            opacity: 1;
            visibility: visible;
        }
    </style>

@endsection

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Schedule</h2>
                            <a href="{{ route('schedule.index') }}" class="btn btn-primary">Back To Schedules</a>
                        </div>

                        <form action="{{ route('schedule.update', $schedule) }}" method="POST">
                            @csrf
                            @method('PATCH')


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Schedule Name *</label>
                                        <input class="form-control" type="text" name="name" id="name"
                                            value="{{ $schedule->name }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timepicker" class="col-form-label">Check-in *</label>
                                        <input class="form-control" type="text" name="checkin" id="timepicker"
                                            value="{{ $schedule->checkin }}">
                                        @error('checkin')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timepicker2" class="col-form-label">Check-out *</label>
                                        <input class="form-control" type="text" name="checkout" id="timepicker2"
                                            value="{{ $schedule->checkout }}">
                                        @error('checkout')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="days" class="col-form-label">Days *</label>
                                        <select multiple name="days[]" id="days" class="form-control">
                                            @if (json_decode($schedule->days, true))
                                                <option value="" hidden>Select Days</option>
                                                <option value="Monday"
                                                    {{ in_array('Monday', json_decode($schedule->days, true)) ? 'selected' : '' }}>
                                                    Monday
                                                </option>
                                                <option value="Tuesday"
                                                    {{ in_array('Tuesday', json_decode($schedule->days, true)) ? 'selected' : '' }}>
                                                    Tuesday
                                                </option>
                                                <option value="Wednesday"
                                                    {{ in_array('Wednesday', json_decode($schedule->days, true)) ? 'selected' : '' }}>
                                                    Wednesday
                                                </option>
                                                <option value="Thursday"
                                                    {{ in_array('Thursday', json_decode($schedule->days, true)) ? 'selected' : '' }}>
                                                    Thursday
                                                </option>
                                                <option value="Friday"
                                                    {{ in_array('Friday', json_decode($schedule->days, true)) ? 'selected' : '' }}>
                                                    Friday
                                                </option>
                                                <option value="Saturday"
                                                    {{ in_array('Saturday', json_decode($schedule->days, true)) ? 'selected' : '' }}>
                                                    Saturday
                                                </option>
                                                <option value="Sunday"
                                                    {{ in_array('Sunday', json_decode($schedule->days, true)) ? 'selected' : '' }}>
                                                    Sunday
                                                </option>
                                            @else
                                                <option value="" hidden>Select Days</option>
                                                <option value="Monday">
                                                    Monday
                                                </option>
                                                <option value="Tuesday">
                                                    Tuesday
                                                </option>
                                                <option value="Wednesday">
                                                    Wednesday
                                                </option>
                                                <option value="Thursday">
                                                    Thursday
                                                </option>
                                                <option value="Friday">
                                                    Friday
                                                </option>
                                                <option value="Saturday">
                                                    Saturday
                                                </option>
                                                <option value="Sunday">
                                                    Sunday
                                                </option>
                                            @endif
                                        </select>
                                        @error('days')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group align-content-center">
                                        <label for="num_of_min_before_checkin" class="col-form-label">On Time Minutes *
                                            <small class="info-icon"
                                                data-tooltip="Specify the number of minutes before the scheduled check-in time So It Will Take Attendance As On Time  For example, if you set it to 30 minutes, employees Attendance Will be marked as OnTime">
                                                <i class="fa fa-info"></i>
                                            </small>
                                        </label>
                                        <input class="form-control" type="text" name="num_of_min_before_checkin"
                                            id="num_of_min_before_checkin"
                                            value="{{ $schedule->num_of_min_before_checkin }}">
                                        @error('num_of_min_before_checkin')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group align-content-center">
                                        <label for="shift_start_time" class="col-form-label">Shift Start Time *
                                            <small class="info-icon"
                                                data-tooltip="Specify the number of minutes before the Shift Start Time when attendance will be accepted. For example, if you set it to 30 minutes, employees can check in For This Shift Otherwise It Will Be Marked as Out Of Shift.">
                                                <i class="fa fa-info"></i>
                                            </small>
                                        </label>
                                        <input class="form-control" type="text" name="shift_start_time"
                                            id="shift_start_time" value="{{ $schedule->shift_start_time }}">
                                        @error('shift_start_time')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group align-content-center">
                                        <label for="shift_end_time" class="col-form-label">Shift End Time *
                                            <small class="info-icon"
                                                data-tooltip="Specify the number of minutes After the Checkout Time when Checkout will be accepted. For example, if you set it to 30 minutes, employees can check Out For This Shift Otherwise It Will Be Marked as Out Of Shift.">
                                                <i class="fa fa-info"></i>
                                            </small>
                                        </label>
                                        <input class="form-control" type="text" name="shift_end_time"
                                            id="shift_end_time" value="{{ $schedule->shift_end_time }}">
                                        @error('shift_end_time')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary" type="submit">Update Schedule</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
