@extends('layouts.app')

@section('title', 'Bonuses')

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
                            <h2 class="display-5">Edit Bonus</h2>
                            <a href="{{ route('bonus.index') }}" class="btn btn-primary">Back To Bonuses</a>
                        </div>

                        <form action="{{ route('bonus.update', $bonus->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bonus_type" class="col-form-label">Bonus Type *</label>
                                        <input type="text" name="bonus_type" class="form-control" id="bonus_type"
                                            value="{{ $bonus->bonus_type }}">
                                        @error('bonus_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="frequency" class="col-form-label">Bonus Frequency *</label>
                                        <select name="frequency" class="form-control" id="frequency">
                                            <option value="" hidden>Select Bonus Frequency</option>

                                            <option value="Daily" {{ $bonus->frequency == 'Daily' ? 'selected' : '' }}>
                                                Daily</option>
                                            <option value="Monthly" {{ $bonus->frequency == 'Monthly' ? 'selected' : '' }}>
                                                Monthly</option>
                                            <option value="Quarterly"
                                                {{ $bonus->frequency == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                            <option value="Annually"
                                                {{ $bonus->frequency == 'Annually' ? 'selected' : '' }}>
                                                Annually</option>
                                        </select>
                                        @error('frequency')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bonus_amount" class="col-form-label">Bonus Amount *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" class="form-control" name="bonus_amount" id="bonus_amount"
                                                value="{{ $bonus->bonus_amount }}">
                                        </div>
                                        @error('bonus_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description </label>
                                        <input type="text" name="description" class="form-control" id="description"
                                            value="{{ $bonus->description }}">
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Update Bonus</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
