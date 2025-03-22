@extends('layouts.app')

@use('App\Models\Setting')
@section('title', 'Attendance Pay Deduction')


@section("css")

<style>

.equal-sign {
    margin-top: 30px; 
    font-weight: bold;
}

</style>

@endsection
@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="mt-5 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <h2 class="display-5">Manage Attendance Pay Deduction</h2>
                        </div>

                        <form action="{{ route('attendancepaydeduction.storeOrUpdate') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="late_count" class="col-form-label">Late Count *</label>
                                        <input type="number" name="late_count" id="late_count"
                                                class="form-control"value="{{ empty($attendance_pay_deduction->late_count) ? old('late_count') : $attendance_pay_deduction->late_count }}">


                                        @error('late_count')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-1 text-center">
                                    <h2 class="equal-sign">===</h2>
                                </div>


                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="days" class="col-form-label">Days Count *</label>
                                        <input type="number" name="days" id="days"
                                                class="form-control"value="{{ empty($attendance_pay_deduction->days) ? old('days') : $attendance_pay_deduction->days }}">

                                        @error('days')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i> 
                                Save Changes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
