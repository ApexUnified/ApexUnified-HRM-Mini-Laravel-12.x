@extends('layouts.app')

@use('App\Models\Setting')
@section('title', 'Overtime Pay')

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
                        <h2 class="display-5">Manage Overtime Pay</h2>
                    </div>

                    <form action="{{ route('overtimepay.storeOrUpdate') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <span><i>Note: This Field Will Take Amount That Will Be Calculated As Per Hourly Bases
                                        For The Overtime Of Employees</i></span>
                                <div class="form-group">
                                    <label for="overtime_pay" class="col-form-label">Overtime Pay*</label>
                                    <div class="input-group">
                                        <span class="input-group-text">{{ $setting->currency }}</span>
                                        <input type="number" step="0.01" name="overtime_pay" id="overtime_pay"
                                            class="form-control"
                                            value="{{ empty($overtime_pay->overtime_pay) ? old('overtime_pay') : $overtime_pay->overtime_pay }}">
                                    </div>


                                    @error('overtime_pay')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection