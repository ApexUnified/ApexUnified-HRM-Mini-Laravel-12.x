@extends('layouts.app')

@section('title', 'Holidays')

@section('content')


    <div class="main-content-inner">
        <div class="row">
            <div class="mt-5 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <h2 class="display-5">Edit Holiday</h2>
                            <a href="{{ route('holiday.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Holidays</a>
                        </div>

                        <form action="{{ route('holiday.update', $holiday->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="holiday_name" class="col-form-label">Holiday Name *</label>
                                        <input type="text" name="holiday_name" id="holiday_name" class="form-control"
                                            value="{{ $holiday->holiday_name }}">
                                        @error('holiday_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="holiday_date" class="col-form-label">Holiday Date *</label>
                                        <input type="text" name="holiday_date" id="holiday_date" class="form-control flatpickr-datepicker"
                                            value="{{ $holiday->holiday_date }}">
                                        @error('holiday_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>






                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i> 
                                Update Holiday</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
