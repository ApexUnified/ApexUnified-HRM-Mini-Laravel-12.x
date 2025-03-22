@extends('layouts.app')

@section('title', 'Departments')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Departments</h2>
                            <a href="{{ route('department.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Departments</a>
                        </div>

                        <form action="{{ route('department.update', $department) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Department_name" class="col-form-label">Department Name * </label>
                                        <input type="text" class="form-control" name="department_name"
                                            id="Department_name" value="{{ $department->department_name }}">
                                        @error('department_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_id" class="col-form-label">Branch *</label>
                                        <select name="branch_id" id="branch_id" class="form-control">
                                            @foreach ($branches as $branch)
                                                <option value=""hidden>Select Branch</option>
                                                <option value="{{ $branch->id }}"
                                                    {{ $branch->id == $department->branch_id ? 'selected' : '' }}>
                                                    {{ $branch->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('branch_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </div>





                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                Update Department</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
