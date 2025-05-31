@extends('layouts.app')

@section('title', 'Job Natures')

@section('content')




    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Job Nature</h2>
                            @can('Job Nature Create')
                                <a href="{{ route('jobnature.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                    Create Job Nature</a>
                            @endcan
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="Jobnature_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Job Nature Type</th>
                                            <th>Description</th>
                                            <th>Date</th>

                                            @if(auth()->user()->can("Job Nature Edit") || auth()->user()->can("Job Nature Delete"))
                                            <th class="no-print">Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobNatures as $jobNature)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $jobNature->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $jobNature->job_nature_type }}</td>
                                                <td>{{ $jobNature->description ?? 'No Description Given' }}</td>
                                                <td>{{ $jobNature->created_at->format('Y-M-d') }}</td>

                                                @if(auth()->user()->can("Job Nature Edit") || auth()->user()->can("Job Nature Delete"))
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        @can("Job Nature Edit")
                                                        <a class="dropdown-item"
                                                            href="{{ route('jobnature.edit', $jobNature) }}">
                                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                                            Edit</a>
                                                        @endcan

                                                        @can("Job Nature Delete")
                                                        <form class="jobnature-delete-form"
                                                            action="{{ route('jobnature.destroy', $jobNature) }}"
                                                            method="POST">
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
            var job_nature_delete_btn = @json(auth()->user()->can('Job Nature Delete'));
            $(document).on("click", ".jobnature-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Job Nature ? This Action Cannot Be Reversable',
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
