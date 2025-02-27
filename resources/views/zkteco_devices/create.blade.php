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
                            <h2 class="display-5">Create ZkTeco Device</h2>
                            <a href="{{ route('zkteco_device.index') }}" class="btn btn-primary">Back ZkTeco
                                Devices</a>
                        </div>

                        <form action="{{ route('zkteco_device.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Device Name *</label>
                                        <input class="form-control" type="text" name="name" id="name"
                                            value="{{ old('name') }}" placeholder="Enter Device Name">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ip_address" class="col-form-label">Device Ip Address *</label>
                                        <input class="form-control" type="text" name="ip_address" id="ip_address"
                                            value="{{ old('ip_address') }}" placeholder="Enter Device IP">
                                        @error('ip_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="port" class="col-form-label">Device Port *</label>
                                        <input class="form-control" type="number" name="port" id="port"
                                            value="{{ old('port') }}" placeholder="Enter Device Port Number">
                                        @error('port')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>





                            <button class="btn btn-primary" type="submit">Create ZkTeco Device</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
