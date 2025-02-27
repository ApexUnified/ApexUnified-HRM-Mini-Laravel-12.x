@extends('layouts.app')

@section('title', 'Schedule')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Schedules</h2>

                            @can('Schedule Create')
                                <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create Schedule</a>
                            @endcan

                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="schedule_table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Schedule Name</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Days</th>
                                            <th>On Time minutes</th>
                                            <th>Shift Start Time</th>
                                            <th>Shift End Time</th>
                                            <th>Date</th>

                                            @if (auth()->user()->can('Schedule Edit') || auth()->user()->can('Schedule Delete'))
                                                <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $schedule->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $schedule->name }}</td>
                                                <td>{{ $schedule->formatted_times['checkin'] }}</td>
                                                <td>{{ $schedule->formatted_times['checkout'] }}</td>
                                                <td>@php
                                                    $days = json_decode($schedule->days, true);
                                                @endphp

                                                    @if ($days && is_array($days))
                                                        {{ implode(', ', $days) }}
                                                    @else
                                                        No Days Assigned
                                                    @endif
                                                </td>
                                                <td>{{ $schedule->num_of_min_before_checkin . ' Minutes' }}</td>
                                                <td>{{ $schedule->shift_start_time . ' Minutes' }}</td>
                                                <td>{{ $schedule->shift_end_time . ' Minutes' }}</td>
                                                <td>{{ $schedule->created_at->format('Y-M-d') }}</td>
                                                @if (auth()->user()->can('Schedule Edit') || auth()->user()->can('Schedule Delete'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            @can('Schedule Edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('schedule.edit', $schedule) }}">Edit</a>
                                                            @endcan

                                                            @can('Schedule Delete')
                                                                <form class="schedule-delete-form"
                                                                    action="{{ route('schedule.destroy', $schedule) }}"
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
            var schedule_delete_btn = @json(auth()->user()->can('Schedule Delete'));

            $(document).on("click", ".schedule-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Schedule ? This Action Cannot Be Reversable',
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
