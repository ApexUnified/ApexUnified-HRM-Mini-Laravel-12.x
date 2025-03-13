@extends('layouts.app')

@section('title', 'User List')

@section('content')

    @php
        $user_profile = !empty($user->profile) ? asset('assets/images/user-profile/' . $user->profile) : '';
    @endphp
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit User</h2>
                            <a href="{{ route('user-list.index') }}" class="btn btn-primary">Back To Users</a>
                        </div>

                        <form action="{{ route('user-list.update', $user) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name *</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ $user->name }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-form-label">Email *</label>
                                <input class="form-control" type="text" name="email" id="email"
                                    value="{{ $user->email }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="current_password" class="col-form-label">Current Password </label>
                                <input class="form-control" type="password" name="current_password" id="current_password"
                                    value="{{ old('current_password') }}">
                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="password" class="col-form-label">New Password </label>
                                <input class="form-control" type="password" name="password" id="password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label">Confirm Password </label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password_confirmation" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="profile" class="col-form-label">Profile </label>
                                <input class="form-control" type="file" name="profile" id="profile"
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
                                        <option value="{{ $role->id }}"
                                            {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button class="btn btn-primary my-4" type="submit">Update User</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('js')

        <script>
            const user_profile_input = document.querySelector('[name="profile"]');
            const user_profile_filepond = FilePond.create(user_profile_input, {
                allowMultiple: false,
                storeAsFile: true,
            });

            const logo = "{{ $user_profile }}";
            if (logo.length > 0) {
                user_profile_filepond.files = [{
                    source: logo,
                    options: {
                        type: 'remote',
                    },
                }];
            }
        </script>

    @endsection
