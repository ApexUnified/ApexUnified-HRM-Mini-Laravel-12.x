@extends('layouts.app')

@section('title', 'Loans')

@section('content')


    @php
        $setting = \App\Models\Setting::first();
    @endphp

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Loan</h2>
                            <a href="{{ route('loan.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Loans</a>
                        </div>

                        <form action="{{ route('loan.update', $loan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id" class="col-form-label">Employee *</label>
                                        <select name="employee_id" id="employee_id" class="form-control">
                                            <option value="" hidden>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ $loan->employee_id == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->employee_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="loan_type" class="col-form-label">Loan Type *</label>
                                        <input type="text" name="loan_type" class="form-control" id="loan_type"
                                            value="{{ $loan->loan_type }}">
                                        @error('loan_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="loan_amount" class="col-form-label">Loan Amount *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" class="form-control" name="loan_amount" id="loan_amount"
                                                value="{{ $loan->loan_amount }}">
                                        </div>
                                        @error('loan_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="loan_deduction_amount" class="col-form-label">Loan Deduction Amount
                                            *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" class="form-control" name="loan_deduction_amount"
                                                id="loan_deduction_amount" value="{{ $loan->loan_deduction_amount }}">
                                        </div>
                                        @error('loan_deduction_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="loan_date" class="col-form-label">Loan Date *</label>
                                        <input type="text" name="loan_date" class="form-control flatpickr-datepicker" id="loan_date"
                                            value="{{ $loan->loan_date }}">
                                        @error('loan_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="remeaning_loan" class="col-form-label">Remeaning Loan *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" class="form-control" name="remeaning_loan"
                                                id="remeaning_loan" value="{{ $loan->remeaning_loan }}">
                                        </div>
                                        @error('remeaning_loan')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Loan Status *</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" hidden>Select Loan Status</option>
                                            <option value="Active" {{ $loan->status == 'Active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="Completed" {{ $loan->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="repayment_date" class="col-form-label">Repayment Date *</label>
                                        <input type="text" name="repayment_date" class="form-control" id="repayment_date"
                                            value="{{ $loan->repayment_date }}">
                                        @error('repayment_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description </label>
                                        <textarea name="description" class="form-control" id="description">{{ $loan->description }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>








                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                Update Loan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
