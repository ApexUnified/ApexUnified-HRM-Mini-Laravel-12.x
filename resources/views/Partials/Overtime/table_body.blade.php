<div class="mt-5 single-table">
    <div class="data-tables">
        <table id="overtime_table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th class="no-print"></th>
                    <th class="no-print">
                        <label class="checkbox-container">
                            <input type="checkbox" id="select_all">
                            <div class="checkmark"></div>
                        </label>
                    </th>
                    <th>Employee Profile</th>
                    <th>Employee Name</th>
                    <th>Overtime Hours</th>
                    <th>Overtime Per Hours Rate</th>
                    <th>Overtime Total Pay</th>
                    <th>Overtime Date</th>

                    @if (auth()->user()->can('Overtime Delete') ||
                            auth()->user()->can('Overtime
                                                                                                                                                                                                                                                                    Edit'))
                        <th class="no-print">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($overtimes as $overtime)
                    <tr class="overtime-table-rows">
                        <td></td>
                        <td>

                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $overtime->id }}">
                                <div class="checkmark"></div>
                            </label>
                        </td>
                        <td>
                            @if (!empty($overtime->employee->profile))
                                <img src="{{ asset('assets/images/employee/profile/' . $overtime->employee->profile) }}"
                                    alt=""
                                    style="width:50px; height:50px; object-fit:cover;
                    border-radius:3rem">
                            @else
                                <img src="{{ asset('assets/images/default-img.webp') }}" alt=""
                                    style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                            @endif
                        </td>
                        <td>{{ $overtime->employee->employee_name }}</td>

                        @php
                            $overtime_hours = $overtime->hours_worked;
                            $overtime_hour_for_human =
                                $overtime_hours == floor($overtime_hours)
                                    ? number_format($overtime_hours, 0) . ' hours'
                                    : rtrim(rtrim(number_format($overtime_hours, 2), '0'), '.') . ' hours';
                        @endphp

                        <td>{{ $overtime_hour_for_human }}</td>
                        <td>{{ $setting->currency }} {{ $overtime->rate_per_hour }}</td>
                        <td>{{ $setting->currency }} {{ $overtime->total_overtime_pay }}</td>
                        <td>{{ $overtime->created_at->format('Y-M-d') }}</td>


                        @if (auth()->user()->can('Overtime Delete') || auth()->user()->can('Overtime Edit'))
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    @can('Overtime Edit')
                                        <a class="dropdown-item" href="{{ route('overtime.edit', $overtime) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan

                                    @can('Overtime Delete')
                                        <form class="overtime-delete-form"
                                            action="{{ route('overtime.destroy', $overtime) }}" method="POST">
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
<div class="d-flex justify-content-end flex-wrap my-3" id="overtime-pagination-links">
    {{ $overtimes->onEachSide(2)->links() }}
</div>
