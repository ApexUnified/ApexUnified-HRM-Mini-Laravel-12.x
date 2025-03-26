@extends('layouts.app')

@section('title', 'Advance Salaries')

@section('content')




    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Advance Salaries</h2>


                            @can('Advance Salary Create')
                                <a href="{{ route('advance-salary.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i>
                                    Create Advance Salary</a>
                            @endcan

                        </div>
                        @include('Partials.AdvanceSalary.table_body', [
                            'setting' => $setting,
                            'advance_salaries' => $advance_salaries,
                        ])
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')



        <script>
            var advance_salary_delete_btn = @json(auth()->user()->can('Advance Salary Delete'));

            $(document).ready(function() {


                $(document).on('click', '#advanceSalary-pagination-links a', function(e) {
                    e.preventDefault();
                    let pageUrl = $(this).attr("href");


                    $.get(pageUrl, function(data) {
                        let htmlData = $("<div>").html(data);
                        let newRows = htmlData.find(".advanceSalary-table-rows");
                        let newPagination = $(htmlData).find("#advanceSalary-pagination-links")
                            .html();

                        if (newRows.length > 0) {
                            $("tbody").html(newRows);
                        } else {
                            console.log("No New Table Data");
                        }


                        if (newPagination) {
                            $("#advanceSalary-pagination-links").html(newPagination);
                        } else {
                            console.log("No New Pagination");
                        }
                    });


                });

                $(document).on("click", ".advance-salary-delete-form", function(e) {
                    let form = this;
                    e.preventDefault();
                    Swal.fire({
                        title: 'Confirmation',
                        text: 'Do You Really Want To Delete This Advance Salary ? This Action Cannot Be Reversable',
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
