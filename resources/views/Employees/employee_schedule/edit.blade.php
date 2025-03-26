@extends('layouts.app')

@section('title', 'Employee Schedule')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Employee Schedule</h2>
                            <a href="{{ route('employeeschedule.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Employee
                                Schedules</a>
                        </div>

                        <form action="{{ route('employeeschedule.update', $employee) }}" method="POST" class="w-50">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="employee_schedule" class="col-form-label">Schedule *</label>
                                <select class="form-control" type="text" name="employee_schedule" id="employee_schedule"
                                    style="cursor: pointer;">
                                    <option value="" hidden>Select Schedule </option>
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}"
                                            {{ $schedule->id == $employee->employee_schedule ? 'selected' : '' }}>
                                            {{ $schedule->name . ' ' }}
                                            {{ $schedule->checkin . ' - ' . $schedule->checkout }}</option>
                                    @endforeach
                                </select>
                                @error('employee_schedule')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                Update Employee Schedule</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
