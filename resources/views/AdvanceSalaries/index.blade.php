@extends('layouts.app')

@section('title', 'Advance Salaries')

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
                            <h2 class="display-5">Advance Salaries</h2>
                            <a href="{{ route('advance-salary.create') }}" class="btn btn-primary">Create Advance Salary</a>
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="AdvanceSalary_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Advance Salary Employee</th>
                                            <th>Advance Salary Reason</th>
                                            <th>Advance Salary Amount</th>
                                            <th>Advance Salary Status</th>
                                            <th>Description</th>
                                            <th>Advance Salary Granted Date</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($advance_salaries as $advance_salary)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $advance_salary->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $advance_salary->employee->employee_name }}</td>
                                                <td>{{ $advance_salary->advance_salary_reason }}</td>
                                                <td> {{ $setting->currency }} {{ $advance_salary->advance_salary_amount }}
                                                </td>
                                                <td>
                                                    @if ($advance_salary->advance_salary_status == 'Rejected')
                                                        <span
                                                            class="badge bg-danger p-2 text-light">{{ $advance_salary->advance_salary_status }}</span>
                                                    @elseif($advance_salary->advance_salary_status == 'Pending')
                                                        <span
                                                            class="badge bg-danger p-2 text-light">{{ $advance_salary->advance_salary_status }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-success p-2 text-light">{{ $advance_salary->advance_salary_status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $advance_salary->description ?? 'No Description Given' }}</td>
                                                <td>{{ $advance_salary->advance_salary_date }}</td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item"
                                                            href="{{ route('advance-salary.edit', $advance_salary) }}">Edit</a>

                                                        <form class="advance-salary-delete-form"
                                                            action="{{ route('advance-salary.destroy', $advance_salary) }}"
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
        </script>

    @endsection
