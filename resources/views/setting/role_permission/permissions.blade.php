@extends('layouts.app')

@section('title', 'Permissions')


@section('css')

    <style>
        .permission-card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            margin-bottom: 1.5rem;
        }

        .permission-card:hover {
            transform: translateY(-5px);
        }

        .category-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #4e73df;
        }

        .permission-item {
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }

        .permission-item:last-child {
            border-bottom: none;
        }

        .permission-item:hover {
            background-color: #f8f9fa;
        }
    </style>

@endsection

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Permissions</h2>
                            @if (config('app.app_protocol') == 'http' && config('app.env') == 'local')
                                <a class="btn btn-primary" href="{{ route('setting.permission.create') }}">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                    Create
                                    Permission</a>
                            @endif
                        </div>

                        <form action="{{ route('setting.permission.assign') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $role_id }}" name="role_id">
                            <div class="d-flex align-items-center my-5">
                                <label class="checkbox-container">
                                    <input id="select_all" type="checkbox">
                                    <div class="checkmark"></div>
                                </label>

                                <label class="form-check-label mt-1 mx-2 mb-3">
                                    Select All
                                </label>
                            </div>



                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-users category-icon"></i>
                                                <h4>Employees Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Employee'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">
                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-calendar category-icon"></i>
                                                <h4>Attendances Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Attendance'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">
                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-building category-icon"></i>
                                                <h4>Departments Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Department'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">
                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-hourglass-half category-icon"></i>
                                                <h4>Schedules Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Schedule'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-user category-icon"></i>
                                                <h4>Users Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('User'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg"
                                                    style="width: 2rem; fill:#4e73df"
                                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                                    <path
                                                        d="M48 256C48 141.1 141.1 48 256 48c63.1 0 119.6 28.1 157.8 72.5c8.6 10.1 23.8 11.2 33.8 2.6s11.2-23.8 2.6-33.8C403.3 34.6 333.7 0 256 0C114.6 0 0 114.6 0 256l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40zm458.5-52.9c-2.7-13-15.5-21.3-28.4-18.5s-21.3 15.5-18.5 28.4c2.9 13.9 4.5 28.3 4.5 43.1l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40c0-18.1-1.9-35.8-5.5-52.9zM256 80c-19 0-37.4 3-54.5 8.6c-15.2 5-18.7 23.7-8.3 35.9c7.1 8.3 18.8 10.8 29.4 7.9c10.6-2.9 21.8-4.4 33.4-4.4c70.7 0 128 57.3 128 128l0 24.9c0 25.2-1.5 50.3-4.4 75.3c-1.7 14.6 9.4 27.8 24.2 27.8c11.8 0 21.9-8.6 23.3-20.3c3.3-27.4 5-55 5-82.7l0-24.9c0-97.2-78.8-176-176-176zM150.7 148.7c-9.1-10.6-25.3-11.4-33.9-.4C93.7 178 80 215.4 80 256l0 24.9c0 24.2-2.6 48.4-7.8 71.9C68.8 368.4 80.1 384 96.1 384c10.5 0 19.9-7 22.2-17.3c6.4-28.1 9.7-56.8 9.7-85.8l0-24.9c0-27.2 8.5-52.4 22.9-73.1c7.2-10.4 8-24.6-.2-34.2zM256 160c-53 0-96 43-96 96l0 24.9c0 35.9-4.6 71.5-13.8 106.1c-3.8 14.3 6.7 29 21.5 29c9.5 0 17.9-6.2 20.4-15.4c10.5-39 15.9-79.2 15.9-119.7l0-24.9c0-28.7 23.3-52 52-52s52 23.3 52 52l0 24.9c0 36.3-3.5 72.4-10.4 107.9c-2.7 13.9 7.7 27.2 21.8 27.2c10.2 0 19-7 21-17c7.7-38.8 11.6-78.3 11.6-118.1l0-24.9c0-53-43-96-96-96zm24 96c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 24.9c0 59.9-11 119.3-32.5 175.2l-5.9 15.3c-4.8 12.4 1.4 26.3 13.8 31s26.3-1.4 31-13.8l5.9-15.3C267.9 411.9 280 346.7 280 280.9l0-24.9z">
                                                    </path>
                                                </svg>
                                                <h4>Devices Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Device'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-briefcase category-icon"></i>
                                                <h4>Job Natures Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Job Nature'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-user-md category-icon "></i>
                                                <h4>Positions Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Position'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa-solid fa-money-bill-1-wave category-icon"></i>
                                                <h4>Allowances Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Allowance'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa-solid fa-money-bill-trend-up category-icon"></i>
                                                <h4>Bonuses Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Bonus'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-credit-card category-icon "></i>
                                                <h4>Loans Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Loan'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-scissors category-icon "></i>
                                                <h4>Deductions Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Deduction'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa-solid fa-square-minus category-icon"></i>
                                                <h4>Tax Deductions Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Tax Deduction'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-bank category-icon "></i>
                                                <h4>Cash Advances Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Cash Advance'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-exchange category-icon "></i>
                                                <h4>Advance Salaries Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Advance Salary'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-calculator category-icon"></i>
                                                <h4>Payroll Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Payroll'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-umbrella category-icon"></i>
                                                <h4>Holidays Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Holiday'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa-solid fa-clock category-icon"></i>
                                                <h4>Overtimes Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Overtime'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-gear category-icon"></i>
                                                <h4>Settings Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Settings'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>


                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="fa fa-file category-icon "></i>
                                                <h4>Reports Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Reports'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card permission-card">
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <i class="ti-dashboard category-icon "></i>
                                                <h4>Dashboard Module</h4>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    @if (str($permission->name)->startsWith('Dashboard'))
                                                        <div class="col-md-6">
                                                            <div class="permission-item">
                                                                <div class="d-flex align-items-center">

                                                                    <label class="checkbox-container">
                                                                        <input id="select_all" type="checkbox"
                                                                            name="name[]"
                                                                            value="{{ $permission->name }}"{{ $hasPermissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                                        <div class="checkmark"></div>
                                                                    </label>

                                                                    <label class="form-check-label mt-1 mx-2 mb-3">
                                                                        {{ $permission->name }}
                                                                    </label>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary my-4" type="submit">
                                        <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i> 
                                        Save Changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>




    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $("#select_all").on("change", function() {
                    const isChecked = $(this).is(":checked");
                    $("input[name='name[]']").prop("checked", isChecked);

                });
            });
        </script>
    @endsection
