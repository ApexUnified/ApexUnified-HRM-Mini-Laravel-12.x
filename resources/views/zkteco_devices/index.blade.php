@extends('layouts.app')

@section('title', 'ZkTeco Devices')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <!-- table primary start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">ZkTeco Devices</h2>

                            @can('Device Create')
                                <a href="{{ route('zkteco_device.create') }}" class="btn btn-primary">Create ZkTeco
                                    Device</a>
                            @endcan

                        </div>
                        <div class="single-table mt-5">
                            <div class="data-tables">
                                <table id="zkteco_devices_table" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th class="no-print"></th>
                                            <th class="no-print">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" id="select_all">
                                                    <div class="checkmark"></div>
                                                </label>
                                            </th>
                                            <th>Device Name</th>
                                            <th>Device Ip</th>
                                            <th>Device Port</th>
                                            <th>Device Status</th>
                                            <th>Date</th>
                                            @if (auth()->user()->can('Device Edit') || auth()->user()->can('Device Delete'))
                                                <th class="no-print">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $device)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <label class="checkbox-container" style="margin-left: 0.5rem">
                                                        <input type="checkbox" class="each_select"
                                                            value="{{ $device->id }}">
                                                        <div class="checkmark"></div>
                                                    </label>
                                                </td>
                                                <td>{{ $device->name }}</td>
                                                <td>{{ $device->ip_address }}</td>
                                                <td>{{ $device->port }}</td>
                                                <td>

                                                    @php
                                                        $timeout = 5;
                                                        $isConnected = false;

                                                        try {
                                                            $socket = @stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);

                                                            if ($socket) {
                                                                fclose($socket);
                                                                $isConnected = true;
                                                            }

                                                            if ($isConnected) {
                                                                echo '<span class="badge badge-success p-2 rounded">Connected</span>';
                                                            } else {
                                                                echo '<span class="badge badge-danger p-2 rounded">Disconnected</span>';
                                                            }
                                                        } catch (\Exception $e) {
                                                            echo '<span class="badge badge-danger p-2 rounded">Disconnected</span>';
                                                        }
                                                    @endphp
                                                </td>
                                                <td>{{ $device->created_at->format('Y-M-d') }}</td>
                                                @if (auth()->user()->can('Device Edit') || auth()->user()->can('Device Delete'))
                                                    <td>
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                            @can('Device Edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('zkteco_device.edit', $device) }}">Edit</a>
                                                            @endcan


                                                            @can('Device Delete')
                                                                <form class="device-delete-form"
                                                                    action="{{ route('zkteco_device.destroy', $device) }}"
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
            var device_delete_btn = @json(auth()->user()->can('Device Delete'));

            $(document).on("click", ".device-delete-form", function(e) {
                let form = this;
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Do You Really Want To Delete This Device ? This Action Cannot Be Reversable',
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
