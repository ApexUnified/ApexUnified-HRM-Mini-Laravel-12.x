@extends('layouts.app')

@section('title', 'User List')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Users</h2>

                            @can('User Create')
                                <a href="{{ route('user-list.create') }}" class="btn btn-primary">Create User</a>
                            @endcan

                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="user-list_table" class="text-center">
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
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Date</th>
                                            @if (auth()->user()->can('User Edit') || auth()->user()->can('User Delete'))
                                                <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="no-print"></td>
                                                <td class="no-print">
                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $user->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                                <td>{{ $user->created_at->format('Y-M-d') }}</td>

                                                @if (auth()->user()->can('User Edit') || auth()->user()->can('User Delete'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            @can('User Edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('user-list.edit', $user) }}">Edit</a>
                                                            @endcan

                                                            @if (auth()->user()->hasRole('admin') && auth()->user()->id == $user->id)
                                                            @else
                                                                @can('User Delete')
                                                                    <form class="user-delete-form"
                                                                        action="{{ route('user-list.destroy', $user) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="dropdown-item"
                                                                            type="submit">Delete</button>
                                                                    </form>
                                                                @endcan
                                                            @endif
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
            var user_delete_btn = @json(auth()->user()->can('User Delete'));


            $(document).on("click", ".user-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This User ? This Action Cannot Be Reversable',
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
