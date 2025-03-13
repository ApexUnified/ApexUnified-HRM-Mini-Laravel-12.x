@php
    $setting = \App\Models\Setting::first();
    $id = Illuminate\Support\Facades\Auth::user()->id;
    $user = \App\Models\User::find($id);
@endphp

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo/' . $setting->favicon) }}">

    <!-- Start datatable css  -->
    {{--
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/Datatables_Assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Datatables_Assets/css/responsive.jqueryui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jqueryui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flatTimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/lib/filepond/filepond.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/lib/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
    @yield('css')
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>


    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="typewriter">
            <div class="slide"><i></i></div>
            <div class="paper"></div>
            <div class="keyboard"></div>
        </div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo />
                    </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">

                            @can('Dashboard View')
                                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('dashboard') }}"><i
                                            class="ti-dashboard"></i><span>Dashboard</span></a>
                                </li>
                            @endcan

                            @can('Attendance View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-calendar "></i><span>Attendances</span></a>
                                    <ul class="collapse">

                                        <li class="{{ request()->routeIs('attendance.index') ? 'active' : '' }}"><a
                                                href="{{ route('attendance.index') }}"><span>Attendances List</span></a>
                                        </li>

                                        @can("Attendance Create")
                                        <li class="{{ request()->routeIs('attendance.create') ? 'active' : '' }}"><a
                                                href="{{ route('attendance.create') }}"><span>Attendance Create</span></a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan





                            @can('Department View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-building"></i><span>Departments</span></a>
                                    <ul class="collapse">

                                        <li class="{{ request()->routeIs('department.index') ? 'active' : '' }}"><a
                                                href="{{ route('department.index') }}"><span>Departments List</span></a>
                                        </li>

                                        @can("Department Create")
                                        <li class="{{ request()->routeIs('department.create') ? 'active' : '' }}"><a
                                                href="{{ route('department.create') }}"><span>Department Create</span></a>
                                        </li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                            @can('Employee View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-users"></i><span>Employees</span></a>
                                    <ul class="collapse">

                                        <li class="{{ request()->routeIs('employee.index') ? 'active' : '' }}"><a
                                                href="{{ route('employee.index') }}"><span>Employees Lists</span></a></li>

                                        <li class="{{ request()->routeIs('employeeschedule.index') ? 'active' : '' }}"><a
                                                href="{{ route('employeeschedule.index') }}"><span>Employee
                                                    Schedules</span></a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan

                            @can("Job Nature View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i
                                        class="fa fa-briefcase"></i><span>Job
                                        Natures</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('jobnature.index') ? 'active' : '' }}"><a
                                            href="{{ route('jobnature.index') }}"><span>Job Natures List</span></a>
                                    </li>

                                    @can("Job Nature Create")
                                    <li class="{{ request()->routeIs('jobnature.create') ? 'active' : '' }}"><a
                                            href="{{ route('jobnature.create') }}"><span>Job Nature Create</span></a>
                                    </li>
                                    @endcan


                                </ul>
                            </li>
                            @endcan

                            @can("Position View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-user-md"></i>
                                    <span>Positions</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('position.index') ? 'active' : '' }}"><a
                                            href="{{ route('position.index') }}"><span>Positions List</span></a></li>


                                    @can("Position Create")
                                        <li class="{{ request()->routeIs('position.create') ? 'active' : '' }}"><a
                                                href="{{ route('position.create') }}"><span>Position Create</span></a>
                                        </li>
                                    @endcan


                                </ul>
                            </li>
                            @endcan

                            @can("Allowance View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-money"></i>
                                    <span>Allowances</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('allowance.index') ? 'active' : '' }}"><a
                                            href="{{ route('allowance.index') }}"><span>Allowances List</span></a>
                                    </li>

                                    @can("Allowance Create")
                                    <li class="{{ request()->routeIs('allowance.create') ? 'active' : '' }}"><a
                                            href="{{ route('allowance.create') }}"><span>Allowance Create</span></a>
                                    </li>
                                    @endcan


                                </ul>
                            </li>
                            @endcan

                            @can("Bonus View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-bitcoin"></i>
                                    <span>Bonuses</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('bonus.index') ? 'active' : '' }}"><a
                                            href="{{ route('bonus.index') }}"><span>Bonuses List</span></a>
                                    </li>


                                    @can("Bonus Create")
                                    <li class="{{ request()->routeIs('bonus.create') ? 'active' : '' }}"><a
                                            href="{{ route('bonus.create') }}"><span>Bonus Create</span></a>
                                    </li>
                                    @endcan

                                </ul>
                            </li>
                            @endcan

                            @can("Loan View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-credit-card"></i>
                                    <span>Loans</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('loan.index') ? 'active' : '' }}"><a
                                            href="{{ route('loan.index') }}"><span>Loans List</span></a>
                                    </li>

                                    @can("Loan Create")
                                    <li class="{{ request()->routeIs('loan.create') ? 'active' : '' }}"><a
                                            href="{{ route('loan.create') }}"><span>Loan Create</span></a>
                                    </li>
                                    @endcan

                                </ul>
                            </li>
                            @endcan

                            @can("Deduction View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-scissors"></i>
                                    <span>Deductions</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('deduction.index') ? 'active' : '' }}"><a
                                            href="{{ route('deduction.index') }}"><span>Deductions List</span></a>
                                    </li>


                                    @can("Deduction Create")
                                    <li class="{{ request()->routeIs('deduction.create') ? 'active' : '' }}"><a
                                            href="{{ route('deduction.create') }}"><span>Deduction Create</span></a>
                                    </li>
                                    @endcan

                                </ul>
                            </li>
                            @endcan

                            @can("Tax Deduction View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-file-text-o"></i>
                                    <span>Tax Deductions</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('tax-deduction.index') ? 'active' : '' }}"><a
                                            href="{{ route('tax-deduction.index') }}"><span>Tax Deductions
                                                List</span></a>
                                    </li>

                                    @can("Tax Deduction Create")
                                    <li class="{{ request()->routeIs('tax-deduction.create') ? 'active' : '' }}"><a
                                            href="{{ route('tax-deduction.create') }}"><span>Tax Deduction
                                                Create</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>

                            @endcan

                            @can("Cash Advance View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-bank"></i>
                                    <span>Cash Advances</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('cash-advance.index') ? 'active' : '' }}"><a
                                            href="{{ route('cash-advance.index') }}"><span>Cash Advances
                                                List</span></a>
                                    </li>

                                    @can("Cash Advance Create")
                                    <li class="{{ request()->routeIs('cash-advance.create') ? 'active' : '' }}"><a
                                            href="{{ route('cash-advance.create') }}"><span>Cash Advance
                                                Create</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan


                            @can("Advance Salary View")
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="fa fa-exchange"></i>
                                    <span>Advances Salaries</span></a>
                                <ul class="collapse">

                                    <li class="{{ request()->routeIs('advance-salary.index') ? 'active' : '' }}"><a
                                            href="{{ route('advance-salary.index') }}"><span>Advances Salaries
                                                List</span></a>
                                    </li>

                                    @can("Advance Salary Create")
                                    <li class="{{ request()->routeIs('advance-salary.create') ? 'active' : '' }}"><a
                                            href="{{ route('advance-salary.create') }}"><span>Advances Salary
                                                Create</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan



                            @can('Schedule View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-hourglass-half"></i><span>Schedules</span></a>
                                    <ul class="collapse">

                                        <li class="{{ request()->routeIs('schedule.index') ? 'active' : '' }}"><a
                                                href="{{ route('schedule.index') }}"><span>Schedules List</span></a>
                                        </li>

                                        @can("Schedule Create")
                                        <li class="{{ request()->routeIs('schedule.create') ? 'active' : '' }}"><a
                                                href="{{ route('schedule.create') }}"><span>Schedule Create</span></a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan



                                @can('Holiday View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-umbrella"></i><span>Holidays</span></a>
                                    <ul class="collapse">

                                        <li class="{{ request()->routeIs('holiday.index') ? 'active' : '' }}"><a
                                                href="{{ route('holiday.index') }}"><span>Holidays List</span></a>
                                        </li>

                                        @can("Holiday Create")
                                        <li class="{{ request()->routeIs('holiday.create') ? 'active' : '' }}"><a
                                                href="{{ route('holiday.create') }}"><span>Holiday Create</span></a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('Device View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" style="width: 18px"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M48 256C48 141.1 141.1 48 256 48c63.1 0 119.6 28.1 157.8 72.5c8.6 10.1 23.8 11.2 33.8 2.6s11.2-23.8 2.6-33.8C403.3 34.6 333.7 0 256 0C114.6 0 0 114.6 0 256l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40zm458.5-52.9c-2.7-13-15.5-21.3-28.4-18.5s-21.3 15.5-18.5 28.4c2.9 13.9 4.5 28.3 4.5 43.1l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40c0-18.1-1.9-35.8-5.5-52.9zM256 80c-19 0-37.4 3-54.5 8.6c-15.2 5-18.7 23.7-8.3 35.9c7.1 8.3 18.8 10.8 29.4 7.9c10.6-2.9 21.8-4.4 33.4-4.4c70.7 0 128 57.3 128 128l0 24.9c0 25.2-1.5 50.3-4.4 75.3c-1.7 14.6 9.4 27.8 24.2 27.8c11.8 0 21.9-8.6 23.3-20.3c3.3-27.4 5-55 5-82.7l0-24.9c0-97.2-78.8-176-176-176zM150.7 148.7c-9.1-10.6-25.3-11.4-33.9-.4C93.7 178 80 215.4 80 256l0 24.9c0 24.2-2.6 48.4-7.8 71.9C68.8 368.4 80.1 384 96.1 384c10.5 0 19.9-7 22.2-17.3c6.4-28.1 9.7-56.8 9.7-85.8l0-24.9c0-27.2 8.5-52.4 22.9-73.1c7.2-10.4 8-24.6-.2-34.2zM256 160c-53 0-96 43-96 96l0 24.9c0 35.9-4.6 71.5-13.8 106.1c-3.8 14.3 6.7 29 21.5 29c9.5 0 17.9-6.2 20.4-15.4c10.5-39 15.9-79.2 15.9-119.7l0-24.9c0-28.7 23.3-52 52-52s52 23.3 52 52l0 24.9c0 36.3-3.5 72.4-10.4 107.9c-2.7 13.9 7.7 27.2 21.8 27.2c10.2 0 19-7 21-17c7.7-38.8 11.6-78.3 11.6-118.1l0-24.9c0-53-43-96-96-96zm24 96c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 24.9c0 59.9-11 119.3-32.5 175.2l-5.9 15.3c-4.8 12.4 1.4 26.3 13.8 31s26.3-1.4 31-13.8l5.9-15.3C267.9 411.9 280 346.7 280 280.9l0-24.9z" />
                                        </svg>
                                        <span>ZkTeco Devices</span></a>
                                    <ul class="collapse">
                                        <li class="{{ request()->routeIs('zkteco_device.index') ? 'active' : '' }}"><a
                                                href="{{ route('zkteco_device.index') }}"><span>ZkTeco Devices
                                                    List</span></a>
                                        </li>

                                        @can("Device Create")
                                        <li class="{{ request()->routeIs('zkteco_device.create') ? 'active' : '' }}"><a
                                                href="{{ route('zkteco_device.create') }}"><span>ZkTeco Device
                                                    Create</span></a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('User View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-user"></i><span>Users</span></a>
                                    <ul class="collapse">

                                        <li class="{{ request()->routeIs('user-list.index') ? 'active' : '' }}"><a
                                                href="{{ route('user-list.index') }}"><span>Users List</span></a>
                                        </li>

                                        @can("User Create")
                                        <li class="{{ request()->routeIs('user-list.create') ? 'active' : '' }}"><a
                                                href="{{ route('user-list.create') }}"><span>User Create</span></a>
                                        </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                                <a href="{{ route('user.profile', auth()->user()->id) }}" aria-expanded="true"><i
                                        class="fa fa-user-times"></i><span>Your Profile</span></a>
                            </li>

                            @can('Reports View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-file"></i><span>Reports</span></a>
                                    <ul class="collapse">

                                        <li class="{{ request()->routeIs('attendance.report') ? 'active' : '' }}"><a
                                                href="{{ route('attendance.report') }}"><span>Attendances
                                                    Report</span></a></li>
                                    </ul>
                                </li>
                            @endcan

                            @can('Settings View')
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-gear"></i><span>Settings</span></a>
                                    <ul class="collapse">
                                        <li class="{{ request()->routeIs('setting.index') ? 'active' : '' }}"><a
                                                href="{{ route('setting.index') }}"><span>General
                                                    Setting</span></a></li>

                                        <li class="{{ request()->routeIs('setting.roles') ? 'active' : '' }}"><a
                                                href="{{ route('setting.roles') }}"><span>Roles
                                                    Permissions</span></a></li>


                                        <li class="{{ request()->routeIs('jobnature-type.index') ? 'active' : '' }}"><a
                                                href="{{ route('jobnature-type.index') }}"><span>Job Nature
                                                    Types</span></a>
                                        </li>


                                        <li class="{{ request()->routeIs('allowance-type.index') ? 'active' : '' }}"><a
                                                href="{{ route('allowance-type.index') }}"><span>Allowance
                                                    Types</span></a>
                                        </li>

                                        <li class="{{ request()->routeIs('position-level.index') ? 'active' : '' }}"><a
                                                href="{{ route('position-level.index') }}"><span>Position
                                                    Levels</span></a>
                                        </li>

                                        <li class="{{ request()->routeIs('mail-setting.index') ? 'active' : '' }}"><a
                                                href="{{ route('mail-setting.index') }}"><span>Mail Setting</span></a>
                                        </li>


                                        <li class="{{ request()->routeIs('branch.index') ? 'active' : '' }}"><a
                                                href="{{ route('branch.index') }}"><span>Branches</span></a>
                                        </li>

                                        <li class="{{ request()->routeIs('currency.index') ? 'active' : '' }}"><a
                                                href="{{ route('currency.index') }}"><span>Currecny</span></a>
                                        </li>


                                    </ul>
                                </li>
                            @endcan

                            <li style="opacity: 0">
                                <a href="javascript:void(0)" aria-expanded="true"><i
                                        class="fa fa-gear"></i><span>Settings2</span></a>
                            </li>



                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix ">
                        <ul class="notification-area pull-right d-flex align-items-center">
                            <li id="full-view"><i class="ti-fullscreen text-secondary"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out text-secondary"></i></li>
                            {{-- <li class="settings-btn">
                                <a href="#" class="text-secondary"><i class="ti-settings"
                                        style="font-size: 26px"></i></a>
                            </li> --}}

                            <div class="user-profile pull-right">

                                @if (!$user->profile)
                                    <img class="avatar user-thumb"
                                        src="{{ asset('assets/images/user-profile/user.jpeg') }}" alt="avatar">
                                @else
                                    <img class="avatar user-thumb"
                                        src="{{ asset('assets/images/user-profile/' . $user->profile) }}"
                                        alt="avatar">
                                @endif

                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                    {{ auth()->user()->name }}
                                    <i class="fa fa-angle-down"></i>
                                </h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('user.profile', $user) }}">Profile</a>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-secondary">Logout</button>
                                    </form>

                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- main content area Start -->
            @yield('content')

        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© {{ $setting->system_title }} | Developed By {{ $setting->developed_by }} </p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>



    <!-- jquery latest version -->
    <script src="{{ asset('assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jqueryui.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>


    <!-- bootstrap 4 js -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>



    <!-- Start datatable js -->

    {{--
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> --}}

    <script src="{{ asset('assets/Datatables_Assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/Datatables_Assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/Datatables_Assets/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/Datatables_Assets/js/dataTables.responsive.min.js') }}"></script> --}}


    <!-- Datatables Buttons Cdn -->
    <script src="{{ asset('assets/Datatables_Assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/Datatables_Assets/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/Datatables_Assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/Datatables_Assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/Datatables_Assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/Datatables_Assets/js/vfs_fonts.js') }}"></script>



    {{-- FilePond --}}
    <script src="{{ asset('assets/lib/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script src="{{ asset('assets/lib/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}">
    </script>
    <script src="{{ asset('assets/lib/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script
        src="{{ asset('assets/lib/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('assets/lib/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
    <script src="{{ asset('assets/lib/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/lib/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('assets/lib/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/js/filepond.js') }}"></script>
    {{-- FilePond --}}


    {{-- Sweetalert  --}}
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    {{-- Sweetalert  --}}


    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>


    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/flatTimepicker.js') }}"></script>
    @yield('js')


    {{-- @php
        $employees = \App\Models\Employee::all();
    @endphp --}}

    {{-- overtime employee modal Start --}}

    {{-- <div class="modal fade show" id="overtime_report_modal" style="display: none; padding-right: 17px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Employee</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <select class="custom-select" id="overtime_employee_id">
                        <option value="" hidden>Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary" id="overtime_report_btn">Create
                        Report</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- overtime employee modal End --}}





</body>


</html>
