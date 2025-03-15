@extends('layouts.app')

@use("App\Models\Setting")
@use("Carbon\Carbon")

@section('title', 'Payslips')

@section('content')

@php
$setting = Setting::first();
@endphp

<div class="main-content-inner">
    <div class="row">
        <div class="mt-5 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 d-flex justify-content-between align-items-center">
                        <h2 class="display-5">Payslips</h2>
                        @can('Payroll Create')
                        <a href="{{ route('payslip.create') }}" class="btn btn-primary">Create Payslip</a>
                        @endcan
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route("payslip.index") }}" method="GET">


                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="fa fa-filter" style="font-size: 1.2rem"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="start_date" class="col-form-label">Employee</label>
                                            <select name="employee_id" id="employee_id" class="form-control">
                                                <option value="" hidden>Select Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}"
                                                        {{ request("employee_id") == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->employee_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="payslip_filter_start_date" class="col-form-label">Start Date</label>
                                            <input type="text" class="form-control" name="payslip_filter_from" id="payslip_filter_start_date" value="{{ request("payslip_filter_from") ? request("payslip_filter_from") : Carbon::now()->startOfMonth()->format("Y-m-d")  }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="payslip_filter_end_date" class="col-form-label">End Date</label>
                                            <input type="text" class="form-control" name="payslip_filter_to" id="payslip_filter_end_date" value="{{ request("payslip_filter_to") ? request("payslip_filter_to") : Carbon::now()->format("Y-m-d")  }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                
                   

                    <div class="mt-5 single-table">
                        <div class="data-tables">
                            <table id="payslip_table" class="text-center">
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
                                        <th>Base Salary</th>
                                        <th>Net Salary</th>
                                        <th>Status</th>
                                        <th>Pay Date</th>

                                        @if (auth()->user()->can('Payroll Delete') || auth()->user()->can('Payroll
                                        Edit'))
                                        <th class="no-print">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payslips as $payslip)
                                    <tr>
                                        <td></td>
                                        <td>

                                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                                <input type="checkbox" class="each_select" value="{{ $payslip->id }}">
                                                <div class="checkmark"></div>
                                            </label>
                                        </td>
                                        <td>
                                            @if(!empty($payslip->employee->profile))
                                            <img src="{{ asset(" assets/images/employee/profile/" .
                                                $payslip->employee->profile ) }}"
                                            alt="" style="width:50px; height:50px; object-fit:cover;
                                            border-radius:3rem">
                                            @else
                                            <img src="{{ asset("assets/images/default-img.webp" ) }}" alt=""
                                                style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                                            @endif
                                        </td>
                                        <td>{{ $payslip->employee->employee_name }}</td>
                                        <td> {{ $setting->currency }} {{ $payslip->base_salary }}</td>
                                        <td> {{ $setting->currency }} {{ $payslip->net_salary }}</td>
                                        <td>
                                            <span class="badge bg-{{ $payslip->status == "Pending" ? "danger"
                                            : "success" }} text-light p-2" >{{$payslip->status}}</span>
                                        </td>

                                    
                                        <td>{{ $payslip->created_at->format('Y-M-d') }}</td>


                                        @if (auth()->user()->can('Payroll Delete') || auth()->user()->can('Payroll
                                        Edit'))
                                        <td>
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">


                                                <a class="dropdown-item"
                                                href="{{ route('payslip.edit', $payslip) }}">Generate Payslip</a>

                                                <a class="dropdown-item"
                                                href="{{ route('payslip.show', $payslip) }}">View</a>


                                                @can('Payroll Edit')
                                                <a class="dropdown-item"
                                                    href="{{ route('payslip.edit', $payslip) }}">Edit</a>
                                                @endcan

                                                @can('Payroll Delete')
                                                <form class="payslip-delete-form"
                                                    action="{{ route('payslip.destroy', $payslip) }}" method="POST">
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
    var payslip_delete_btn = @json(auth()->user()->can('Payroll Delete'));


        $("#payslip_filter_start_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        }); 
    
    
        $("#payslip_filter_end_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });


        




        $(document).on("click", ".payslip-delete-form", function(e) {
            let form = this;
            e.preventDefault();
            Swal.fire({
                title: 'Confirmation',
                text: 'Do You Really Want To Delete This Payslip ? This Action Cannot Be Reversable',
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