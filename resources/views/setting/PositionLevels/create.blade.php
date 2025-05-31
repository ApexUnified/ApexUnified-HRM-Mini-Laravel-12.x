@extends('layouts.app')

@section('title', 'Position Levels')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Position Level</h2>
                            <a href="{{ route('position-level.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i> 
                                Back To Position Level</a>
                        </div>

                        <form action="{{ route('position-level.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_level" class="col-form-label">Position Level *</label>
                                        <input type="text" name="position_level" class="form-control" id="position_level"
                                            value="{{ old('position_level') }}">
                                        @error('position_level')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                Create Position Level</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
