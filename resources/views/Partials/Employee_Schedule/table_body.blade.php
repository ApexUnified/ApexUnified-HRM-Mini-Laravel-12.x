<div class="single-table mt-5">
    <div class="data-tables">
        <table id="Employee_Schedule_table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Employee Schedule</th>
                    <th>Date</th>
                    @can('Employee Edit')
                        <th class="no-print">Action</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="employees-schedule-table-rows">
                        <td>{{ $employee->device_user_id }}</td>
                        <td>{{ $employee->employee_name }}</td>
                        <td>
                            @if ($employee->Schedules->isNotEmpty())
                                @foreach ($employee->schedules as $schedule)
                                    {{ $schedule->formatted_times['checkin'] }} -
                                    {{ $schedule->formatted_times['checkout'] }}<br>
                                @endforeach
                            @else
                                No Schedule Assigned
                            @endif
                        </td>
                        <td>{{ $employee->created_at->format('Y-M-d') }}</td>
                        @can('Employee Edit')
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="{{ route('employeeschedule.edit', $employee) }}">
                                        <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                        Edit</a>
                                </div>
                            </td>
                        @endcan
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end flex-wrap my-3" id="employee-schedule-pagination-links">
    {{ $employees->onEachSide(2)->links() }}
</div>
