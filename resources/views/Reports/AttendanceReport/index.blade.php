@extends('layouts.app')

@section('title', 'Reports')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Attendances Report</h2>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-12 text-center align-content-center">
                                <h3>Additional Filters</h3>
                            </div>
                        </div>
                        <form action="{{ route('attendance.report') }}" method="GET">
                            @csrf
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"
                                        style="font-size: 1.2rem"></i>
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_id">Employee</label>
                                        <select id="employee_id" name="employee_id" class="form-control">
                                            <option value="" hidden>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" @selected(request()->employee_id == $employee->id)>
                                                    {{ $employee->employee_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="report_from">From</label>
                                        <input type="text" id="report_from" name="from"
                                            class="form-control mx-2 flatpickr-datepicker" placeholder="yyyy-mm-dd"
                                            value="{{ request()->from }}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="report_from">To</label>
                                        <input type="text" id="report_to" name="to"
                                            class="form-control mx-2 flatpickr-datepicker" placeholder="yyyy-mm-dd"
                                            value="{{ request()->to }}">
                                    </div>
                                </div>
                            </div>

                        </form>

                        @include('Partials.Report.Attendance.table_body', [
                            'attendances' => $attendances,
                        ])
                    </div>
                </div>
            </div>
        </div>

    @endsection


    @section('js')

        <script>
            $(document).ready(function() {
                $(document).on('click', '#attendance-report-pagination-links a', function(e) {
                    e.preventDefault();
                    let pageUrl = $(this).attr("href");


                    $.get(pageUrl, function(data) {
                        let htmlData = $("<div>").html(data);
                        let newRows = htmlData.find(".attendance-report-table-rows");
                        let newPagination = $(htmlData).find("#attendance-report-pagination-links")
                            .html();

                        if (newRows.length > 0) {
                            $("tbody").html(newRows);
                        } else {
                            console.log("No New Table Data");
                        }


                        if (newPagination) {
                            $("#attendance-report-pagination-links").html(newPagination);
                        } else {
                            console.log("No New Pagination");
                        }
                    });


                });
            });
        </script>

    @endsection
