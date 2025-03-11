@extends('layouts.app')

@section('title', 'Departments')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Departments</h2>
                            @can('Department Create')
                                <a href="{{ route('department.create') }}" class="btn btn-primary">Create Department</a>
                            @endcan
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="Department_table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Name</th>
                                            <th>Employees</th>
                                            <th>Branch Name</th>
                                            <th>Branch Address</th>
                                            <th>Date</th>
                                            @if (auth()->user()->can('Department Edit') || auth()->user()->can('Department Delete'))
                                                <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departments as $department)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $department->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $department->department_name }}</td>
                                                <td>{{ $department->employee->count() }}</td>
                                                <td>{{ $department->branch->name }}</td>
                                                <td>{{ $department->branch->address }}</td>
                                                <td>{{ $department->created_at->format('Y-M-d') }}</td>
                                                @if (auth()->user()->can('Department Edit') || auth()->user()->can('Department Delete'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            @can('Department Edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('department.edit', $department) }}">Edit</a>
                                                            @endcan

                                                            @can('Department Delete')
                                                                @if ($department->id == 1)
                                                                @else
                                                                    <form class="department-delete-form"
                                                                        action="{{ route('department.destroy', $department) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="dropdown-item"
                                                                            type="submit">Delete</button>
                                                                    </form>
                                                                @endif
                                                            @endcan
                                                        </div>
                                                    </td>
                                                @endcan
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
        var department_delete_btn = @json(auth()->user()->can('Department Delete'));


        $(document).on("click", ".department-delete-form", function(e) {
            let form = this;
            e.preventDefault();
            Swal.fire({
                title: 'Confirmation',
                text: 'Do You Really Want To Delete This Department ? This Action Cannot Be Reversable',
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
        })
    </script>

@endsection
