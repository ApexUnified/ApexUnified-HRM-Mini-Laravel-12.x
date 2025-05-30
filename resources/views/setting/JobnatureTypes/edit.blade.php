@extends('layouts.app')

@section('title', 'Job Nature Types')

@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Job Nature Type</h2>
                            <a href="{{ route('jobnature-type.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i> 
                                Back To Job Nature Types</a>
                        </div>

                        <form action="{{ route('jobnature-type.update', $jobnature_type->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jobnature_type" class="col-form-label">Job Nature Type *</label>
                                        <input type="text" name="jobnature_type" class="form-control" id="jobnature_type"
                                            value="{{ $jobnature_type->jobnature_type }}">
                                        @error('jobnature_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i> 
                                Update Job Nature Type</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection
