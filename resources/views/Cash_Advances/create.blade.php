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
                            <h2 class="display-5">Create Cash Advance</h2>
                            <a href="{{ route('cash-advance.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Cash Advances</a>
                        </div>

                        <form action="{{ route('cash-advance.store') }}" method="POST">
                            @csrf


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id" class="col-form-label">Cash Advance Employee *</label>
                                        <select name="employee_id" class="form-control" id="employee_id">
                                            <option value="" hidden>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
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
                                            value="{{ old('advance_type') }}">
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
                                                id="advance_amount" value="{{ old('advance_amount') }}">
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
                                            value="{{ old('advance_date') }}">
                                        @error('advance_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description </label>
                                        <textarea name="description" id="description" class="form-control" cols="10" rows="1">{{ old('description') }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus-square fa-lg mx-1"></i>
                                Create Cash Advance</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
