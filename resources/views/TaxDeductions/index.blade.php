@extends('layouts.app')

@section('title', 'Tax Deductions')

@section('content')



    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Tax Deductions</h2>

                            @can('Tax Deduction Create')
                                <a href="{{ route('tax-deduction.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i>
                                    Create Tax Deduction </a>
                            @endcan

                        </div>
                        @include('Partials.TaxDeduction.table_body', [
                            'setting' => $setting,
                            'taxDeductions' => $taxDeductions,
                        ])
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')




        <script>
            var tax_deduction_delete_btn = @json(auth()->user()->can('Tax Deduction Delete'));



            $(document).ready(function() {
                $(document).on('click', '#taxDeduction-pagination-links a', function(e) {
                    e.preventDefault();
                    let pageUrl = $(this).attr("href");


                    $.get(pageUrl, function(data) {
                        let htmlData = $("<div>").html(data);
                        let newRows = htmlData.find(".taxDeduction-table-rows");
                        let newPagination = $(htmlData).find("#taxDeduction-pagination-links")
                            .html();

                        if (newRows.length > 0) {
                            $("tbody").html(newRows);
                        } else {
                            console.log("No New Table Data");
                        }


                        if (newPagination) {
                            $("#taxDeduction-pagination-links").html(newPagination);
                        } else {
                            console.log("No New Pagination");
                        }
                    });


                });

                $(document).on("click", ".tax-deduction-delete-form", function(e) {
                    let form = this;
                    e.preventDefault();
                    Swal.fire({
                        title: 'Confirmation',
                        text: 'Do You Really Want To Delete This Tax Deduction ? This Action Cannot Be Reversable',
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
