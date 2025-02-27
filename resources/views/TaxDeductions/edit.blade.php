@extends('layouts.app')

@section('title', 'Tax Deductions')

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
                            <h2 class="display-5">Edit Tax Deduction</h2>
                            <a href="{{ route('tax-deduction.index') }}" class="btn btn-primary">Back To Deductions</a>
                        </div>

                        <form action="{{ route('tax-deduction.update', $taxDeduction->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tax_type" class="col-form-label">Tax Deduction Type *</label>
                                        <input type="text" name="tax_type" class="form-control" id="tax_type"
                                            value="{{ $taxDeduction->tax_type }}">
                                        @error('tax_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tax_percentage" class="col-form-label">Tax Deduction Percentage
                                            *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">%</span>
                                            <input type="number" step="0.01" class="form-control" name="tax_percentage"
                                                id="tax_percentage" value="{{ $taxDeduction->tax_percentage }}">
                                        </div>
                                        @error('tax_percentage')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>



                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tax_amount" class="col-form-label">Tax Deduction Amount *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" class="form-control" name="tax_amount" id="tax_amount"
                                                value="{{ $taxDeduction->tax_amount }}">
                                        </div>
                                        @error('tax_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description </label>
                                        <textarea name="description" class="form-control" id="description">{{ $taxDeduction->description }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <button class="btn btn-primary" type="submit">Update Tax Deduction</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
