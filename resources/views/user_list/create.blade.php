@extends('layouts.app')

@section('title', 'User List')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create User</h2>
                            <a href="{{ route('user-list.index') }}" class="btn btn-primary">Back To Users</a>
                        </div>

                        <form action="{{ route('user-list.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-form-label">Name *</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-form-label">Email *</label>
                                <input class="form-control" type="text" name="email" id="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label">Password *</label>
                                <input class="form-control" type="password" name="password" id="password"
                                    value="{{ old('password') }}" required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label">Confirm Password *</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="profile" class="col-form-label">Profile </label>
                                <input class="image-resize-filepond" type="file" name="profile" id="profile"
                                    value="{{ old('profile') }}">
                                @error('profile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="role" class="col-form-label">Role *</label>
                                <select class="form-control SelectPicker" name="role" id="role" required>
                                    <option value="" hidden>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-primary my-4" type="submit">Create User</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
