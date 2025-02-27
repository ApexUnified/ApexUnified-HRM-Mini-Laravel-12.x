@extends('layouts.app')

@section('title', 'Allowance Types')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Allowance Type</h2>
                            <a href="{{ route('allowance-type.index') }}" class="btn btn-primary">Back To Allowance Types</a>
                        </div>

                        <form action="{{ route('allowance-type.update', $allowance_type->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="allowance_type" class="col-form-label">Allowance Type *</label>
                                        <input type="text" name="allowance_type" class="form-control" id="allowance_type"
                                            value="{{ $allowance_type->allowance_type }}">
                                        @error('allowance_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <button class="btn btn-primary" type="submit">Update Allowance Type</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
