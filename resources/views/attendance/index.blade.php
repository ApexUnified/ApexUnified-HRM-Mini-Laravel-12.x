@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

    <div class="main-content-inner">
        <div class="row">

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Attendances</h2>
                            @can('Attendance Create')
                                <a href="{{ route('attendance.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i>
                                    Create Attendance</a>
                            @endcan
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-12 text-center align-content-center">
                                <h3>Additional Filters</h3>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('attendance.index') }}" method="GET">


                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-filter" style="font-size: 1.2rem"></i>
                                        </button>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-2" style="font-size: 19px">From:</label>
                                                <input type="text" id="min-date" name="from"
                                                    value="{{ request()->from }}"
                                                    class="flatpickr-datepicker form-control mr-2" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-2" style="font-size: 19px">To:</label>
                                                <input type="text" id="max-date" name="to"
                                                    value="{{ request()->to }}"
                                                    class="flatpickr-datepicker form-control mr-2" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>



                        @include('Partials.Attendances.table_body', [
                            'attendances' => $attendances,
                        ])
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')


        <script>
            var attendance_delete_btn = @json(auth()->user()->can('Attendance Delete'));
            $(document).ready(function() {


                $(document).on('click', '#attendance-pagination-links a', function(e) {
                    e.preventDefault();
                    let pageUrl = $(this).attr("href");


                    $.get(pageUrl, function(data) {
                        let htmlData = $("<div>").html(data);
                        let newRows = htmlData.find(".attendance-table-rows");
                        let newPagination = $(htmlData).find("#attendance-pagination-links").html();

                        if (newRows.length > 0) {
                            $("tbody").html(newRows);
                        } else {
                            console.log("No New Table Data");
                        }


                        if (newPagination) {
                            $("#attendance-pagination-links").html(newPagination);
                        } else {
                            console.log("No New Pagination");
                        }
                    });


                });



                $(document).on("click", ".attendance-delete-form", function(e) {
                    let form = this;
                    e.preventDefault();
                    Swal.fire({
                        title: 'Confirmation',
                        text: 'Do You Really Want To Delete This Attendance ? This Action Cannot Be Reversable',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: "#435ebe",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Submit!",
                        cancelButtonText: "Cancel",
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });

            });
        </script>

    @endsection
