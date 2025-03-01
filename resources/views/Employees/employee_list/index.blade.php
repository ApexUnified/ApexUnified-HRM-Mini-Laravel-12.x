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
                            <h2 class="display-5">Employees</h2>
                            @can('Employee Create')
                                <a href="{{ route('employee.create') }}" class="btn btn-primary">Create Employee</a>
                            @endcan
                        </div>
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
                                            <th>Department</th>
                                            <th>Device</th>
                                            <th class="no-print">Date</th>
                                            @if (auth()->user()->can('Employee Edit') || auth()->user()->can('Employee Delete'))
                                                <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $employee->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>

                                                <td>
                                                   @if(!empty($employee->profile))
                                                   <img src="{{ asset("assets/images/employee/profile/" . $employee->profile ) }}"
                                                   alt="" style="width:80px; height:80px; object-fit:cover; border-radius:3rem">
                                                   @else
                                                   <img src="{{ asset("assets/images/default-img.webp" ) }}"
                                                   alt="" style="width:80px; height:80px; object-fit:cover; border-radius:3rem">
                                                   @endif
                                                </td>
                                                <td>{{ $employee->device_user_id }}</td>
                                                <td>{{ $employee->employee_name }}</td>
                                                <td>{{ $employee->parent_name }}</td>
                                                <td>{{ $employee->employee_dob }}</td>
                                                <td>{{ $employee->designation }}</td>
                                                <td>{{ $employee->date_of_hiring }}</td>
                                                <td>{{ $employee->department->department_name }}</td>
                                                <td>
                                                    @php
                                                        $device_ids = json_decode($employee->device_id, true);

                                                        $devices = \App\Models\ZktecoDevice::whereIn(
                                                            'id',
                                                            $device_ids,
                                                        )->get();
                                                    @endphp
                                                    @if ($devices->isNotEmpty())
                                                        @foreach ($devices as $device)
                                                            {{ $device->name }}
                                                        @endforeach
                                                    @else
                                                        No device assigned
                                                    @endif
                                                </td>

                                                <td>{{ $employee->created_at->format('Y-M-d') }}</td>
                                                @if (auth()->user()->can('Employee Edit') || auth()->user()->can('Employee Delete'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            @can('Employee Edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('employee.edit', $employee) }}">Edit</a>
                                                            @endcan

                                                            @can('Employee Delete')
                                                                <form class="employee-delete-form"
                                                                    action="{{ route('employee.destroy', $employee) }}"
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
            var employee_delete_btn = @json(auth()->user()->can('Employee Delete'));


            $(document).on("click", ".employee-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Employee ? This Action Cannot Be Reversable',
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
            })
        </script>

    @endsection
