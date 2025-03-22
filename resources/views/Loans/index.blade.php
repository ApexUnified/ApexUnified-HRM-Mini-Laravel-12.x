@extends('layouts.app')

@section('title', 'Loans')

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
                            <h2 class="display-5">Loans</h2>

                            @can("Loan Create")
                            <a href="{{ route('loan.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-square fa-lg mx-1"></i>
                                Create Loan</a>
                            @endcan

                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="Loan_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Employee Name</th>
                                            <th>Loan Type</th>
                                            <th>Loan Amount</th>
                                            <th>Loan Deduction Amount</th>
                                            <th>Remeaning Loan</th>
                                            <th>Repayment Date</th>
                                            <th>Loan Status</th>
                                            <th>Description</th>
                                            <th>Date</th>

                                            @if(auth()->user()->can("Loan Edit") || auth()->user()->can("Loan Delete"))
                                            <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loans as $loan)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $loan->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>

                                                <td>{{ $loan->employee->employee_name }}</td>
                                                <td>{{ $loan->loan_type }}</td>
                                                <td>{{ $setting->currency }} {{ $loan->loan_amount }}</td>
                                                <td>{{ $setting->currency }} {{ $loan->loan_deduction_amount }}</td>
                                                <td>{{ $setting->currency }} {{ $loan->remeaning_loan }}</td>
                                                <td>{{ $loan->repayment_date }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $loan->status == 'Active' ? 'primary' : 'success' }} p-2 text-light">{{ $loan->status }}</span>
                                                </td>
                                                <td>{{ $loan->description ?? 'No Description Given' }}</td>
                                                <td>{{ $loan->loan_date }}</td>

                                                @if(auth()->user()->can("Loan Edit") || auth()->user()->can("Loan Delete"))
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        @can("Loan Edit")
                                                        <a class="dropdown-item"
                                                            href="{{ route('loan.edit', $loan) }}">
                                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                                            Edit</a>

                                                        @endcan

                                                        @can("Loan Delete")
                                                        <form class="loan-delete-form"
                                                            action="{{ route('loan.destroy', $loan) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">
                                                                <i class="fa-solid fa-trash fa-lg mx-1"></i>
                                                                Delete</button>
                                                        </form>
                                                        @endcan

                                                    </div>
                                                </td>
                                                @endif
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

        <script>
            var loan_delete_btn = @json(auth()->user()->can('Loan Delete'));
            $(document).on("click", ".loan-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Loan ? This Action Cannot Be Reversable',
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
