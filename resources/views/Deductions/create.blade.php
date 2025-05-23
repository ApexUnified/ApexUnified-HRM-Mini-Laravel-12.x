@extends('layouts.app')

@section('title', 'Deductions')

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
                            <h2 class="display-5">Create Deduction</h2>
                            <a href="{{ route('deduction.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Deductions</a>
                        </div>

                        <form action="{{ route('deduction.store') }}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deduction_type" class="col-form-label">Deduction Type *</label>
                                        <input type="text" name="deduction_type" class="form-control" id="deduction_type"
                                            value="{{ old('deduction_type') }}">
                                        @error('deduction_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deduction_amount" class="col-form-label">Deduction Amount *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" class="form-control" name="deduction_amount"
                                                id="deduction_amount" value="{{ old('deduction_amount') }}">
                                        </div>
                                        @error('deduction_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description </label>
                                        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus-square fa-lg mx-1"></i>
                                Create Deduction</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
