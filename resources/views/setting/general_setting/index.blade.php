@extends('layouts.app')

@section('title', 'General Setting')

@section('content')

    @php
        $system_logo = !empty($setting->system_logo) ? asset('assets/images/logo/' . $setting->system_logo) : '';
        $favicon = !empty($setting->favicon) ? asset('assets/images/logo/' . $setting->favicon) : '';
        $auth_logo = !empty($setting->auth_logo) ? asset('assets/images/logo/' . $setting->auth_logo) : '';
    @endphp
    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">General Setting</h2>
                        </div>

                        <div class="card-body mb-5">
                            <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>System Title *</label>
                                            <input type="text" name="system_title" class="form-control"
                                                value="{{ $setting->system_title ?? 'No Title Yet' }}" required="">
                                            <small class="text-danger">
                                                @error('system_title')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company_name" class="form-control"
                                                value="{{ $setting->company_name ?? 'No Company Name Yet' }}">
                                            <small class="text-danger">
                                                @error('company_name')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Developed By</label>
                                            <input type="text" name="developed_by" class="form-control"
                                                value="{{ $setting->developed_by ?? 'No Name Given Yet' }}">
                                            <small class="text-danger">
                                                @error('developed_by')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Timezone</label>
                                            <select type="text" name="time_zone" class="form-control">
                                                <option value="">Select Timezone</option>
                                                @foreach ($timezones as $timezone)
                                                    <option value="{{ $timezone }}"
                                                        {{ $setting->time_zone == $timezone ? 'selected' : '' }}>
                                                        {{ $timezone }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">
                                                @error('time_zone')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select type="text" name="currency" class="form-control">
                                                <option value="" hidden>Select Currency</option>

                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->currency_symbol }}"
                                                        {{ trim($currency->currency_symbol) == $setting->currency ? 'selected' : '' }}>
                                                        {{ $currency->currency_name }} - {{ $currency->currency_symbol }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">
                                                @error('currency')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>System Logo</label>
                                            <input type="file" name="system_logo">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>FavIcon</label>
                                            <input type="file" name="favicon">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Auth Logo</label>
                                            <input type="file" name="auth_logo">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')

        <script>
            const system_logo_input = document.querySelector('[name="system_logo"]');
            const system_filepond = FilePond.create(system_logo_input, {
                allowMultiple: false,
                storeAsFile: true,
                credits: null
            });

            const logo = "{{ $system_logo }}";
            if (logo.length > 0) {
                system_filepond.files = [{
                    source: logo,
                    options: {
                        type: 'remote',
                    },
                }];
            }


            const favicon_input = document.querySelector('[name="favicon"]');
            const favicon_filepond = FilePond.create(favicon_input, {
                allowMultiple: false,
                storeAsFile: true,
                credits: null
            });

            const favicon = "{{ $favicon }}";
            if (favicon.length > 0) {
                favicon_filepond.files = [{
                    source: favicon,
                    options: {
                        type: 'remote',
                    },
                }];
            }


            const auth_logo_input = document.querySelector('[name="auth_logo"]');
            const auth_logo_filepond = FilePond.create(auth_logo_input, {
                allowMultiple: false,
                storeAsFile: true,
                credits: null
            });

            const auth_logo = "{{ $auth_logo }}";
            if (auth_logo.length > 0) {
                auth_logo_filepond.files = [{
                    source: auth_logo,
                    options: {
                        type: 'remote',
                    },
                }];
            }
        </script>

    @endsection
