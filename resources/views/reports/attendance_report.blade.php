@extends('layouts.app')

@section('title', 'Report')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Attendances Report</h2>



                            <form action="{{ route('attendance.report') }}"
                                class=" d-flex justify-content-center align-items-center" method="GET">
                                <div class="d-flex align-items-center">
                                    <label class="mr-2" for="report_from" style="font-size: 19px">From: </label>
                                    <input type="text" id="report_from" name="from" class="form-control mx-2"
                                        placeholder="yyyy-mm-dd" value="{{ request()->from }}">
                                </div>

                                <div class="d-flex align-items-center">
                                    <label class="mr-2" for="report_to" style="font-size: 19px">To: </label>
                                    <input type="text" id="report_to" name="to" class="form-control"
                                        placeholder="yyyy-mm-dd" value="{{ request()->to }}">
                                </div>

                                <div class="d-flex align-items-center mx-2">
                                    <button class="btn btn-primary">Search</button>
                                </div>

                            </form>


                        </div>




                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="attendance_report_table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Employee Designation</th>
                                            <th>Employee Department</th>
                                            <th>Hours Worked</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Attendance Status</th>
                                            <th>Leave Type</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $attendance)
                                            @php
                                                $date = \Carbon\Carbon::parse($attendance->attendance_date)->format(
                                                    'Y-M-d',
                                                );
                                            @endphp

                                            <tr>
                                                <td>{{ $attendance->employee->device_user_id }}</td>
                                                <td>{{ $attendance->employee->employee_name }}</td>
                                                <td>{{ $attendance->employee->designation }}</td>
                                                <td>{{ $attendance->employee->department->department_name }}</td>

                                                <td>

                                                    @php

                                                        $hours = floor($attendance->hours_worked / 60);
                                                        $minutes = $attendance->hours_worked % 60;

                                                    @endphp

                                                    @if ($attendance->hours_worked == 9999999999)
                                                        <span class="badge badge-danger p-2 rounded">CheckOut Not
                                                            Found</span>
                                                    @else
                                                        @if ($minutes > 0)
                                                            {{ $hours . ' Hours ' . ':' . $minutes . ' Minutes' }}
                                                        @else
                                                            {{ $hours . ' Hours ' }}
                                                        @endif
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($attendance->FormatedTimes['checkin'] == 'Employee Is Not Present')
                                                        <span
                                                            class="badge badge-danger p-1">{{ $attendance->FormatedTimes['checkin'] }}</span>
                                                    @else
                                                        {{ $attendance->FormatedTimes['checkin'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($attendance->FormatedTimes['checkout'] == 'Employee Is Not Present')
                                                        <span
                                                            class="badge badge-danger p-1">{{ $attendance->FormatedTimes['checkout'] }}</span>
                                                    @elseif ($attendance->attendance_checkout == 5)
                                                        <span class="badge badge-danger p-2 rounded">Out Of Shift</span>
                                                    @elseif ($attendance->attendance_checkout == '__________')
                                                        <span class="badge badge-danger p-2 rounded">Checkout Not
                                                            Found</span>
                                                    @else
                                                        {{ $attendance->FormatedTimes['checkout'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($attendance->attendance_status == 'On-Time')
                                                        <span class="badge badge-success p-1">
                                                            {{ $attendance->attendance_status }}</span>
                                                    @elseif ($attendance->attendance_status == 'Early')
                                                        <span class="badge badge-primary p-1">
                                                            {{ $attendance->attendance_status }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-1">
                                                            {{ $attendance->attendance_status }}</span>
                                                    @endif
                                                </td>
                                                <td>


                                                    @if ($attendance->leave_type == 'Sick')
                                                        <span
                                                            class="badge badge-danger p-1">{{ $attendance->leave_type }}</span>
                                                    @elseif($attendance->leave_type == 'Absent')
                                                        <span
                                                            class="badge badge-danger p-1">{{ $attendance->leave_type }}</span>
                                                    @elseif($attendance->leave_type == 'Casual')
                                                        <span
                                                            class="badge badge-warning p-1">{{ $attendance->leave_type }}</span>
                                                    @elseif($attendance->leave_type == 'Medical')
                                                        <span
                                                            class="badge badge-info p-1">{{ $attendance->leave_type }}</span>
                                                    @elseif($attendance->leave_type == 'Emergency')
                                                        <span
                                                            class="badge badge-danger p-1">{{ $attendance->leave_type }}</span>
                                                    @else
                                                        <span class="badge badge-success p-1"> Employee Is Present</span>
                                                    @endif

                                                </td>
                                                <td>{{ $date }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
