@extends('layouts.app')

@section('title', 'Employee Schedule')

@section('content')


    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Employees Schedule</h2>
                        </div>
                        @include('Partials.Employee_Schedule.table_body', [
                            'employees' => $employees,
                        ])
                    </div>
                </div>
            </div>
        </div>

    @endsection


    @section('js')

        <script>
            $(document).on('click', '#employee-schedule-pagination-links a', function(e) {
                e.preventDefault();
                let pageUrl = $(this).attr("href");



                $.get(pageUrl, function(data) {
                    let htmlData = $("<div>").html(data);
                    let newRows = htmlData.find(".employees-schedule-table-rows");
                    let newPagination = $(htmlData).find("#employee-schedule-pagination-links").html();

                    if (newRows.length > 0) {
                        $("tbody").html(newRows);
                    } else {
                        console.log("No New Table Data");
                    }


                    if (newPagination) {
                        $("#employee-schedule-pagination-links").html(newPagination);
                    } else {
                        console.log("No New Pagination");
                    }
                });


            });
        </script>

    @endsection
