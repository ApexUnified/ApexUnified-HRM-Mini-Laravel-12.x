@extends('layouts.app')

@section('title', 'Holidays')

@section('content')



    <div class="main-content-inner">
        <div class="row">
            <div class="mt-5 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <h2 class="display-5">Holidays</h2>
                            @can('Holiday Create')
                                <a href="{{ route('holiday.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                    Create Holiday</a>
                            @endcan
                        </div>
                        <div class="mt-5 single-table">
                            <div class="data-tables">
                                <table id="holiday_table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Holiday Name</th>
                                            <th>Holiday Date</th>
                                            <th>Created Date</th>

                                            @if (auth()->user()->can('Holiday Delete') || auth()->user()->can('Holiday Edit'))
                                                <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($holidays as $holiday)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $holiday->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $holiday->holiday_name }}</td>
                                                <td>{{ $holiday->holiday_date }}</td>
                                                <td>{{ $holiday->created_at->format('Y-M-d') }}</td>


                                                @if (auth()->user()->can('Holiday Delete') || auth()->user()->can('Holiday Edit'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            @can('Holiday Edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('holiday.edit', $holiday) }}">
                                                                    <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i
                                                                    Edit</a>
                                                            @endcan

                                                            @can('Holiday Delete')
                                                                <form class="holiday-delete-form"
                                                                    action="{{ route('holiday.destroy', $holiday) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="dropdown-item" type="submit">
                                                                        <i class="fa-solid fa-trash fa-lg mx-1"></i
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
    </div>
@endsection

@section('js')

    <script>
        var holiday_delete_btn = @json(auth()->user()->can('Holiday Delete'));

        $(document).on("click", ".holiday-delete-form", function(e) {
            let form = this;
            e.preventDefault();
            Swal.fire({
                title: 'Confirmation',
                text: 'Do You Really Want To Delete This Holiday ? This Action Cannot Be Reversable',
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
