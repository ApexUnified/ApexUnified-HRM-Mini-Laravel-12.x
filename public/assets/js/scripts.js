
(function ($) {
    "use strict";

    /*================================
    Preloader
    ==================================*/

    $(document).ready(function () {
        $("select").selectpicker();
    });


    var preloader = $('#preloader');
    $(window).on('load', function () {
        setTimeout(function () {
            preloader.fadeOut('slow', function () { $(this).remove(); });
        }, 300)
    });

    /*================================
    sidebar collapsing
    ==================================*/
    if (window.innerWidth <= 1364) {
        $('.page-container').addClass('sbar_collapsed');
    }
    $('.nav-btn').on('click', function () {
        $('.page-container').toggleClass('sbar_collapsed');
    });

    /*================================
    Start Footer resizer
    ==================================*/
    var e = function () {
        var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
        (e -= 67) < 1 && (e = 1), e > 67 && $(".main-content").css("min-height", e + "px")
    };
    $(window).ready(e), $(window).on("resize", e);

    /*================================
    sidebar menu
    ==================================*/
    $("#menu").metisMenu();

    /*================================
    slimscroll activation
    ==================================*/
    $('.menu-inner').slimScroll({
        height: 'auto'
    });
    $('.nofity-list').slimScroll({
        height: '435px'
    });
    $('.timeline-area').slimScroll({
        height: '500px'
    });
    $('.recent-activity').slimScroll({
        height: 'calc(100vh - 114px)'
    });
    $('.settings-list').slimScroll({
        height: 'calc(100vh - 158px)'
    });

    /*================================
    stickey Header
    ==================================*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop(),
            mainHeader = $('#sticky-header'),
            mainHeaderHeight = mainHeader.innerHeight();

        // console.log(mainHeader.innerHeight());
        if (scroll > 1) {
            $("#sticky-header").addClass("sticky-menu");
        } else {
            $("#sticky-header").removeClass("sticky-menu");
        }
    });

    /*================================
    form bootstrap validation
    ==================================*/
    $('[data-toggle="popover"]').popover()

    /*------------- Start form Validation -------------*/
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    /*================================
    datatable active
    ==================================*/
    if ($('#table').length) {
        $('#table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    title: 'Table Data',
                    className: 'btn btn-sm font-sm btn-success',
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: 'Table Data',
                    className: 'btn btn-sm font-sm btn-danger',
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                }, {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    title: 'Table Data',
                    className: 'btn btn-sm font-sm btn-primary',
                    exportOptions: {
                        columns: ':visible:not(.no-print)'
                    }
                },
            ], initComplete: function () {
                $("#table_filter").appendTo(".dt-buttons");
            }


        });
    }


    /*================================
  Flat TimePicker
  ==================================*/

    function initializeTimePickers() {

        // Schedule
        flatpickr("#timepicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minuteIncrement: 15
        });
        flatpickr("#timepicker2", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minuteIncrement: 15
        });


        // Attendance
        flatpickr("#checkin", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minuteIncrement: 15
        });


        flatpickr("#checkout", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minuteIncrement: 15
        });
    }
    $(document).ready(function () {
        initializeTimePickers();
    });


    /*================================
    DatePicker
   ==================================*/

    $(document).ready(function () {


        $("#attendance_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });


        $("#holiday_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });


        $("#report_from").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });

        $("#report_to").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });

        $("#loan_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });


        $("#repayment_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });

        $("#advance_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });

        $("#advance_salary_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });

    });


    /*================================
    datatable active
    ==================================*/


    $(document).ready(function () {


        if ($('#zkteco_devices_table').length) {
            $('#zkteco_devices_table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'ZKTeco Devices',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'ZKTeco Devices',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('zkteco_devices_table').outerHTML;
                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                            <html>
                                <head>
                                    <title>Print Table</title>
                                    <style>
                                        /* Add your custom print styles here */
                                        body { font-family: Arial, sans-serif; padding: 20px; }
                                        h2 { text-align: center; }
                                        table { width: 100%; border-collapse: collapse; }
                                        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                        th { background-color: #f2f2f2; }
                                       th:first-child, td:first-child { display: none; }
                                        th:nth-child(2), td:nth-child(2) { display: none; }
                                        th:last-child, td:last-child { display: none; }
                                    </style>
                                </head>
                                <body>
                                    <h2>ZKTeco Devices</h2>
                                    ${tableContent}
                                </body>
                            </html>
                        `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },

                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "device_delete-btn"
                        }
                    },

                ], initComplete: function () {
                    $("#zkteco_devices_table_filter").appendTo(".dt-buttons");
                }

            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#zkteco_devices_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (device_delete_btn) {
                $("#device_delete-btn").show();
            } else {
                $("#device_delete-btn").hide();
            }
        }


        if ($('#attendance_report_table').length) {
            $('#attendance_report_table').DataTable({
                responsive: true,
                dom: 'Bfrtip',

                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Attendances Report',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Attendances Report',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('attendance_report_table').outerHTML;
                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                            <html>
                                <head>
                                    <title>Print Table</title>
                                    <style>
                                        /* Add your custom print styles here */
                                        body { font-family: Arial, sans-serif; padding: 20px; }
                                        h2 { text-align: center; }
                                        table { width: 100%; border-collapse: collapse; }
                                        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                        th { background-color: #f2f2f2; }
                                        th:last-child, td:last-child { display: none; }
                                    </style>
                                </head>
                                <body>
                                    <h2>Attendances Report</h2>
                                    ${tableContent}
                                </body>
                            </html>
                        `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },

                ], initComplete: function () {
                    $("#attendance_report_table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#attendance_report_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();
        }


        if ($('#loan_payment_report_table').length) {
            $('#loan_payment_report_table').DataTable({
                responsive: true,
                dom: 'Bfrtip',

                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Loan Payments Report',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Loan Payments Report',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('loan_payment_report_table').outerHTML;
                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                            <html>
                                <head>
                                    <title>Print Table</title>
                                    <style>
                                        /* Add your custom print styles here */
                                        body { font-family: Arial, sans-serif; padding: 20px; }
                                        h2 { text-align: center; }
                                        table { width: 100%; border-collapse: collapse; }
                                        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                        th { background-color: #f2f2f2; }
                                        th:last-child, td:last-child { display: none; }
                                    </style>
                                </head>
                                <body>
                                    <h2>Loan Payments Report</h2>
                                    ${tableContent}
                                </body>
                            </html>
                        `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },

                ], initComplete: function () {
                    $("#loan_payment_report_table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#loan_payment_report_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();
        }



        if ($('#Department_table').length) {
            $('#Department_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Departments',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Departments',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Department_table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Departments</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "dep_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Department_table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Department_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (department_delete_btn) {
                $("#dep_delete-btn").show();
            } else {
                $("#dep_delete-btn").hide();
            }
        }

        if ($('#Employee_table').length) {
            $('#Employee_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Employees',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Employees',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Employee_table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                            th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Employees</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "emp_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Employee_table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Employee_table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

            if (employee_delete_btn) {
                $("#emp_delete-btn").show();
            } else {
                $("#emp_delete-btn").hide();
            }
        }


        if ($('#Employee_Schedule_table').length) {
            $('#Employee_Schedule_table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Employee Schedule',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Employee Schedule',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Employee_Schedule_table').outerHTML;
                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Employee Schedules</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },

                ], initComplete: function () {
                    $("#Employee_Schedule_table_filter").appendTo(".dt-buttons");
                }


            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Employee_Schedule_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();
        }


        if ($('#Jobnature_Table').length) {
            $('#Jobnature_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Job Natures',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Job Natures',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Jobnature_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Job Natures</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "job_nature_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Jobnature_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Jobnature_Table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (job_nature_delete_btn) {
                $("#job_nature_delete-btn").show();
            } else {
                $("#job_nature_delete-btn").hide();
            }
        }


        if ($('#Position_Table').length) {
            $('#Position_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Positions',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Positions',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Position_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Positions</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "position_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Position_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Position_Table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (position_delete_btn) {
                $("#position_delete-btn").show();
            } else {
                $("#position_delete-btn").hide();
            }
        }


        if ($('#PositionLevel_Table').length) {
            $('#PositionLevel_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Position Levels',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Position Levels',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('PositionLevel_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Position Levels</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "position-level_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#PositionLevel_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#PositionLevel_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

        }



        if ($('#Allowance_Table').length) {
            $('#Allowance_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Allowances',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Allowances',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Allowance_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Allowances</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "allowance_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Allowance_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Allowance_Table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (allowance_delete_btn) {
                $("#allowance_delete-btn").show();
            } else {
                $("#allowance_delete-btn").hide();
            }
        }

        if ($('#AllowanceType_Table').length) {
            $('#AllowanceType_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Allowance Types',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Allowance Types',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('AllowanceType_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Allowance Types</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "allowance-type_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#AllowanceType_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#AllowanceType_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();


        }


        if ($('#Currency_Table').length) {
            $('#Currency_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Currencies',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Currencies',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Currency_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Currencies</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "currency_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Currency_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Currency_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

        }

        if ($('#Bonus_Table').length) {
            $('#Bonus_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Bonuses',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Bonuses',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Bonus_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Bonuses</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "bonus_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Bonus_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Bonus_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

            if (bonus_delete_btn) {
                $("#bonus_delete-btn").show();
            } else {
                $("#bonus_delete-btn").hide();
            }

        }

        if ($('#Loan_Table').length) {
            $('#Loan_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Loans',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Loans',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Loan_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Loans</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "loan_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Loan_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Loan_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

            if (loan_delete_btn) {
                $("#loan_delete-btn").show();
            } else {
                $("#loan_delete-btn").hide();
            }

        }

        if ($('#Deduction_Table').length) {
            $('#Deduction_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Deductions',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Deductions',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Deduction_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Deductions</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "deduction_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Deduction_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Deduction_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

            if (deduction_delete_btn) {
                $("#deduction_delete-btn").show();
            } else {
                $("#deduction_delete-btn").hide();
            }

        }

        if ($('#TaxDeduction_Table').length) {
            $('#TaxDeduction_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Tax Deductions',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Tax Deductions',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('TaxDeduction_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Tax Deductions</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "tax_deduction_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#TaxDeduction_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#TaxDeduction_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

            if (tax_deduction_delete_btn) {
                $("#tax_deduction_delete-btn").show();
            } else {
                $("#tax_deduction_delete-btn").hide();
            }

        }


        if ($('#CashAdvance_Table').length) {
            $('#CashAdvance_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Cash Advances',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Cash Advances',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('CashAdvance_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Cash Advances</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "cash-advance_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#CashAdvance_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#CashAdvance_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

            if (cash_advance_delete_btn) {
                $("#cash-advance_delete-btn").show();
            } else {
                $("#cash-advance_delete-btn").hide();
            }
        }

        if ($('#AdvanceSalary_Table').length) {
            $('#AdvanceSalary_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Advance Salaries',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Advance Salaries',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('AdvanceSalary_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Advance Salaries</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "advance-salary_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#AdvanceSalary_Table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#AdvanceSalary_Table_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();

            if (advance_salary_delete_btn) {
                $("#advance-salary_delete-btn").show();
            } else {
                $("#advance-salary_delete-btn").hide();
            }

        }


        if ($('#schedule_table').length) {
            $('#schedule_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Schedules',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Schedules',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {

                            let tableContent = document.getElementById('schedule_table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                            th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Schedules</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "schedule_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#schedule_table_filter").appendTo(".dt-buttons");
                }


            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#schedule_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (schedule_delete_btn) {
                $("#schedule_delete-btn").show();
            } else {
                $("#schedule_delete-btn").hide();
            }
        }


        if ($('#holiday_table').length) {
            $('#holiday_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Holidays',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Holidays',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {

                            let tableContent = document.getElementById('holiday_table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                            th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Holidays</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "holiday_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#holiday_table_filter").appendTo(".dt-buttons");
                }


            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#holiday_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (holiday_delete_btn) {
                $("#holiday_delete-btn").show();
            } else {
                $("#holiday_delete-btn").hide();
            }
        }

        if ($('#overtime_table').length) {
            $('#overtime_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Overtimes',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Overtimes',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {

                            let tableContent = document.getElementById('overtime_table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                            th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Overtimes</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "overtime_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#overtime_table_filter").appendTo(".dt-buttons");
                }


            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#overtime_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (overtime_delete_btn) {
                $("#overtime_delete-btn").show();
            } else {
                $("#overtime_delete-btn").hide();
            }
        }







        if ($('#attendance_table').length) {
            $('#attendance_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],

                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Attendance',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Attendance',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('attendance_table').outerHTML;
                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                            th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Attendances</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "attendance_delete-btn"
                        },
                    },
                ], initComplete: function () {
                    $("#attendance_table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#attendance_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (attendance_delete_btn) {
                $("#attendance_delete-btn").show()
            } else {
                $("#attendance_delete-btn").hide()
            }
        }



        if ($('#user-list_table').length) {
            $('#user-list_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'User List',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'User List',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('user-list_table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px;}
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Users List</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "user-list_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#user-list_table_filter").appendTo(".dt-buttons");
                }


            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#schedule_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (user_delete_btn) {
                $("#user-list_delete-btn").show()
            } else {
                $("#user-list_delete-btn").hide()
            }
        }




        if ($('#role_table').length) {
            $('#role_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Role',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Role',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('role_table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px;}
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Roles</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "role_delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#role_table_filter").appendTo(".dt-buttons");
                }




            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#role_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();


        }


        if ($('#Branch_Table').length) {
            $('#Branch_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Branch',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Branch',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('Branch_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px;}
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Branch</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "branch-delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#Branch_Table_filter").appendTo(".dt-buttons");
                }
            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#Branch_Table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

        }


        if ($('#JobNatureType_Table').length) {
            $('#JobNatureType_Table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Job Nature Types',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Job Nature Types',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('JobNatureType_Table').outerHTML;

                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px;}
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                             th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Job Nature Types</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "jobnaturetype-delete-btn"
                        }
                    },
                ], initComplete: function () {
                    $("#JobNatureType_Table_filter").appendTo(".dt-buttons");
                }
            });

            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#JobNatureType_Table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

        }



        if ($('#payslip_table').length) {
            $('#payslip_table').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1] }
                ],

                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        title: 'Paylsips',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: 'Paylsips',
                        className: 'btn btn-sm font-sm dt-icon',
                        exportOptions: {
                            columns: ':hidden:not(.no-print), :visible:not(.no-print)'
                        }
                    }, {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm font-sm dt-icon',
                        action: function () {
                            let tableContent = document.getElementById('payslip_table').outerHTML;
                            let printWindow = window.open('', '_blank');

                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                            /* Add your custom print styles here */
                                            body { font-family: Arial, sans-serif; padding: 20px; }
                                            h2 { text-align: center; }
                                            table { width: 100%; border-collapse: collapse; }
                                            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
                                            th { background-color: #f2f2f2; }
                                            th:first-child, td:first-child { display: none; }
                                            th:nth-child(2), td:nth-child(2) { display: none; }
                                            th:last-child, td:last-child { display: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <h2>Paylsips</h2>
                                        ${tableContent}
                                    </body>
                                </html>
                            `);

                            printWindow.document.close();
                            printWindow.print();
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o"></i>',
                        title: 'Delete',
                        className: 'btn btn-sm font-sm dt-icon',
                        attr: {
                            id: "payslip_delete-btn"
                        },
                    },
                ], initComplete: function () {
                    $("#payslip_table_filter").appendTo(".dt-buttons");
                }


            });
            $('.dataTables_filter input').attr('placeholder', 'Search..');
            $('.dataTables_filter input').attr('id', 'search');
            $('#payslip_table_filter label').contents().filter(function () {
                return this.nodeType === 3; // Check for text nodes
            }).remove();

            if (payslip_delete_btn) {
                $("#payslip_delete-btn").show()
            } else {
                $("#payslip_delete-btn").hide()
            }
        }









    });


    /*================================
    Delete By Deletion
    ==================================*/

    $(document).ready(function () {

        $("#select_all").on("change", function () {
            const isChecked = $(this).is(":checked");
            $(".each_select").prop("checked", isChecked);
        });

        $("#device_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
                console.log(selected_ids);
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Device',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Devices ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/device/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                device_ids: selected_ids
                            },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });

        $("#dep_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Department',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Departments ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'department/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { department_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });


        $("#emp_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Employee',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Employees ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'employee/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { employee_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });




        $("#schedule_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Schedule',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Schedules ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'schedule/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { overtime_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });


        $("#holiday_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Holiday',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Holidays ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'holiday/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { holiday_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });


        $("#overtime_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Overtime',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Overtimes ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'overtime/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { overtime_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });




        $("#attendance_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Attendance',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Attendances ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'attendance/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { attendance_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });



        $("#role_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Role',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Roles ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'role/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { role_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });




        $("#branch-delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Branch',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Branches ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/branch/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { branch_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });





        $("#job_nature_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Job Nature',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Job Natures ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/jobnature/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { job_nature_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });


            }


        });

        $("#jobnaturetype-delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Job Nature Type',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Job Nature Types ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/jobnature-type/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { job_nature_type_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });


            }


        });





        $("#position_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Position',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Positions ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/position/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { position_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });

        $("#position-level_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Position Level',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Position Levels ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/position-level/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { position_level_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });



        $("#allowance_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Allowance',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Allowances ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/allowance/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { allowance_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });

        $("#allowance-type_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Allowance Type',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Allowance Types ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/allowance-type/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { allowance_type_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });

        $("#bonus_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Bonus',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Bonuses ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/bonus/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { bonus_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });

        $("#loan_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Loan',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Loans ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/loan/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { loan_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });

        $("#deduction_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Deduction',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Deductions ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/deduction/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { deduction_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });


        $("#tax_deduction_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Tax Deduction',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Tax Deductions ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/tax-deduction/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { tax_deduction_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });

        $("#cash-advance_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Cash Advance',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Cash Advances ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/cash-advance/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { cash_advance_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                })



            }


        });

        $("#advance-salary_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Advance Salary',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Advance Salaries ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/advance-salary/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { advance_salary_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });


        $("#currency_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());

            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Currency',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Currencies ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/currency/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { currency_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });




        $("#user-list_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any User',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Users ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'user-list/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { user_list_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });


        $("#payslip_delete-btn").on("click", function () {

            const selected_ids = [];
            $(".each_select:checked").each(function () {
                selected_ids.push($(this).val());
            });

            if (selected_ids.length < 1) {
                Swal.fire({
                    title: 'info',
                    text: 'Please Select Any Payslip',
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#435ebe",
                });
            } else {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete Selected Payslips ? This Action Cannot Be Reversable',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#435ebe",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit!",
                    cancelButtonText: "Cancel",
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'payslip/deletebyselection',
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { payslip_ids: selected_ids },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Action Completed',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: "#435ebe",
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        });
                    }
                });



            }


        });


    });






    /*================================
    Slicknav mobile menu
    ==================================*/
    $('ul#nav_menu').slicknav({
        prependTo: "#mobile_menu"
    });

    /*================================
    login form
    ==================================*/
    $('.form-gp input').on('focus', function () {
        $(this).parent('.form-gp').addClass('focused');
    });
    $('.form-gp input').on('focusout', function () {
        if ($(this).val().length === 0) {
            $(this).parent('.form-gp').removeClass('focused');
        }
    });

    /*================================
    slider-area background setting
    ==================================*/
    $('.settings-btn, .offset-close').on('click', function () {
        $('.offset-area').toggleClass('show_hide');
        $('.settings-btn').toggleClass('active');
    });

    /*================================
    Owl Carousel
    ==================================*/
    function slider_area() {
        var owl = $('.testimonial-carousel').owlCarousel({
            margin: 50,
            loop: true,
            autoplay: false,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                450: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 2
                },
                1360: {
                    items: 1
                },
                1600: {
                    items: 2
                }
            }
        });
    }
    slider_area();

    /*================================
    Fullscreen Page
    ==================================*/

    if ($('#full-view').length) {

        var requestFullscreen = function (ele) {
            if (ele.requestFullscreen) {
                ele.requestFullscreen();
            } else if (ele.webkitRequestFullscreen) {
                ele.webkitRequestFullscreen();
            } else if (ele.mozRequestFullScreen) {
                ele.mozRequestFullScreen();
            } else if (ele.msRequestFullscreen) {
                ele.msRequestFullscreen();
            } else {
                console.log('Fullscreen API is not supported.');
            }
        };

        var exitFullscreen = function () {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else {
                console.log('Fullscreen API is not supported.');
            }
        };

        var fsDocButton = document.getElementById('full-view');
        var fsExitDocButton = document.getElementById('full-view-exit');

        fsDocButton.addEventListener('click', function (e) {
            e.preventDefault();
            requestFullscreen(document.documentElement);
            $('body').addClass('expanded');
        });

        fsExitDocButton.addEventListener('click', function (e) {
            e.preventDefault();
            exitFullscreen();
            $('body').removeClass('expanded');
        });
    }

})(jQuery);
