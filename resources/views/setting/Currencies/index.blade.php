@extends('layouts.app')

@section('title', 'Currencies')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Currencies</h2>
                            <a href="{{ route('currency.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-square fa-lg mx-1"></i> 
                                Create Currency</a>
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="Currency_Table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Currency Name</th>
                                            <th>Currency Symbol</th>
                                            <th>Date</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currencies as $currency)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $currency->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $currency->currency_name }}</td>
                                                <td>{{ $currency->currency_symbol }}</td>
                                                <td>{{ $currency->created_at->format('Y-M-d') }}</td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">

                                                        <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i> 
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        <a class="dropdown-item"
                                                            href="{{ route('currency.edit', $currency) }}">
                                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i> 
                                                            Edit</a>


                                                        <form class="currency-delete-form"
                                                            action="{{ route('currency.destroy', $currency) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">
                                                                
                                                                <i class="fa-solid fa-trash fa-lg mx-1"></i> 
                                                                Delete</button>
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

        <script>
            $(document).on("click", ".currency-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Currency ? This Action Cannot Be Reversable',
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
