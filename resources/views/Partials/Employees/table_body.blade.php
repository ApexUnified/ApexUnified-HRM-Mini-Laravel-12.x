<div class="single-table mt-5">
    <div class="data-tables">
        <table id="Employee_table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th class="no-print"></th>
                    <th class="no-print">

                        <label class="checkbox-container">
                            <input type="checkbox" id="select_all">
                            <div class="checkmark"></div>
                        </label>
                    </th>
                    <th>Profile</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Parent Name</th>
                    <th>Employee DOB</th>
                    <th>Employee Designation</th>
                    <th>Date Of Hiring</th>
                    <th>Employee Department</th>
                    <th>Employee Salary</th>
                    <th>Employee Devices</th>
                    <th>Employee Gender</th>
                    <th>Employee Position</th>
                    <th>Employee Joining Date</th>
                    <th>Employee Religion</th>
                    <th>Employee Marital Status</th>
                    <th>Employee Contact Number</th>
                    <th>Employee Email</th>
                    <th>Employee Cnic</th>
                    <th>Employee Eobi</th>
                    <th>Employee Sessi</th>
                    <th>Employee Blood Group</th>
                    <th>Employee Remarks</th>
                    <th>Employee Created By</th>

                    <th class="no-print">Date</th>
                    @if (auth()->user()->can('Employee Edit') || auth()->user()->can('Employee Delete'))
                        <th class="no-print">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="employees-table-rows">
                        <td></td>
                        <td>
                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $employee->id }}">
                                <div class="checkmark"></div>
                            </label>
                        </td>

                        <td>
                            @if (!empty($employee->profile))
                                <img src="{{ asset('assets/images/employee/profile/' . $employee->profile) }}"
                                    alt=""
                                    style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                            @else
                                <img src="{{ asset('assets/images/default-img.webp') }}" alt=""
                                    style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                            @endif
                        </td>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->employee_name }}</td>
                        <td>{{ $employee->parent_name }}</td>
                        <td>{{ $employee->employee_dob }}</td>
                        <td>{{ $employee->designation }}</td>
                        <td>{{ $employee->date_of_hiring }}</td>
                        <td>{{ $employee->department->department_name }}</td>
                        <td>{{ $setting->currency }} {{ $employee->salary }}</td>
                        <td>
                            @php
                                $device_ids = json_decode($employee->device_id, true);

                                $devices = \App\Models\ZktecoDevice::whereIn('id', $device_ids)->get();
                            @endphp
                            @if ($devices->isNotEmpty())
                                @foreach ($devices as $device)
                                    {{ !empty($device) ? $device->name . ' | ' : '' }}
                                @endforeach
                            @else
                                No device assigned
                            @endif
                        </td>

                        <td>{{ $employee->gender ?? '-' }}</td>
                        @if (!empty($employee->position))
                            <td>{{ $employee->position->position_name }} -
                                {{ $employee->position->position_level }}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{{ $employee->joining_date?->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ $employee->religion }}</td>
                        <td>{{ $employee->marital_status ?? '-' }}</td>
                        <td>{{ $employee->contact_number ?? '-' }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->cnic_number }}</td>
                        <td>{{ $employee->eobi_number ?? '-' }}</td>
                        <td>{{ $employee->sessi_number ?? '-' }}</td>
                        <td>{{ $employee->blood_group ?? '-' }}</td>
                        <td>{{ $employee->remarks ?? '-' }}</td>
                        <td>{{ $employee->created_by }}</td>
                        <td>{{ $employee->created_at->format('Y-M-d') }}</td>
                        @if (auth()->user()->can('Employee Edit') || auth()->user()->can('Employee Delete'))
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">


                                    @can('Employee Show')
                                        <a class="dropdown-item" href="{{ route('employee.show', $employee) }}">
                                            <i class="fa-solid fa-eye fa-lg mx-1"></i>
                                            Show</a>
                                    @endcan

                                    @can('Employee Edit')
                                        <a class="dropdown-item" href="{{ route('employee.edit', $employee) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan



                                    @can('Employee Delete')
                                        <form class="employee-delete-form"
                                            action="{{ route('employee.destroy', $employee) }}" method="POST">
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
<div class="d-flex justify-content-end flex-wrap my-3" id="employee-pagination-links">
    {{ $employees->onEachSide(2)->links() }}
</div>
