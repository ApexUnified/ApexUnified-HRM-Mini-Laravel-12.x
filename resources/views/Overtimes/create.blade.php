@extends('layouts.app')

@use('App\Models\Setting')
@section('title', 'Overtimes')

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
                        <h2 class="display-5">Create Overtime</h2>
                        <a href="{{ route("overtime.index") }}" class="btn btn-primary">Back To Overtimes</a>
                    </div>

                    <form action="{{ route('overtime.store') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id" class="col-form-label">Employee*</label>

                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value="" hidden>Select Employee</option>

                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == old("employee_id")
                                            ? "selected" : "" }}>
                                            {{ $employee->employee_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error("employee_id")
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rate_per_hour" class="col-form-label">Overtime Rate Per Hour*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">{{ $setting->currency }}</span>
                                        <input type="number" step="0.01" name="rate_per_hour" id="rate_per_hour"
                                            class="form-control" value="{{ $overtime_pay->overtime_pay }}">
                                    </div>

                                    @error('rate_per_hour')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hours_worked" class="col-form-label">Hours Worked*</label>
                                    <input type="number" step="0.01" name="hours_worked" id="hours_worked"
                                        class="form-control" value="{{ old(" hours_worked") }}">
                                </div>
                                @error('hours_worked')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <button class="btn btn-primary" type="submit">Create Overtime</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection