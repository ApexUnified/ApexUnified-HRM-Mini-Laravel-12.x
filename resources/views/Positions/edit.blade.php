@extends('layouts.app')

@section('title', 'Positions')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Position</h2>
                            <a href="{{ route('position.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Positions</a>
                        </div>

                        <form action="{{ route('position.update', $position->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_name" class="col-form-label">Position Name *</label>
                                        <input type="text" name="position_name" id="position_name" class="form-control"
                                            value="{{ $position->position_name }}">
                                        @error('position_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jobnature_id" class="col-form-label">Job Nature *</label>
                                        <select name="jobnature_id" id="jobnature_id" class="form-control">
                                            <option value="" hidden>Select Job Nature</option>

                                            @foreach ($jobNatures as $jobNature)
                                                <option value="{{ $jobNature->id }}"
                                                    {{ $position->jobnature_id == $jobNature->id ? 'selected' : '' }}>
                                                    {{ $jobNature->job_nature_type }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('jobnature_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>



                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_level" class="col-form-label">Position Level *</label>
                                        <select name="position_level" id="position_level" class="form-control">
                                            <option value="" hidden>Select Position Level</option>

                                            @foreach ($position_levels as $position_level)
                                                <option value="{{ $position_level->position_level }}"
                                                    {{ $position_level->position_level == $position_level->position_level ? 'selected' : '' }}>
                                                    {{ $position_level->position_level }}</option>
                                            @endforeach

                                        </select>
                                        @error('position_level')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>





                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                Update Position</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
