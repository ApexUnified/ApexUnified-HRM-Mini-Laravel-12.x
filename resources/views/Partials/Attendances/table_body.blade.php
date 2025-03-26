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
                        $date = \Carbon\Carbon::parse($attendance->attendance_date)->format('Y-M-d');
                    @endphp

                    <tr class="attendance-table-rows">

                        <td></td>
                        <td>

                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $attendance->id }}">
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
                            @elseif ($attendance->attendance_checkin == 'Holiday')
                                <span class="badge badge-secondary p-2 rounded">
                                    Holiday
                                </span>
                            @elseif ($attendance->attendance_checkin == 'Saturday')
                                <span class="badge badge-primary p-2 rounded">
                                    Saturday
                                </span>
                            @elseif ($attendance->attendance_checkin == 'Sunday')
                                <span class="badge badge-primary p-2 rounded">
                                    Sunday
                                </span>
                            @else
                                {{ $attendance->FormatedTimes['checkin'] }}
                            @endif
                        </td>
                        <td>
                            @if ($attendance->attendance_checkout == 'Absent')
                                <span class="badge badge-danger p-1">{{ $attendance->attendance_checkout }}</span>
                            @elseif ($attendance->attendance_checkout == 5)
                                <span class="badge badge-danger p-2 rounded">Out Of Shift</span>
                            @elseif ($attendance->attendance_checkout == '__________')
                                <span class="badge badge-danger p-2 rounded">Checkout Not
                                    Found</span>
                            @elseif ($attendance->attendance_checkout == 'Holiday')
                                <span class="badge badge-secondary p-2 rounded">
                                    Holiday
                                </span>
                            @elseif ($attendance->attendance_checkout == 'Saturday')
                                <span class="badge badge-primary p-2 rounded">
                                    Saturday
                                </span>
                            @elseif ($attendance->attendance_checkout == 'Sunday')
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
                            @elseif ($attendance->attendance_status == 'Holiday')
                                <span class="badge badge-secondary p-2 rounded">
                                    Holiday
                                </span>
                            @elseif ($attendance->attendance_status == 'Saturday')
                                <span class="badge badge-primary p-2 rounded">
                                    Saturday
                                </span>
                            @elseif ($attendance->attendance_status == 'Sunday')
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
                                <span class="badge badge-danger p-1">{{ $attendance->leave_type }}</span>
                            @elseif($attendance->leave_type == 'Absent')
                                <span class="badge badge-danger p-1">{{ $attendance->leave_type }}</span>
                            @elseif($attendance->leave_type == 'Casual')
                                <span class="badge badge-warning p-1">{{ $attendance->leave_type }}</span>
                            @elseif($attendance->leave_type == 'Medical')
                                <span class="badge badge-info p-1">{{ $attendance->leave_type }}</span>
                            @elseif($attendance->leave_type == 'Emergency')
                                <span class="badge badge-danger p-1">{{ $attendance->leave_type }}</span>
                            @elseif ($attendance->leave_type == 'Holiday')
                                <span class="badge badge-secondary p-2 rounded">
                                    Holiday
                                </span>
                            @elseif ($attendance->leave_type == 'Saturday')
                                <span class="badge badge-primary p-2 rounded">
                                    Saturday
                                </span>
                            @elseif ($attendance->leave_type == 'Sunday')
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
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    @can('Attendance Edit')
                                        <a class="dropdown-item" href="{{ route('attendance.edit', $attendance->id) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan

                                    @can('Attendance Delete')
                                        <form class="attendance-delete-form"
                                            action="{{ route('attendance.destroy', $attendance) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit">
                                                <i class="fa-solid fa-trash fa-lg mx-1"></i>
                                                Delete</button>
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
<div class="d-flex justify-content-end flex-wrap my-3" id="attendance-pagination-links">
    {{ $attendances->onEachSide(2)->links() }}
</div>
