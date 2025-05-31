@extends('layouts.app')

@section('title', 'Dashboard')

@section('css')


    <style>
        .loader {
            width: 50px;
            aspect-ratio: 1;
            border-radius: 50%;
            border: 8px solid #0000;
            border-right-color: #ffa50097;
            position: relative;
            animation: l24 1s infinite linear;
        }

        .loader:before,
        .loader:after {
            content: "";
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: inherit;
            animation: inherit;
            animation-duration: 2s;
        }

        .loader:after {
            animation-duration: 4s;
        }

        @keyframes l24 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>


@endsection

@section('content')

    <div class="page-title-area">
        <div class="row align-items-center">
            <h3 class="display-5 p-3">System Statistics</h3>
            <hr>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row my-4">

            @can('Employee View')
                <div class="col-6 col-lg-3 col-md-6 mt-2">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>

                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="text-muted font-semibold">Employees</h6>
                                        <h6 class="font-extrabold mb-0">{{ $TotalEmployees }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('Department View')
                <div class="col-6 col-lg-3 col-md-6 mt-2">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fa fa-building"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="text-muted font-semibold">Departments</h6>
                                        <h6 class="font-extrabold mb-0">{{ $TotalDepartments }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('Device View')
                <div class="col-6 col-lg-3 col-md-6 mt-2">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; fill:white"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path
                                                d="M48 256C48 141.1 141.1 48 256 48c63.1 0 119.6 28.1 157.8 72.5c8.6 10.1 23.8 11.2 33.8 2.6s11.2-23.8 2.6-33.8C403.3 34.6 333.7 0 256 0C114.6 0 0 114.6 0 256l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40zm458.5-52.9c-2.7-13-15.5-21.3-28.4-18.5s-21.3 15.5-18.5 28.4c2.9 13.9 4.5 28.3 4.5 43.1l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40c0-18.1-1.9-35.8-5.5-52.9zM256 80c-19 0-37.4 3-54.5 8.6c-15.2 5-18.7 23.7-8.3 35.9c7.1 8.3 18.8 10.8 29.4 7.9c10.6-2.9 21.8-4.4 33.4-4.4c70.7 0 128 57.3 128 128l0 24.9c0 25.2-1.5 50.3-4.4 75.3c-1.7 14.6 9.4 27.8 24.2 27.8c11.8 0 21.9-8.6 23.3-20.3c3.3-27.4 5-55 5-82.7l0-24.9c0-97.2-78.8-176-176-176zM150.7 148.7c-9.1-10.6-25.3-11.4-33.9-.4C93.7 178 80 215.4 80 256l0 24.9c0 24.2-2.6 48.4-7.8 71.9C68.8 368.4 80.1 384 96.1 384c10.5 0 19.9-7 22.2-17.3c6.4-28.1 9.7-56.8 9.7-85.8l0-24.9c0-27.2 8.5-52.4 22.9-73.1c7.2-10.4 8-24.6-.2-34.2zM256 160c-53 0-96 43-96 96l0 24.9c0 35.9-4.6 71.5-13.8 106.1c-3.8 14.3 6.7 29 21.5 29c9.5 0 17.9-6.2 20.4-15.4c10.5-39 15.9-79.2 15.9-119.7l0-24.9c0-28.7 23.3-52 52-52s52 23.3 52 52l0 24.9c0 36.3-3.5 72.4-10.4 107.9c-2.7 13.9 7.7 27.2 21.8 27.2c10.2 0 19-7 21-17c7.7-38.8 11.6-78.3 11.6-118.1l0-24.9c0-53-43-96-96-96zm24 96c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 24.9c0 59.9-11 119.3-32.5 175.2l-5.9 15.3c-4.8 12.4 1.4 26.3 13.8 31s26.3-1.4 31-13.8l5.9-15.3C267.9 411.9 280 346.7 280 280.9l0-24.9z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="text-muted font-semibold">Total Devices</h6>
                                        <h6 class="font-extrabold mb-0">{{ $TotalDevices }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('Attendance View')
                <div class="col-6 col-lg-3 col-md-6 mt-2">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="text-muted font-semibold">Attendances</h6>
                                        <h6 class="font-extrabold mb-0">{{ $TotalAttendances }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>


        <div class="row my-4">
            @can('Holiday View')
                <div class="col-4 col-lg-4 col-md-4 mt-2">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fa fa-umbrella"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="text-muted font-semibold">Upcoming Holiday</h6>
                                        <h6 class="font-extrabold mb-0">{{ $upcomingHoliday }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan



            @can('Device View')
                <div class="col-4 col-lg-4 col-md-4 mt-2">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; fill:white"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path
                                                d="M48 256C48 141.1 141.1 48 256 48c63.1 0 119.6 28.1 157.8 72.5c8.6 10.1 23.8 11.2 33.8 2.6s11.2-23.8 2.6-33.8C403.3 34.6 333.7 0 256 0C114.6 0 0 114.6 0 256l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40zm458.5-52.9c-2.7-13-15.5-21.3-28.4-18.5s-21.3 15.5-18.5 28.4c2.9 13.9 4.5 28.3 4.5 43.1l0 40c0 13.3 10.7 24 24 24s24-10.7 24-24l0-40c0-18.1-1.9-35.8-5.5-52.9zM256 80c-19 0-37.4 3-54.5 8.6c-15.2 5-18.7 23.7-8.3 35.9c7.1 8.3 18.8 10.8 29.4 7.9c10.6-2.9 21.8-4.4 33.4-4.4c70.7 0 128 57.3 128 128l0 24.9c0 25.2-1.5 50.3-4.4 75.3c-1.7 14.6 9.4 27.8 24.2 27.8c11.8 0 21.9-8.6 23.3-20.3c3.3-27.4 5-55 5-82.7l0-24.9c0-97.2-78.8-176-176-176zM150.7 148.7c-9.1-10.6-25.3-11.4-33.9-.4C93.7 178 80 215.4 80 256l0 24.9c0 24.2-2.6 48.4-7.8 71.9C68.8 368.4 80.1 384 96.1 384c10.5 0 19.9-7 22.2-17.3c6.4-28.1 9.7-56.8 9.7-85.8l0-24.9c0-27.2 8.5-52.4 22.9-73.1c7.2-10.4 8-24.6-.2-34.2zM256 160c-53 0-96 43-96 96l0 24.9c0 35.9-4.6 71.5-13.8 106.1c-3.8 14.3 6.7 29 21.5 29c9.5 0 17.9-6.2 20.4-15.4c10.5-39 15.9-79.2 15.9-119.7l0-24.9c0-28.7 23.3-52 52-52s52 23.3 52 52l0 24.9c0 36.3-3.5 72.4-10.4 107.9c-2.7 13.9 7.7 27.2 21.8 27.2c10.2 0 19-7 21-17c7.7-38.8 11.6-78.3 11.6-118.1l0-24.9c0-53-43-96-96-96zm24 96c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 24.9c0 59.9-11 119.3-32.5 175.2l-5.9 15.3c-4.8 12.4 1.4 26.3 13.8 31s26.3-1.4 31-13.8l5.9-15.3C267.9 411.9 280 346.7 280 280.9l0-24.9z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    @livewire('dashboard.device-connection-component')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


            @can('Settings View')
                <div class="col-4 col-lg-4 col-md-4 mt-2">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fa fa-house"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h6 class="text-muted font-semibold">Branches</h6>
                                        <h6 class="font-extrabold mb-0">{{ $branches }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


        </div>


        <div class="row my-5">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        @livewire('dashboard.line-chart-component')
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        @livewire('dashboard.doughnut-chart-component')
                    </div>
                </div>
            </div>
        </div>






        @if (auth()->user()->hasRole('admin'))
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            @livewire('dashboard.payslip-component')
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body text-center">
                            @livewire('dashboard.cash-advance-component')
                        </div>
                    </div>
                </div>
            </div>


            <div class="row  ">
                <div class="col-lg-12 ">
                    <div class="card w-50 m-auto">
                        <div class="card-body">
                            @livewire('dashboard.advance-salary-component')
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    </div>


@endsection

@section('js')

    <script>
        $(document).ready(function() {



            $("#employee_input").selectpicker();
            let isAdmin = @json(auth()->user()->hasRole('admin'));

            if (isAdmin) {
                // Payslip Scripts Start
                Livewire.on("payslip-not-found", function() {
                    Swal.fire({
                        title: 'Payslip Not Found',
                        text: 'Error While Checking For Payslip',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                    });
                });


                Livewire.on("payslip-updated", function() {
                    Swal.fire({
                        title: 'Payslip Updated',
                        text: 'Payslip Updated Succesfully',
                        icon: 'success',
                        confirmButtonText: 'Okay',
                    });
                });


                Livewire.on("error-updating-payslip", function() {
                    Swal.fire({
                        title: 'Payslip Updating Error ',
                        text: 'Error Occured While Updating Payslip',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                    });


                });

                Livewire.on("payslip-deleted", function() {
                    Swal.fire({
                        title: 'Payslip Deleted ',
                        text: 'Payslip Has Been Deleted Succesfully',
                        icon: 'success',
                        confirmButtonText: 'Okay',
                    });
                });


                Livewire.on("error-deleting-payslip", function() {
                    Swal.fire({
                        title: 'Payslip Deleting Error ',
                        text: 'Error Occured While Deleting Payslip',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                    });
                });


                function confirmPayslipDelete(payslipId) {
                    Swal.fire({
                        title: 'Confirmation',
                        text: 'Do You Really Want To Delete This payslip ? This Action Cannot Be Reversable',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: "#435ebe",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Submit!",
                        cancelButtonText: "Cancel",
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch("deletePayslip", {
                                id: payslipId
                            });
                        }
                    })
                }

                document.querySelectorAll(".payslip-delete-btn").forEach((button) => {
                    button.addEventListener("click", function() {
                        let payslipId = this.getAttribute("data-id");
                        confirmPayslipDelete(payslipId);
                    });
                });


                // Payslip Scripts End


                // CashAdvacne Scripts Start
                Livewire.on("cash-advance-not-found", function() {
                    Swal.fire({
                        title: 'Cash Advance Not Found',
                        text: 'Error While Checking For Cash Advance',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                    });
                });


                Livewire.on("cash-advance-updated", function() {
                    Swal.fire({
                        title: 'Cash Advance Updated',
                        text: 'Cash Advance Updated Succesfully',
                        icon: 'success',
                        confirmButtonText: 'Okay',
                    });
                });


                Livewire.on("error-cash-advance", function() {
                    Swal.fire({
                        title: 'Error On Cash Advance ',
                        text: 'Error Occured While Updating Cash Advance',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                    });
                });


                // CashAdvacne Scripts End
            }




            // Line Chart Scripts Start

            if (isAdmin) {
                Livewire.on("chart-update", (data) => {

                    let ChartData = data[0][0];
                    AttendancesForLineChart = Object.values(ChartData.attendances) || {};
                    OvertimesForLineChart = Object.values(ChartData.overtimes) || {};
                    LoansForLineChart = Object.values(ChartData.loans) || {};
                    CashAdvanceForLineChart = Object.values(ChartData.cash_advances) || {};
                    AdvanceSalaryForLineChart = Object.values(ChartData.advance_salaries) || {};

                    if (window.myLineChart) {
                        window.myLineChart.destroy();
                    }

                    initializeCharts();
                });
            }



            initializeCharts();

            function initializeCharts() {

                var ctx = document.getElementById('myLineChart').getContext('2d');
                window.myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                                label: 'Attendances',
                                data: Object.values(AttendancesForLineChart),
                                backgroundColor: 'rgba(143, 27, 93)',
                                borderColor: 'rgba(143, 27, 93)',
                                borderWidth: 1
                            },
                            {
                                label: 'Overtimes',
                                data: Object.values(OvertimesForLineChart),
                                backgroundColor: 'rgba(152, 95, 179)',
                                borderColor: 'rgba(152, 95, 179)',
                                borderWidth: 1
                            },
                            {
                                label: 'Loans',
                                data: Object.values(LoansForLineChart),
                                backgroundColor: 'rgba(235, 128, 40)',
                                borderColor: 'rgba(235, 128, 40)',
                                borderWidth: 1
                            },

                            {
                                label: 'Cash Advances',
                                data: Object.values(CashAdvanceForLineChart),
                                backgroundColor: '#3E3F5B',
                                borderColor: '#3E3F5B',
                                borderWidth: 1
                            },

                            {
                                label: 'Advance Salaries',
                                data: Object.values(AdvanceSalaryForLineChart),
                                backgroundColor: '#BF3131',
                                borderColor: '#BF3131',
                                borderWidth: 1
                            },

                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: isAdmin ? 3 : 2.3,
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            function initSelectPicker() {
                if (window.jQuery && $.fn.selectpicker) {
                    console.log("✅ SelectPicker Loaded. Initializing...");
                    $("select").selectpicker("destroy").selectpicker();
                } else {
                    console.warn("⚠️ SelectPicker Not Found. Retrying...");
                    location.reload();
                }
            }
            // Line Chart Scripts End


            //    Dispatching Event For Loading Employee To Filter Employees From Charts
            if (window.Livewire) {
                setTimeout(() => {
                    Livewire.dispatch("loadAllEmployees");
                    initSelectPicker();


                    setTimeout(() => {
                        Livewire.dispatch("loadAllEmployeesFromDoughnut");
                    }, 1000);
                }, 200);

            } else {
                console.error("❌ Livewire is NOT loaded!");
            }


            // Doughnut Chart Start


            Livewire.on("update-doughnut-chart", (data) => {

                let ChartData = data[0][0];
                lateAttendancesForDoughnutChart = ChartData.late_attendances || 0;
                AbsentAttendancesForDoughnutChart = ChartData.absent_attendances || 0;
                EarlyAttendancesForDoughnutChart = ChartData.early_attendances || 0;


                if (window.myDonughnutChart) {
                    window.myDonughnutChart.destroy();
                }

                initializeDoughnutChart();
            });


            initializeDoughnutChart();

            function initializeDoughnutChart() {
                var DoughnutCtx = document.getElementById('myDoughnutChart').getContext('2d');
                window.myDonughnutChart = new Chart(DoughnutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: [
                            'Late Attendances',
                            'Absent Attendances',
                            "Early Attendances"
                        ],
                        datasets: [{
                                data: [
                                    lateAttendancesForDoughnutChart,
                                    AbsentAttendancesForDoughnutChart,
                                    EarlyAttendancesForDoughnutChart
                                ],
                                backgroundColor: [
                                    '#56021F',
                                    '#BF3131',
                                    "#00224D"
                                ],
                                hoverOffset: 4
                            },

                        ]

                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 2.3,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }

                });
            }

            // Doughnut Chart End



            if (isAdmin) {
                // Advance Salary Scripts Start

                Livewire.on("advance-salary-not-found", function() {
                    Swal.fire({
                        title: 'Advance Salary Not Found',
                        text: 'Error While Checking For Advance Salary',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                    });
                });


                Livewire.on("advance-salary-updated", function() {
                    Swal.fire({
                        title: 'Advance Salary Updated',
                        text: 'Advance Salary Updated Succesfully',
                        icon: 'success',
                        confirmButtonText: 'Okay',
                    });
                });



                Livewire.on("advance-salary-not-updated", function() {
                    Swal.fire({
                        title: 'Advance Salary Updated',
                        text: 'Error Occured While Updating Advance Salary',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                    });
                });


                // Advance Salary Scripts End
            }


            // Loading Connected Devices
            setTimeout(() => {
                Livewire.dispatch("loadConnectedDevices");
            }, 1500);
            // Loading Connected Devices


        });
    </script>

@endsection
