@extends('layouts.app')

@use('App\Models\Setting')
@use('Carbon\Carbon')

@section('title', 'Overtimes')

@section('content')



    <div class="main-content-inner">
        <div class="row">
            <div class="mt-5 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <h2 class="display-5">Overtimes</h2>
                            @can('Overtime Create')
                                <a href="{{ route('overtime.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i>
                                    Create Overtime</a>
                            @endcan
                        </div>
                        @include('Partials.Overtime.table_body', [
                            'overtimes' => $overtimes,
                            'setting' => $setting,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        var overtime_delete_btn = @json(auth()->user()->can('Overtime Delete'));

        $(document).ready(function() {

            $(document).on('click', '#overtime-pagination-links a', function(e) {
                e.preventDefault();
                let pageUrl = $(this).attr("href");


                $.get(pageUrl, function(data) {
                    let htmlData = $("<div>").html(data);
                    let newRows = htmlData.find(".overtime-table-rows");
                    let newPagination = $(htmlData).find("#overtime-pagination-links").html();

                    if (newRows.length > 0) {
                        $("tbody").html(newRows);
                    } else {
                        console.log("No New Table Data");
                    }


                    if (newPagination) {
                        $("#overtime-pagination-links").html(newPagination);
                    } else {
                        console.log("No New Pagination");
                    }
                });


            });


            $(document).on("click", ".overtime-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Overtime ? This Action Cannot Be Reversable',
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
