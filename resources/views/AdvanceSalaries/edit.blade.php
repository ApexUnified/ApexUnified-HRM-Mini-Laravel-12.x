@extends('layouts.app')

@section('title', 'Advance Salaries')

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
                            <h2 class="display-5">Edit Advance Salary</h2>
                            <a href="{{ route('advance-salary.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Advance Salaries</a>
                        </div>

                        <form action="{{ route('advance-salary.update', $advance_salary->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id" class="col-form-label">Advance Salary Employee *</label>
                                        <select name="employee_id" class="form-control" id="employee_id">
                                            <option value="" hidden>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ $advance_salary->employee_id == $employee->id ? 'selected' : '' }}>
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
                                        <label for="advance_salary_reason" class="col-form-label">Advance Salary Reason
                                            *</label>
                                        <textarea name="advance_salary_reason" id="advance_salary_reason" class="form-control" cols="30" rows="1">{{ $advance_salary->advance_salary_reason }}</textarea>
                                        @error('advance_salary_reason')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advance_salary_amount" class="col-form-label">Advance Salary Amount
                                            *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" step="0.01" class="form-control"
                                                name="advance_salary_amount" id="advance_salary_amount"
                                                value="{{ $advance_salary->advance_salary_amount }}">
                                        </div>
                                        @error('advance_salary_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advance_salary_date" class="col-form-label">Advance Salary Date
                                            *
                                        </label>
                                        <input type="text" name="advance_salary_date"
                                            class="form-control flatpickr-datepicker" id="advance_salary_date"
                                            value="{{ $advance_salary->advance_salary_date }}">
                                        @error('advance_salary_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advance_salary_status" class="col-form-label">Advance Salary Status
                                            *</label>

                                        <select name="advance_salary_status" id="advance_salary_status"
                                            class="form-control">
                                            <option value="" hidden>Select Cash Advance Status</option>

                                            <option
                                                value="Pending"{{ $advance_salary->advance_salary_status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option
                                                value="Approved"{{ $advance_salary->advance_salary_status == 'Approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>

                                            <option
                                                value="Rejected"{{ $advance_salary->advance_salary_status == 'Rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>

                                            <option
                                                value="Disbused"{{ $advance_salary->advance_salary_status == 'Disbused' ? 'selected' : '' }}>
                                                Disbused
                                            </option>

                                            <option
                                                value="Settled"{{ $advance_salary->advance_salary_status == 'Settled' ? 'selected' : '' }}>
                                                Settled
                                            </option>

                                        </select>

                                        @error('advance_salary_status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description </label>
                                        <textarea name="description" id="description" class="form-control" cols="10" rows="1">{{ $advance_salary->description }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                Update Advance Salary</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
