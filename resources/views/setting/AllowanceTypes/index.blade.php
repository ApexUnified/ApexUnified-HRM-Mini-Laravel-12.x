@extends('layouts.app')

@section('title', 'Allowance Types')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Allowance Types</h2>
                            <a href="{{ route('allowance-type.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                Create Allowance Type</a>
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="AllowanceType_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Allowance Type</th>
                                            <th>Date</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allowance_types as $allowance_type)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $allowance_type->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $allowance_type->allowance_type }}</td>
                                                <td>{{ $allowance_type->created_at->format('Y-M-d') }}</td>
                                                @if ($allowance_type->id != 1)
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i> 
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item"
                                                                href="{{ route('allowance-type.edit', $allowance_type) }}">
                                                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i> 

                                                                Edit</a>


                                                            <form class="allowance_type-delete-form"
                                                                action="{{ route('allowance-type.destroy', $allowance_type) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="dropdown-item" type="submit">
                                                                    <i class="fa-solid fa-trash fa-lg mx-1"></i> 

                                                                    Delete</button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                @else
                                                    <td><span class="badge text-light p-3" style="background: #435ebe;">
                                                        <i class="fa-solid fa-exclamation fa-lg mx-1"></i> Actions Reserved For This Type
                                                        </span></td>
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
            $(document).on("click", ".allowance_type-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Allowance Type ? This Action Cannot Be Reversable',
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
