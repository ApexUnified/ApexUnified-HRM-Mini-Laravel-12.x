@extends('layouts.app')

@section('title', 'Cash Advances')

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
                            <h2 class="display-5">Edit Cash Advance</h2>
                            <a href="{{ route('cash-advance.index') }}" class="btn btn-primary">Back To Cash Advances</a>
                        </div>

                        <form action="{{ route('cash-advance.update', $cash_advance->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id" class="col-form-label">Cash Advance Employee *</label>
                                        <select name="employee_id" class="form-control" id="employee_id">
                                            <option value="" hidden>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ $cash_advance->employee_id == $employee->id ? 'selected' : '' }}>
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
                                        <label for="advance_type" class="col-form-label">Cash Advance Type *</label>
                                        <input type="text" name="advance_type" class="form-control" id="advance_type"
                                            value="{{ $cash_advance->advance_type }}">
                                        @error('advance_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advance_amount" class="col-form-label">Cash Advance Amount *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" step="0.01" class="form-control" name="advance_amount"
                                                id="advance_amount" value="{{ $cash_advance->advance_amount }}">
                                        </div>
                                        @error('advance_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advance_date" class="col-form-label">Cash Advance Date * </label>
                                        <input type="text" name="advance_date" class="form-control flatpickr-datepicker" id="advance_date"
                                            value="{{ $cash_advance->advance_date }}">
                                        @error('advance_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advance_status" class="col-form-label">Cash Advance Status *</label>

                                        <select name="advance_status" id="advance_status" class="form-control">
                                            <option value="" hidden>Select Cash Advance Status</option>

                                            <option
                                                value="Pending"{{ $cash_advance->advance_status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option
                                                value="Approved"{{ $cash_advance->advance_status == 'Approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>

                                            <option
                                                value="Rejected"{{ $cash_advance->advance_status == 'Rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>

                                            <option
                                                value="Disbused"{{ $cash_advance->advance_status == 'Disbused' ? 'selected' : '' }}>
                                                Disbused
                                            </option>

                                            <option
                                                value="Settled"{{ $cash_advance->advance_status == 'Settled' ? 'selected' : '' }}>
                                                Settled
                                            </option>

                                        </select>

                                        @error('advance_status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description </label>
                                        <textarea name="description" id="description" class="form-control" cols="10" rows="1">{{ $cash_advance->description }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Update Cash Advance</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
