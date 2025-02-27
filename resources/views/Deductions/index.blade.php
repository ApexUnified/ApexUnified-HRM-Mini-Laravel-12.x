@extends('layouts.app')

@section('title', 'Deductions')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
    @endphp

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Deductions</h2>
                            <a href="{{ route('deduction.create') }}" class="btn btn-primary">Create Deduction</a>
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="Deduction_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Deduction Type</th>
                                            <th>Deduction Amount</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deductions as $deduction)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $deduction->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>

                                                <td>{{ $deduction->deduction_type }}</td>
                                                <td>{{ $setting->currency }} {{ $deduction->deduction_amount }}</td>
                                                <td>{{ $deduction->description ?? 'No Description Given' }}</td>
                                                <td>{{ $deduction->created_at->format('Y-M-d') }}</td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item"
                                                            href="{{ route('deduction.edit', $deduction) }}">Edit</a>

                                                        <form class="deduction-delete-form"
                                                            action="{{ route('deduction.destroy', $deduction) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')

        {{-- <script>
            var job_nature_delete_btn = @json(auth()->user()->can('Department Delete'))
        </script> --}}

        <script>
            $(document).on("click", ".deduction-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Deduction ? This Action Cannot Be Reversable',
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
        </script>

    @endsection
