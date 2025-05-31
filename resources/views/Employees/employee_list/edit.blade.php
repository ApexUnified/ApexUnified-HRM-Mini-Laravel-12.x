@extends('layouts.app')
@use("App\Models\Setting")

@section('title', 'Employee')

@section('content')


@php
     $setting = Setting::first();
    $documentPath = asset("assets/images/employee/documents/");
    $others = !empty($employee->others) ? json_decode($employee->others) : "";
    $profile = !empty($employee->profile) ? asset('assets/images/employee/profile/'. $employee->profile) : "";

    $joining_letter[] = !empty($employee->joining_letter) ? asset("assets/images/employee/joining_letter/" . $employee->joining_letter) : [];
    $resume[] = !empty($employee->resume) ? asset("assets/images/employee/resume/" . $employee->resume) : [];
    $cnics = [];
    if(!empty($employee->cnic)){
            foreach(json_decode($employee->cnic) as $cnic){
                $cnics[] = asset("assets/images/employee/cnic/". $cnic);
            }
    }  

    // dd($resume,$joining_letter);
@endphp


    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Edit Employee</h2>
                            <a href="{{ route('employee.index') }}" class="btn btn-primary">
                                <i class="fa-solid fa-backward fa-lg mx-1"></i>
                                Back To Employees</a>
                        </div>

                        <form action="{{ route('employee.update', $employee) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_name" class="col-form-label">Employee Name *</label>
                                        <input class="form-control" type="text" name="employee_name" id="employee_name"
                                            value="{{ $employee->employee_name }}">
                                        @error('employee_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent_name" class="col-form-label">Parent Name *</label>
                                        <input class="form-control" type="text" name="parent_name" id="parent_name"
                                            value="{{ $employee->parent_name }}">
                                        @error('parent_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_dob" class="col-form-label">Employee Date of Birth *</label>
                                        <input class="form-control flatpickr-datepicker" type="text" name="employee_dob" id="employee_dob"
                                            value="{{ $employee->employee_dob }}">
                                        @error('employee_dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hiring_date" class="col-form-label">Date Of Hiring *</label>
                                        <input class="form-control flatpickr-datepicker" type="text" name="date_of_hiring" id="hiring_date"
                                            value="{{ $employee->date_of_hiring }}">
                                        @error('date_of_hiring')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation" class="col-form-label">Designation *</label>
                                        <input class="form-control" type="text" name="designation" id="designation"
                                            value="{{ $employee->designation }}">
                                        @error('designation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department_id" class="col-form-label">Department *</label>
                                        <select class="form-control" type="text" name="department_id" id="department_id"
                                            style="cursor: pointer;">
                                            <option value="" hidden>Select Department </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                                                    {{ $department->department_name }} - {{ $department->branch->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="device_id" class="col-form-label">ZkTeco Devices *</label>
                                        <select class="form-control" type="text" name="device_id[]" id="device_id"
                                            style="cursor: pointer;" multiple>
                                            <option value="" hidden>Select Device </option>
                                            @php
                                                // Decode the JSON string into a PHP array
                                                $selected_device_ids = json_decode($employee->device_id, true);

                                                // Ensure $selected_device_ids is always an array
                                                if (!is_array($selected_device_ids)) {
                                                    $selected_device_ids = [];
                                                }
                                            @endphp

                                            @foreach ($devices as $device)
                                                <option value="{{ $device->id }}"
                                                    {{ in_array($device->id, $selected_device_ids) ? 'selected' : '' }}>
                                                    {{ $device->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('device_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="device_user_id" class="col-form-label">Device User Id *</label>
                                        <input class="form-control" type="number" name="device_user_id" id="device_user_id"
                                            value="{{ $employee->device_user_id }}">
                                        @error('device_user_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_schedule" class="col-form-label">Schedule *</label>
                                        <select multiple class="form-control" type="text" name="employee_schedule[]"
                                            id="employee_schedule" style="cursor: pointer;">
                                            <option value="" hidden>Select Schedule </option>
                                            @foreach ($schedules as $schedule)
                                                <option value="{{ $schedule->id }}"
                                                    {{ in_array($schedule->id, explode(',', $employee->employee_schedule)) ? 'selected' : '' }}>
                                                    {{ $schedule->name . ' ' }}
                                                    {{ $schedule->FormattedTimes['checkin'] . ' - ' . $schedule->FormattedTimes['checkout'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_schedule')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="col-form-label">Gender *</label>
                                        <select class="form-control" name="gender" id="gender"
                                            style="cursor: pointer;">
                                            <option value="" hidden>Select Gender</option>
                                            <option value="Male" @selected($employee->gender == "Male")>  Male</option>
                                            <option value="Female" @selected($employee->gender == "Female") >Female</option>
                                            <option value="Other" @selected($employee->gender == "Other") >Other</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                 </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_id" class="col-form-label">Position *</label>
                                        <select class="form-control" name="position_id" id="position_id"
                                            style="cursor: pointer;">

                                            <option value="" hidden>Select Position</option>

                                            @foreach($positions as $position)
                                                <option value="{{ $position->id }}" @selected($employee->position_id == $position->id)> {{ $position->position_name }}</option>
                                            @endforeach

                                        </select>
                                        @error('position_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="joining_date" class="col-form-label">Date Of Joining *</label>
                                        <input type="text" class="form-control flatpickr-datepicker" id="joining_date" name="joining_date" value="{{ $employee->joining_date }}">
                                        @error('joining_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="col-form-label">Religion *</label>
                                        <input type="text" class="form-control" id="religion" name="religion" value="{{ $employee->religion }}">
                                        @error('religion')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marital_status" class="col-form-label">Marital Status *</label>

                                        <select name="marital_status" id="marital_status" class="form-control">
                                            <option value="" hidden>Select Marital Status</option>
                                            <option value="Single" @selected($employee->marital_status == "Single")>Single</option>
                                            <option value="Married" @selected($employee->marital_status == "Married")>Married</option>
                                            <option value="Divorced" @selected($employee->marital_status == "Divorced")>Divorced</option>
                                            <option value="Widowed" @selected($employee->marital_status == "Widowed")>Widowed</option>
                                            <option value="Separated" @selected($employee->marital_status == "Separated")>Separated</option>
                                        </select>

                                        @error('marital_status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="home_address" class="col-form-label">Home Address *</label>
                                        <textarea name="home_address" id="home_address" cols="30" rows="1" class="form-control">{{ $employee->home_address }}</textarea>
                                        @error('home_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_number" class="col-form-label">Contact Number *</label>
                                        <input type="number" id="contact_number" name="contact_number" class="form-control" value="{{ $employee->contact_number }}">
                                        @error('contact_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email *</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ $employee->email }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cnic_number" class="col-form-label">Cnic Number *</label>
                                        <input type="text" id="cnic_number" name="cnic_number" class="form-control" value="{{ $employee->cnic_number }}">
                                        @error('cnic_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eobi_number" class="col-form-label">Eobi Number </label>
                                        <input type="number" id="eobi_number" name="eobi_number" class="form-control"  value="{{ $employee->eobi_number }}">
                                        @error('eobi_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sessi_number" class="col-form-label">Sessi Number </label>
                                        <input type="number" id="sessi_number" name="sessi_number" class="form-control"  value="{{ $employee->sessi_number }}">
                                        @error('sessi_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group" class="col-form-label">Blood Group </label>
                                        <select name="blood_group" id="blood_group" class="form-control">
                                            <option value="" hidden>Select Blood Group</option>
                                            <option value="A+" @selected($employee->blood_group == "A+")>A+</option>
                                            <option value="A-" @selected($employee->blood_group == "A-")>A-</option>
                                            <option value="B+" @selected($employee->blood_group == "B+")>B+</option>
                                            <option value="B-" @selected($employee->blood_group == "B-")>B-</option>
                                            <option value="O+" @selected($employee->blood_group == "O+")>O+</option>
                                            <option value="O-" @selected($employee->blood_group == "O-")>O-</option>
                                            <option value="AB+" @selected($employee->blood_group == "AB+")>AB+</option>
                                            <option value="AB-" @selected($employee->blood_group == "AB-")>AB-</option>
                                        </select>
                                        @error('blood_group')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="qualification" class="col-form-label">Qualification *</label>
                                        <input name="qualification" id="qualification" value="{{$employee->qualification}}" class="form-control"/>
                                        @error('qualification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_contact_details" class="col-form-label">Emergency Contact Details *</label>
                                        <textarea name="emergency_contact_details" id="emergency_contact_details" cols="30" rows="1" class="form-control">{{ $employee->emergency_contact_details }}</textarea>
                                        @error('emergency_contact_details')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_contact_number" class="col-form-label">Emergency Contact Number * </label>
                                        <input type="number" id="emergency_contact_number" name="emergency_contact_number" class="form-control" value="{{ $employee->emergency_contact_number}}">
                                        @error('emergency_contact_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="salary" class="col-form-label">Salary *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $setting->currency }}</span>
                                            <input type="number" step="0.01" class="form-control" name="salary"
                                                id="salary" value="{{ $employee->salary }}">
                                        </div>
                                        @error('salary')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="remarks" class="col-form-label">Remarks </label>
                                        <input type="text" id="remarks" name="remarks" class="form-control" value="{{$employee->remarks }}">
                                        @error('remarks')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>







                               {{-- Family Member Details Rows --}}
                        <div class="row my-3">
                            <div class="col-md-12 text-center">
                                <h4>Family Member Details</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name" class="col-form-label">Full Name </label>
                                    <input type="text" id="full_name" name="family_member_details[full_name]"
                                     class="form-control" value="{{!empty($employee->family_member_details) ? $employee->family_member_details["full_name"] : "" }}">
                                    @error("family_member_details[full_name]")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="relation" class="col-form-label">Relation </label>
                                    <input type="text" id="relation" name="family_member_details[relation]"
                                     class="form-control" value="{{!empty($employee->family_member_details) ? $employee->family_member_details["relation"] : ""}}">
                                    @error("family_member_details[relation]")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="age" class="col-form-label">Age </label>
                                    <input type="number" id="age" name="family_member_details[age]"
                                     class="form-control" value="{{!empty($employee->family_member_details) ? $employee->family_member_details["age"] : "" }}">
                                    @error("family_member_details[age]")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="family_member_contact_num" class="col-form-label">Contact Number </label>
                                    <input type="number" id="family_member_contact_num" name="family_member_details[contact_number]"
                                     class="form-control" value="{{ !empty($employee->family_member_details) ? $employee->family_member_details["contact_number"] : "" }}">
                                    @error("family_member_details[contact_number]")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="family_member_email" class="col-form-label">Email </label>
                                    <input type="email" id="family_member_email" name="family_member_details[email]"
                                     class="form-control" value="{{ !empty($employee->family_member_details) ? $employee->family_member_details["email"] : "" }}">
                                    @error("family_member_details[email]")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="family_member_address" class="col-form-label">Address </label>
                                    <input type="text" id="family_member_address" name="family_member_details[address]"
                                     class="form-control" value="{{ !empty($employee->family_member_details) ? $employee->family_member_details["address"] : ""}}">
                                    @error("family_member_details[address]")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Family Member Details Rows End --}}



                        <div class="row">
                            <div class="col-md-12 my-5 text-center">
                                <h4> Upload Documents / Profile </h4>
                                <hr>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="joining_letter" class="col-form-label">Joining Letter</label>
                                    <input type="file" id="joining_letter" name="joining_letter" class="form-control">
                                    @error("joining_letter")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="resume" class="col-form-label">Resume</label>
                                    <input type="file" id="resume" name="resume" class="form-control">
                                    @error("resume")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cnic" class="col-form-label">Cnic</label>
                                    <input type="file" id="cnic" name="cnic[]" class="form-control">
                                    @error("cnic.*")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="others" class="col-form-label">Other Documents</label>
                                    <input type="file" id="others" name="others[]" class="form-control">
                                    @error("others.*")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="row">
                         
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="profile" class="col-form-label">Profile</label>
                                    <input type="file" id="profile" name="profile" class="form-control">
                                    @error("profile")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                Update Employee</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section("js")
        <script>
            $(document).ready(function(){

                const Profile = @json($profile);
                const documentPath = @json($documentPath);
                let others = @json($others);
                let joining_letter = @json($joining_letter);
                let resume = @json($resume);
                let cnics = @json($cnics);



                // console.log("Resume:", joining_letter.flat());
                // console.log("Is Array:", Array.isArray(joining_letter));
                // console.log("Length:", joining_letter.length);
                // console.log("First Element:", joining_letter[0]);
                // console.log("Type of First Element:", typeof joining_letter[0]);

                // console.log(joining_letter);


                const otherdocumentsInput = document.querySelector('[name="others[]"]');
                const otherdocumentsPond =  FilePond.create(otherdocumentsInput,{
                    credits: null,
                    allowMultiple: true,
                    acceptedFileTypes: [
                        'image/jpeg',
                        'image/png',
                        'image/jpg',
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        ],
                    maxFileSize: 5242880,
                    storeAsFile: true,
                });


                if (Array.isArray(others) && others.length > 0) {
                    otherdocumentsPond.files = others.map(doc => {
                        return {
                            source: String(documentPath)+ "/" + String(doc),
                            options: {
                                type: 'remote'
                            }
                        };
                    });
                }



               
                const joining_letterInput = document.querySelector('[name="joining_letter"]');
                const joining_letterPond =  FilePond.create(joining_letterInput,{
                    credits: null,
                    allowMultiple: false,
                    acceptedFileTypes: [
                        'application/pdf',
                        ],
                    maxFileSize: 5242880,
                    storeAsFile: true,
                });


                if (Array.isArray(joining_letter) && joining_letter.flat().length > 0) {
                    joining_letterPond.files = joining_letter.map(letter => {
                        return {
                            source: String(letter),
                            options: {
                                type: 'remote'
                            }
                        };
                    });
                }




                const resumeInput = document.querySelector('[name="resume"]');
                const resumePond =  FilePond.create(resumeInput,{
                    credits: null,
                    allowMultiple: false,
                    acceptedFileTypes: [
                        'application/pdf',
                        ],
                    maxFileSize: 5242880,
                    storeAsFile: true,
                });



                if (Array.isArray(resume) &&  resume.flat().length > 0 ) {
                    resumePond.files = resume.map(res => {
                        return {
                            source: String(res),
                            options: {
                                type: 'remote'
                            }
                        };
                    });
                }


                const cnicInput = document.querySelector('[name="cnic[]"]');
                const cnicPond =  FilePond.create(cnicInput,{
                    credits: null,
                    allowMultiple: true,
                    acceptedFileTypes: [
                        'application/pdf',
                        ],
                    maxFileSize: 5242880,
                    maxFiles: 2,
                    storeAsFile: true,
                });


                if (Array.isArray(cnics) && cnics.length > 0) {
                    cnicPond.files = cnics.map(cnic => {
                        return {
                            source: String(cnic),
                            options: {
                                type: 'remote'
                            }
                        };
                    });
                }







                const profileInput = document.querySelector('[name="profile"]');
                const profilePond = FilePond.create(profileInput,{
                    credits: null,
                    allowMultiple: false,
                    acceptedFileTypes: [
                        'image/jpeg',
                        'image/png',
                        'image/jpg',
                        ],
                    maxFileSize: 5242880,
                    storeAsFile: true,
                });


                if(Profile.length > 0){
                    profilePond.files = [{
                        source: String(Profile),
                        options: {
                            type: 'remote'
                        }
                    }];
                }

            });
        </script>


    @endsection
