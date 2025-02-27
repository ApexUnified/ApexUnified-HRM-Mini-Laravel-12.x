@extends('layouts.app')

@section('title', 'Job Natures')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Job Nature</h2>
                            <a href="{{ route('jobnature.index') }}" class="btn btn-primary">Back To Job Natures</a>
                        </div>

                        <form action="{{ route('jobnature.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_nature_type" class="col-form-label">Job Nature Type*</label>
                                        <select name="job_nature_type" id="job_nature_type" class="form-control">
                                            <option value="" hidden>Select Job Nature</option>

                                            @foreach ($jobnature_types as $jobnature_type)
                                                <option value="{{ $jobnature_type->jobnature_type }}"
                                                    {{ old('job_nature_type') == $jobnature_type->jobnature_type ? 'selected' : '' }}>
                                                    {{ $jobnature_type->jobnature_type }}</option>
                                            @endforeach

                                        </select>
                                        @error('job_nature_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description</label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            value="{{ old('description') }}">
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>



                            <button class="btn btn-primary" type="submit">Create Job Nature</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
