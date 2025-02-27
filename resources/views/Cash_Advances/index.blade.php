@extends('layouts.app')

@section('title', 'Cash Advances')

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
                            <h2 class="display-5">Cash Advances</h2>
                            <a href="{{ route('cash-advance.create') }}" class="btn btn-primary">Create Cash Advance</a>
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="CashAdvance_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Cash Advance Employee</th>
                                            <th>Cash Advance Type</th>
                                            <th>Cash Advance Amount</th>
                                            <th>Cash Advance Status</th>
                                            <th>Description</th>
                                            <th>Cash Advance Date</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cash_advances as $cash_advance)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $cash_advance->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $cash_advance->employee->employee_name }}</td>
                                                <td>{{ $cash_advance->advance_type }}</td>
                                                <td> {{ $setting->currency }} {{ $cash_advance->advance_amount }}</td>
                                                <td>
                                                    @if ($cash_advance->advance_status == 'Rejected')
                                                        <span
                                                            class="badge bg-danger p-2 text-light">{{ $cash_advance->advance_status }}</span>
                                                    @elseif($cash_advance->advance_status == 'Pending')
                                                        <span
                                                            class="badge bg-danger p-2 text-light">{{ $cash_advance->advance_status }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-success p-2 text-light">{{ $cash_advance->advance_status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $cash_advance->description ?? 'No Description Given' }}</td>
                                                <td>{{ $cash_advance->advance_date }}</td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item"
                                                            href="{{ route('cash-advance.edit', $cash_advance) }}">Edit</a>

                                                        <form class="cash-advance-delete-form"
                                                            action="{{ route('cash-advance.destroy', $cash_advance) }}"
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
            $(document).on("click", ".cash-advance-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Cash Advance ? This Action Cannot Be Reversable',
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
