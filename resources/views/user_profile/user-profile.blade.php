@extends('layouts.app')

@section('title', 'Profile')

@section('content')


    @php
        $user_profile = !empty($user->profile) ? asset('assets/images/user-profile/' . $user->profile) : '';
    @endphp
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <h2 class="display-5">User Profile</h2>
                        </div>

                        <div class="card-body mb-5">
                            <form method="POST" action="{{ route('user.profile.update', $user) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                    <small class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                    <small class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" name="profile" class="form-control">
                                    <small class="text-danger">
                                        @error('profile')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <h2 class="display-5">Update Password</h2>
                        </div>

                        <div class="card-body mb-5">
                            <form method="POST" action="{{ route('user.password.update', $user) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Current Password *</label>
                                    <input type="password" name="current_password" class="form-control"
                                        value="{{ old('current_password') }}">
                                    <small class="text-danger">
                                        @error('current_password')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>


                                <div class="form-group">
                                    <label>New Password *</label>
                                    <input type="password" name="password" class="form-control">
                                    <small class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password *</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                    <small class="text-danger">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </form>
                        </div>

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
                credits: null
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
