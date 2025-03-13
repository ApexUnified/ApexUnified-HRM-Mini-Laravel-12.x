@extends('layouts.app')

@section('title', 'Positions')

@section('content')


    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Positions</h2>
                            @can('Position Create')
                                <a href="{{ route('position.create') }}" class="btn btn-primary">Create Position</a>
                            @endcan
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="Position_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Position Name</th>
                                            <th>Position Level</th>
                                            <th>Job Nature Type</th>
                                            <th>Date</th>

                                            @if(auth()->user()->can("Position Edit") || auth()->user()->can("Position Delete"))
                                            <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($positions as $position)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $position->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $position->position_name }}</td>
                                                <td>{{ $position->position_level }}</td>
                                                <td>{{ $position->jobnature->job_nature_type }}</td>
                                                <td>{{ $position->created_at->format('Y-M-d') }}</td>

                                                @if(auth()->user()->can("Position Edit") || auth()->user()->can("Position Delete"))
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        @can("Position Edit")
                                                        <a class="dropdown-item"
                                                            href="{{ route('position.edit', $position) }}">Edit</a>

                                                        @endcan  


                                                        @can("Position Delete")
                                                        <form class="position-delete-form"
                                                            action="{{ route('position.destroy', $position) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">Delete</button>
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

            var position_delete_btn = @json(auth()->user()->can("Position Delete")); 

            $(document).on("click", ".position-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Position ? This Action Cannot Be Reversable',
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
