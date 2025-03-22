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
                            <h2 class="display-5">Create Allowance</h2>
                            <a href="{{ route('allowance.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Allowances</a>
                        </div>

                        <form action="{{ route('allowance.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="allowance_type" class="col-form-label">Allowance Type *</label>

                                        <select name="allowance_type" id="allowance_type" class="form-control">
                                            <option value="" hidden>Select Allowance Type</option>

                                            @foreach ($allowance_types as $allowance_type)
                                                <option value="{{ $allowance_type->allowance_type }}"
                                                    {{ old('allowance_type') == $allowance_type->allowance_type ? 'selected' : '' }}>
                                                    {{ $allowance_type->allowance_type }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('allowance_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="frequency" class="col-form-label">Allowance Frequency *</label>
                                        <select name="frequency" class="form-control" id="frequency">
                                            <option value="" hidden>Select Allowance Frequency</option>

                                            <option value="Daily" {{ old('frequency') == 'Daily' ? 'selected' : '' }}>
                                                Daily</option>
                                            <option value="Monthly" {{ old('frequency') == 'Monthly' ? 'selected' : '' }}>
                                                Monthly</option>
                                            <option value="Quarterly"
                                                {{ old('frequency') == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                            <option value="Annually" {{ old('frequency') == 'Annually' ? 'selected' : '' }}>
                                                Annually</option>
                                        </select>
                                        @error('frequency')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eligibility_type" class="col-form-label">Allowance Eligibility
                                            Type</label>
                                        <select name="eligibility_type" class="form-control selectpicker"
                                            id="eligibility_type">
                                            <option value="" hidden>Select Eligibility Type</option>
                                            <option value="">All</option>
                                            <option value="department"
                                                {{ old('eligibility_type') == 'department' ? 'selected' : '' }}>Department
                                            </option>
                                            <option value="position"
                                                {{ old('eligibility_type') == 'position' ? 'selected' : '' }}>Position
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eligibility_value" class="col-form-label">Allowance Eligibility
                                            DD</label>
                                        <select disabled name="eligibility_value[]" class="form-control selectpicker"
                                            id="eligibility_value" multiple>
                                            @if (old('eligibility_value'))
                                                @foreach (old('eligibility_value') as $value)
                                                    <option value="{{ $value }}" selected>{{ $value }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('eligibility_value')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="allowance_amount" class="col-form-label">Allowance Amount *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" class="form-control" name="allowance_amount"
                                                id="allowance_amount" value="{{ old('allowance_amount') }}">
                                        </div>
                                        @error('allowance_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus-square fa-lg mx-1"></i>
                                Create Allowance</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')

        <script>
            $(document).ready(function() {

                $(document).on("change", "#eligibility_type", function() {
                    let eligibility_type = $(this).val();
                    let $eligibilityDropdown = $("#eligibility_value");

                    if (eligibility_type == "") {
                        $("#eligibility_value").prop("disabled", true);
                        $("select").selectpicker("refresh");
                        return;
                    }

                    $("#eligibility_value").prop("disabled", false);
                    $.ajax({
                        url: "/allowance/eligibilityData/" + eligibility_type,
                        method: "GET",
                        success: function(response) {
                            let data = response.data;

                            $eligibilityDropdown.html('');

                            $.each(data, function(index, item) {

                                $eligibilityDropdown.append(
                                    $("<option></option>").val(item.id)
                                    .text(
                                        `${item.id} - ${item.name}`)
                                );
                            });
                            $("select").selectpicker("refresh");
                            // $eligibilityDropdown.selectpicker("refresh");
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseJSON ? xhr.responseJSON.message :
                                "Error occurred");
                        }
                    });
                });
            });
        </script>

    @endsection
