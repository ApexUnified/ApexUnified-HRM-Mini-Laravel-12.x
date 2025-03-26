@extends('layouts.app')

@use('App\Models\Setting')

@section('title', 'Employee')

@section('content')

    @php
        $setting = App\Models\Setting::first();
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
                                <a href="{{ route('employee.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i>
                                    Create Employee</a>
                            @endcan
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-center align-content-center">
                                <h3>Additional Filters</h3>
                            </div>
                        </div>
                        <form action="{{ route('employee.index') }}" method="GET">
                            @csrf
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"
                                        style="font-size: 1.2rem"></i>
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_department_query">Department</label>
                                        <select id="employee_department_query" name="department_id" class="form-control">
                                            <option value="" hidden>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" @selected(request()->department_id == $department->id)>
                                                    {{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_gender_query">Gender</label>
                                        <select id="employee_gender_query" name="gender" class="form-control">
                                            <option value="" hidden>Select Gender</option>
                                            <option value="Male" @selected(request()->gender == 'Male')>Male</option>
                                            <option value="Female" @selected(request()->gender == 'Female')>Female</option>
                                            <option value="Other" @selected(request()->gender == 'Other')>Other</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_position_query">Position</label>
                                        <select id="employee_position_query" name="position_id" class="form-control">
                                            <option value="" hidden>Select Position</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}" @selected(request()->position_id == $position->id)>
                                                    {{ $position->position_name }} - {{ $position->position_level }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_marital_status_query">Marital Status</label>
                                        <select id="employee_marital_status_query" name="marital_status"
                                            class="form-control">
                                            <option value="" hidden>Select Marital Status</option>
                                            <option value="Single" @selected(request()->marital_status == 'Single')>Single</option>
                                            <option value="Married" @selected(request()->marital_status == 'Married')>Married</option>
                                            <option value="Divorced" @selected(request()->marital_status == 'Divorced')>Divorced</option>
                                            <option value="Widowed" @selected(request()->marital_status == 'Widowed')>Widowed</option>
                                            <option value="Separated" @selected(request()->marital_status == 'Separated')>Separated</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_device_query">Device</label>
                                        <select id="employee_device_query" name="device_id" class="form-control">
                                            <option value="" hidden>Select Device</option>
                                            @foreach ($devices as $device)
                                                <option value="{{ $device->id }}" @selected(request()->device_id == $device->id)>
                                                    {{ $device->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_blood_group_query">Blood Group</label>
                                        <select id="employee_blood_group_query" name="blood_group" class="form-control">
                                            <option value="" hidden>Select Blood Group</option>
                                            <option value="A+" @selected(request()->blood_group == 'A+')>A+</option>
                                            <option value="A-" @selected(request()->blood_group == 'A-')>A-</option>
                                            <option value="B+" @selected(request()->blood_group == 'B+')>B+</option>
                                            <option value="B-" @selected(request()->blood_group == 'B-')>B-</option>
                                            <option value="O+" @selected(request()->blood_group == 'O+')>O+</option>
                                            <option value="O-" @selected(request()->blood_group == 'O-')>O-</option>
                                            <option value="AB+" @selected(request()->blood_group == 'AB+')>AB+</option>
                                            <option value="AB-" @selected(request()->blood_group == 'AB-')>AB-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </form>

                        @include('Partials.Employees.table_body', [
                            'employees' => $employees,
                            'setting' => $setting,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <script>
        var employee_delete_btn = @json(auth()->user()->can('Employee Delete'));


        $(document).on('click', '#employee-pagination-links a', function(e) {
            e.preventDefault();
            let pageUrl = $(this).attr("href");



            $.get(pageUrl, function(data) {
                let htmlData = $("<div>").html(data);
                let newRows = htmlData.find(".employees-table-rows");
                let newPagination = $(htmlData).find("#employee-pagination-links").html();

                if (newRows.length > 0) {
                    $("tbody").html(newRows);
                } else {
                    console.log("No New Table Data");
                }


                if (newPagination) {
                    $("#employee-pagination-links").html(newPagination);
                } else {
                    console.log("No New Pagination");
                }
            });


        });


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
        });
    </script>

@endsection
