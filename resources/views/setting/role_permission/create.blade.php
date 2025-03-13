@extends('layouts.app')

@section('title', 'Role')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Role</h2>
                            <a href="{{ route('setting.roles') }}" class="btn btn-primary">Back To Roles</a>
                        </div>

                        <form action="{{ route('setting.role.store') }}" method="POST" class="w-50">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-form-label">Role Name *</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Create Role</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
