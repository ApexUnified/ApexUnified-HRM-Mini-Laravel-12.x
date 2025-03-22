@extends('layouts.app')

@section('title', 'Allowances')

@section('content')


    @php
        $setting = \App\Models\Setting::first();
        $eligibilityArray = json_decode($allowance->eligibility, true);

        $eligibility_key = null;
        $eligibility_value = null;

        if (!empty($eligibilityArray)) {
            $eligibility_key = array_key_first($eligibilityArray);
            $eligibility_value = $eligibilityArray[$eligibility_key];
        }

    @endphp

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Allowance</h2>
                            <a href="{{ route('allowance.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Allowances</a>
                        </div>

                        <form action="{{ route('allowance.update', $allowance->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="allowance_type" class="col-form-label">Allowance Type *</label>
                                        <select name="allowance_type" id="allowance_type" class="form-control">
                                            <option value="" hidden>Select Allowance Type</option>

                                            @foreach ($allowance_types as $allowance_type)
                                                <option value="{{ $allowance_type->allowance_type }}"
                                                    {{ $allowance->allowance_type == $allowance_type->allowance_type ? 'selected' : '' }}>
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

                                            <option value="Daily" {{ $allowance->frequency == 'Daily' ? 'selected' : '' }}>
                                                Daily
                                            </option>

                                            <option value="Monthly"
                                                {{ $allowance->frequency == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                            <option value="Quarterly"
                                                {{ $allowance->frequency == 'Quarterly' ? 'selected' : '' }}>Quarterly
                                            </option>
                                            <option value="Annually"
                                                {{ $allowance->frequency == 'Annually' ? 'selected' : '' }}>Annually
                                            </option>
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
                                        <label for="eligibility_type" class="col-form-label">Allowance Eligibility</label>
                                        <select name="eligibility_type" class="form-control" id="eligibility_type">
                                            <option value="" hidden>Select Allowance Frequency</option>
                                            <option value="" {{ empty($eligibility_key) ? 'selected' : '' }}>All
                                            </option>
                                            <option
                                                value="department"{{ $eligibility_key == 'department' ? 'selected' : '' }}>
                                                Department</option>
                                            <option value="position"{{ $eligibility_key == 'position' ? 'selected' : '' }}>
                                                Position</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eligibility_value" class="col-form-label">Allowance Eligibility
                                            DD</label>
                                        <select disabled name="eligibility_value[]" class="form-control"
                                            id="eligibility_value" multiple>
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
                                                id="allowance_amount" value="{{ $allowance->allowance_amount }}">
                                        </div>
                                        @error('allowance_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                Update Allowance</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')

        <script>
            $(document).ready(function() {

                let eligibility_type = $("#eligibility_type").val();
                let $eligibilityArray = @json($eligibilityArray);

                let $eligibility_key = @json($eligibility_key);
                let $eligibility_values = @json($eligibility_value);




                if (eligibility_type != "" && eligibility_type != null) {
                    let $eligibilityDropdown = $("#eligibility_value");
                    $eligibilityDropdown.html("");

                    $("#eligibility_value").prop("disabled", false);
                    $("select").selectpicker("refresh");
                    $.ajax({
                        url: "/allowance/eligibilityData/" + eligibility_type,
                        method: "GET",
                        success: function(response) {
                            let data = response.data;

                            $.each(data, function(index, item) {

                                let option = $("<option></option>").val(item.id).text(
                                    `${item.id} - ${item.name}`);

                                if ($eligibility_key == eligibility_type && $eligibility_values
                                    .includes(item.id.toString())) {
                                    option.prop("selected", true);
                                }

                                $eligibilityDropdown.append(option);

                            });
                            $eligibilityDropdown.selectpicker("refresh");
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseJSON ? xhr.responseJSON.message :
                                "Error occurred");
                        }
                    });
                }


                $("#eligibility_type").on("change", function() {
                    let eligibility_type = $(this).val();
                    let $eligibilityDropdown = $("#eligibility_value");


                    if (eligibility_type == "") {
                        $("#eligibility_value").prop("disabled", true);
                        $("select").selectpicker("refresh");
                        return;
                    }

                    $eligibilityDropdown.html("");
                    $("#eligibility_value").prop("disabled", false);
                    $.ajax({
                        url: "/allowance/eligibilityData/" + eligibility_type,
                        method: "GET",
                        success: function(response) {
                            let data = response.data;

                            $.each(data, function(index, item) {
                                $eligibilityDropdown.append(
                                    $("<option></option>").val(item.id).text(
                                        `${item.id} - ${item.name}`)
                                );
                            });
                            $eligibilityDropdown.selectpicker("refresh");
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
