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
                            <h2 class="display-5">Attendances</h2>
                            @can('Attendance Create')
                                <a href="{{ route('attendance.create') }}" class="btn btn-primary">Create Attendance</a>
                            @endcan
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-12 text-center align-content-center">
                                <h3>Additional Filters</h3>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">

                                <form action="{{ route('attendance.index') }}" method="GET" class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-2" style="font-size: 19px">From:</label>
                                        <input type="text" id="min-date" name="from" value="{{ request()->from }}"
                                            class="flatpickr-datepicker form-control mr-2" placeholder="yyyy-mm-dd">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <label class="mr-2" style="font-size: 19px">To:</label>
                                        <input type="text" id="max-date" name="to" value="{{ request()->to }}"
                                            class="flatpickr-datepicker form-control mr-2" placeholder="yyyy-mm-dd">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="attendance_table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input id="select_all" type="checkbox">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Hours Worked</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Attendance Status</th>
                                            <th>Leave Type</th>
                                            <th>Date</th>

                                            @if (auth()->user()->can('Attendance Edit') || auth()->user()->can('Attendance Delete'))
                                                <th class="no-print">Action</th>
                                            @endif


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

                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $attendance->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>

                                                </td>
                                                <td>{{ $attendance->employee->employee_id }}</td>
                                                <td>{{ $attendance->employee->employee_name }}</td>
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
                                                    @if ($attendance->attendance_checkin == 'Absent')
                                                        <span class="badge badge-danger p-1">{{ $attendance->attendance_checkin }}</span>

                                                    @elseif ($attendance->attendance_checkin == "Holiday")
                                                    <span class="badge badge-secondary p-2 rounded">
                                                            Holiday 
                                                    </span>
                                                    @elseif ($attendance->attendance_checkin == "Saturday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Saturday 
                                                    </span>
                                                    @elseif ($attendance->attendance_checkin == "Sunday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Sunday 
                                                    </span>
                                                    @else
                                                        {{ $attendance->FormatedTimes['checkin'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($attendance->attendance_checkout == 'Absent')
                                                        <span class="badge badge-danger p-1">{{$attendance->attendance_checkout}}</span>
                                                    @elseif ($attendance->attendance_checkout == 5)
                                                        <span class="badge badge-danger p-2 rounded">Out Of Shift</span>
                                                    @elseif ($attendance->attendance_checkout == '__________')
                                                        <span class="badge badge-danger p-2 rounded">Checkout Not
                                                            Found</span>
                                                    @elseif ($attendance->attendance_checkout == "Holiday")
                                                        <span class="badge badge-secondary p-2 rounded">
                                                             Holiday 
                                                        </span>

                                                    @elseif ($attendance->attendance_checkout == "Saturday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Saturday 
                                                    </span>
                                                    @elseif ($attendance->attendance_checkout == "Sunday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Sunday 
                                                    </span>
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

                                                    @elseif ($attendance->attendance_status == "Holiday")
                                                        <span class="badge badge-secondary p-2 rounded">
                                                                Holiday 
                                                        </span>

                                                    @elseif ($attendance->attendance_status == "Saturday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Saturday 
                                                    </span>
                                                    @elseif ($attendance->attendance_status == "Sunday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Sunday 
                                                    </span>
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

                                                    @elseif ($attendance->leave_type == "Holiday")
                                                        <span class="badge badge-secondary p-2 rounded">
                                                                Holiday 
                                                        </span>

                                                    @elseif ($attendance->leave_type == "Saturday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Saturday 
                                                    </span>
                                                    @elseif ($attendance->leave_type == "Sunday")
                                                    <span class="badge badge-primary p-2 rounded">
                                                        Sunday 
                                                    </span>
                                                        
                                                    @else
                                                        <span class="badge badge-success p-1"> Employee Is Present</span>
                                                    @endif

                                                </td>
                                                <td>{{ $date }}</td>
                                                @if (auth()->user()->can('Attendance Edit') || auth()->user()->can('Attendance Delete'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            @can('Attendance Edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('attendance.edit', $attendance->id) }}">Edit</a>
                                                            @endcan

                                                            @can('Attendance Delete')
                                                                <form class="attendance-delete-form"
                                                                    action="{{ route('attendance.destroy', $attendance) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                                </form>
                                                            @endcan
                                                        </div>

                                                    </td>
                                                @endif

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

    @section('js')

        <script>
            var attendance_delete_btn = @json(auth()->user()->can('Attendance Delete'));

            $(document).on("click", ".attendance-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Attendance ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        </script>

    @endsection
