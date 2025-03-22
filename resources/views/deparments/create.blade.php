@extends('layouts.app')

@section('title', 'Departments')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Department</h2>
                            <a href="{{ route('department.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Departments</a>
                        </div>

                        <form action="{{ route('department.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Department_name" class="col-form-label">Department Name *</label>
                                        <input type="text" class="form-control" name="department_name"
                                            id="Department_name">
                                        @error('department_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_id" class="col-form-label">Branch *</label>
                                        <select name="branch_id" id="branch_id" class="form-control">
                                            <option value=""hidden>Select Branch</option>

                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('branch_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>


                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus-square fa-lg mx-1"></i>
                                Create Department</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
