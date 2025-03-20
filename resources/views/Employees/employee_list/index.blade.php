@extends('layouts.app')

@use("App\Models\Setting")

@section('title', 'Employee')

@section('content')


@php
        $setting = Setting::first();
@endphp

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

                        <div class="row mb-3">
                            <div class="col-md-12 text-center align-content-center">
                                <h3>Additional Filters</h3>
                            </div>
                        </div>
                        <form action="{{ route("employee.index") }}" method="GET">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter" style="font-size: 1.2rem"></i>
                                 </button>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_department_query">Department</label>
                                    <select id="employee_department_query" name="department_id" class="form-control">
                                        <option value="" hidden>Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" @selected(request()->department_id == $department->id)>{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_gender_query">Gender</label>
                                    <select id="employee_gender_query" name="gender" class="form-control">
                                        <option value="" hidden>Select Gender</option>
                                        <option value="Male" @selected(request()->gender == "Male")>Male</option>
                                        <option value="Female" @selected(request()->gender == "Female")>Female</option>
                                        <option value="Other" @selected(request()->gender == "Other")>Other</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_position_query">Position</label>
                                    <select id="employee_position_query" name="position_id" class="form-control">
                                        <option value="" hidden>Select Position</option>
                                       @foreach ($positions as $position )
                                            <option value="{{ $position->id }}" @selected(request()->position_id == $position->id)>{{ $position->position_name }} - {{ $position->position_level }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_marital_status_query">Marital Status</label>
                                    <select id="employee_marital_status_query" name="marital_status" class="form-control">
                                        <option value="" hidden>Select Marital Status</option>
                                        <option value="Single" @selected(request()->marital_status == "Single")>Single</option>
                                        <option value="Married" @selected(request()->marital_status == "Married")>Married</option>
                                        <option value="Divorced" @selected(request()->marital_status == "Divorced")>Divorced</option>
                                        <option value="Widowed" @selected(request()->marital_status == "Widowed")>Widowed</option>
                                        <option value="Separated" @selected(request()->marital_status == "Separated")>Separated</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_device_query">Device</label>
                                    <select id="employee_device_query" name="device_id" class="form-control">
                                        <option value="" hidden>Select Device</option>
                                        @foreach ($devices as $device )
                                                <option value="{{$device->id }}" @selected(request()->device_id == $device->id)>{{ $device->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_blood_group_query">Blood Group</label>
                                    <select id="employee_blood_group_query" name="blood_group" class="form-control">
                                        <option value="" hidden>Select Blood Group</option>
                                        <option value="A+" @selected(request()->blood_group == "A+")>A+</option>
                                        <option value="A-" @selected(request()->blood_group == "A-")>A-</option>
                                        <option value="B+" @selected(request()->blood_group == "B+")>B+</option>
                                        <option value="B-" @selected(request()->blood_group == "B-")>B-</option>
                                        <option value="O+" @selected(request()->blood_group == "O+")>O+</option>
                                        <option value="O-" @selected(request()->blood_group == "O-")>O-</option>
                                        <option value="AB+" @selected(request()->blood_group == "AB+")>AB+</option>
                                        <option value="AB-" @selected(request()->blood_group == "AB-")>AB-</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>

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
                                                   alt="" style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                                                   @else
                                                   <img src="{{ asset("assets/images/default-img.webp" ) }}"
                                                   alt="" style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
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

                                                        $devices = \App\Models\ZktecoDevice::whereIn(
                                                            'id',
                                                            $device_ids,
                                                        )->get();
                                                    @endphp
                                                    @if ($devices->isNotEmpty())
                                                        @foreach ($devices as $device)
                                                          {{!empty($device) ?  $device->name . " | " : "" }}
                                                        @endforeach
                                                    @else
                                                        No device assigned
                                                    @endif
                                                </td>

                                                <td>{{ $employee->gender ?? "-" }}</td>
                                              @if(!empty($employee->position))   <td>{{ $employee->position->position_name }} - {{ $employee->position->position_level }}</td> @else <td>-</td> @endif 
                                                <td>{{ $employee->joining_date?->format("Y-m-d") ?? "-" }}</td>
                                                <td>{{ $employee->religion }}</td>
                                                <td>{{ $employee->marital_status ?? "-" }}</td>
                                                <td>{{ $employee->contact_number  ?? "-"}}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->cnic_number }}</td>
                                                <td>{{ $employee->eobi_number ?? "-" }}</td>
                                                <td>{{ $employee->sessi_number ?? "-" }}</td>
                                                <td>{{ $employee->blood_group ?? "-" }}</td>
                                                <td>{{ $employee->remarks ?? "-" }}</td>
                                                <td>{{ $employee->created_by }}</td>
                                                <td>{{ $employee->created_at->format('Y-M-d') }}</td>
                                                @if (auth()->user()->can('Employee Edit') || auth()->user()->can('Employee Delete'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">


                                                            @can("Employee Show")
                                                            <a class="dropdown-item"
                                                                href="{{ route('employee.show', $employee) }}">Show</a>
                                                            @endcan

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


