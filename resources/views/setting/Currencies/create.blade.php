@extends('layouts.app')

@section('title', 'Currencies')


@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Currency</h2>
                            <a href="{{ route('currency.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i> 
                                Back To Currency</a>
                        </div>

                        <form action="{{ route('currency.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="currency_name" class="col-form-label">Currency Name *</label>
                                        <input class="form-control" type="text" name="currency_name" id="currency_name"
                                            value="{{ old('currency_name') }}">
                                        @error('currency_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="currency_symbol" class="col-form-label">Currency Symbol *</label>
                                        <input class="form-control" type="text" name="currency_symbol"
                                            id="currency_symbol" value="{{ old('currency_symbol') }}">
                                        @error('currency_symbol')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <button class="btn btn-primary my-3" type="submit">
                                <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                Create Currency</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
