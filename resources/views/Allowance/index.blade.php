@extends('layouts.app')

@section('title', 'Allowances')

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
                            <h2 class="display-5">Allowances</h2>
                            <a href="{{ route('allowance.create') }}" class="btn btn-primary">Create Allowance</a>
                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="Allowance_Table" class="text-center">
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
                                            <th>Allowance Frequency</th>
                                            <th>Allowance Eligibility</th>
                                            <th>Allowance Amount</th>
                                            <th>Allowance Description</th>
                                            <th>Date</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allowances as $allowance)
                                            <tr>
                                                <td></td>
                                                <td>

                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $allowance->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $allowance->allowance_type }}</td>
                                                <td>{{ $allowance->frequency }}</td>

                                                @php
                                                    $eligibilityArray = json_decode($allowance->eligibility, true);
                                                    if (!empty($eligibilityArray)) {
                                                        $eligibility_key = array_key_first($eligibilityArray);
                                                        $eligibility_value = $eligibilityArray[$eligibility_key];
                                                    }
                                                @endphp

                                                <td>
                                                    @if (!empty($eligibilityArray))
                                                        {{ $eligibility_key }} - [
                                                        @if ($eligibility_key == 'department')
                                                            @php
                                                                $departments = \App\Models\Department::whereIn(
                                                                    'id',
                                                                    $eligibility_value,
                                                                )->get();
                                                            @endphp

                                                            @foreach ($departments as $department)
                                                                {{ $department->department_name }} ,
                                                            @endforeach
                                                        @elseif($eligibility_key == 'position')
                                                            @php
                                                                $positions = \App\Models\Position::whereIn(
                                                                    'id',
                                                                    $eligibility_value,
                                                                )->get();
                                                            @endphp

                                                            @foreach ($positions as $position)
                                                                {{ $position->position_name }} ,
                                                            @endforeach
                                                        @endif
                                                        ]
                                                    @else
                                                        All
                                                    @endif
                                                </td>
                                                <td> {{ $setting->currency }} {{ $allowance->allowance_amount }}</td>
                                                <td>{{ $allowance->description ?? 'No Description Given' }}</td>
                                                <td>{{ $allowance->created_at->format('Y-M-d') }}</td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item"
                                                            href="{{ route('allowance.edit', $allowance) }}">Edit</a>

                                                        <form class="allowance-delete-form"
                                                            action="{{ route('allowance.destroy', $allowance) }}"
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
            $(document).on("click", ".allowance-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Allowance ? This Action Cannot Be Reversable',
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
