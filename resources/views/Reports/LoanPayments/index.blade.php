
@extends('layouts.app')

@section('title', 'Reports')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Loan Payments Report</h2>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-center align-content-center">
                                <h3>Additional Filters</h3>
                            </div>
                        </div>

                        <form action="{{ route("loanpayment.report") }}" method="GET">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter" style="font-size: 1.2rem"></i>
                                 Filter</button>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_id">Employee</label>
                                    <select id="employee_id" name="employee_id" class="form-control">
                                        <option value="" hidden>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" @selected(request()->employee_id == $employee->id)>{{ $employee->employee_name }}</option>
                                        @endforeach
                                    </select>
                                    @error("employee_id")
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="report_from">From</label>
                                    <input type="text" id="report_from" name="from" class="form-control mx-2 flatpickr-datepicker"
                                        placeholder="yyyy-mm-dd" value="{{ request()->from }}">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="report_from">To</label>
                                    <input type="text" id="report_to" name="to" class="form-control mx-2 flatpickr-datepicker"
                                        placeholder="yyyy-mm-dd" value="{{ request()->to }}">
                                </div>
                            </div>
                        </div>

                        </form>

                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="loan_payment_report_table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th>Employee Profile</th>
                                            <th>Employee Name</th>
                                            <th>Loan Type</th>
                                            <th>Loan Amount</th>
                                            <th>Loan Remeaning Amount</th>
                                            <th>Loan Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loanPayments as $loan_payment)
                                            <tr>
                                                <td>
                                                    @if(!empty($loan_payment->employee->profile))
                                                    <img src="{{ asset("assets/images/employee/profile/" . $loan_payment->employee->profile ) }}"
                                                    alt="" style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                                                    @else
                                                    <img src="{{ asset("assets/images/default-img.webp" ) }}"
                                                    alt="" style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                                                    @endif
                                                </td>
                                                <td>{{ $loan_payment->employee->employee_name }}</td>
                                                <td>{{ $loan_payment->loan_type }}</td>
                                                <td>{{ $loan_payment->loan_amount }}</td>
                                                <td>{{ $loan_payment->remeaning_loan }}</td>

                                            
                                                <td>
                                                    <span class="badge badge-{{ $loan_payment->status == "Active" ? "primary" : "success" }} p-2">
                                                            {{ $loan_payment->status  }}
                                                    </span>
                                                </td>
                                                
                                                <td>{{ $loan_payment->created_at->format("Y-M-d") }}</td>
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
