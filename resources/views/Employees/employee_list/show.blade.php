@extends("layouts.app")

@use("App\Models\ZktecoDevice")
@use("App\Models\Schedule")
@use("App\Models\Setting")

@section("title","Employees")


@section("css")

<style>
    .employee-container {
        max-width: 1400px;
        margin: 40px auto;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .profile-header {
        background: linear-gradient(45deg, #324aa2, #435ebe);
        color: white;
        padding: 30px;
        border-radius: 15px 15px 0 0;
    }

    .avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
    }

    .section-title {
        color: #2c3e50;
        border-bottom: 3px solid #324aa2;
        padding-bottom: 10px;
        margin-bottom: 25px;
        font-weight: 600;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .family-member-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .family-member-card:hover {
        background: #e9ecef;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .document-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background: #fff;
        border-radius: 10px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .document-item:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .document-item i {
        margin-right: 15px;
        color: #324aa2;
        font-size: 1.2rem;
    }

    .badge-custom {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 6px 12px;
    }

    @media print{
        #print-btn{
            display:none;
        }


        #edit-btn{
            display:none;
        }
    }
</style>

@endsection


@section("content")


@php
        $setting = Setting::first();
@endphp

<div class="employee-container">

    <div id="printable_sections">
        <div class="card">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <img src="{{ !empty($employee->profile) ?
                            asset("assets/images/employee/profile/" . $employee->profile)
                            :
                            asset("assets/images/default-img.webp")}}"
                         alt="Employee" class="avatar">
                    </div>
                    <div class="col-md-9">
                        <h1 class="mb-2">{{ $employee->employee_name }}  <a href="{{ route("employee.edit",$employee->id) }}" class="text-light" id="edit-btn"><i class="fa fa-edit mb-3" style="font-size:1.5rem"></i></a> </h1>
                        <h4 class="mb-3">{{ $employee->position->position_level ?? "-" }} - {{ $employee->position->position_name ?? "-" }}</h4>
                        <div class="d-flex">
                            <span class="badge badge-custom">ID: {{ $employee->employee_id }}</span>
                            <span class="badge badge-custom mx-2">Branch: {{ $employee->department->branch->name }}</span>
                            <span class="badge badge-custom mx-2">Dept: {{ $employee->department->department_name }}</span>
                        </div>
                    </div>
                    
                </div>
            </div>
    
    
           
            <div class="card-body">
            <div class="d-flex justify-content-between"> 
                <h3 class="section-title">Full Information</h3>
                <button type="button" id="print-btn" style="height:2.4rem;" class="btn btn-sm btn-primary"><i class="fa fa-print mx-1"></i>Print</button>    
            </div>
    
                <div class="info-grid">
                    <div>
                        <strong>Email:</strong> {{ $employee->email ?? "No Email Given" }}
                    </div>
                    <div>
                        <strong>Phone:</strong> {{ $employee->contact_number ?? "No Contact Number Given" }}
                    </div>
                    <div>
                        <strong>Address:</strong> {{ $employee->home_address ?? "No Address Given" }}
                    </div>
                    <div>
                        <strong>Join Date:</strong> {{ $employee->joining_date?->format("Y-m-d") ?? "No Date Given" }}
                    </div>
    
                </div>
    
    
                <div class="info-grid mt-4">
                    <div>
                        <strong>Parent Name:</strong> {{ $employee->parent_name ?? "No Parent Name Given" }}
                    </div>
                    <div>
                        <strong>Date Of Birth:</strong> {{ $employee->employee_dob ?? "No DOB Given" }}
                    </div>
                    <div>
                        <strong>Date Of Hiring:</strong> {{ $employee->date_of_hiring ?? "No Date Of Hiring Given" }}
                    </div>
                    <div>
                        <strong>Designation:</strong> {{ $employee->designation ?? "No Description Given" }}
                    </div>
    
                </div>
    
    
                <div class="info-grid mt-4">
                    <div>
                        <strong>Gender:</strong> {{ $employee->gender ?? "No gender Given" }}
                    </div>
                    <div>
                        <strong>Religion:</strong> {{ $employee->religion ?? "No religion Given" }}
                    </div>
                    <div>
                        <strong>Marital Status:</strong> {{ $employee->marital_status ?? "No marital status Given" }}
                    </div>
                    <div>
                        <strong>Blood Group:</strong> {{ $employee->blood_group ?? "No blood_group Given" }}
                    </div>
    
                </div>
    
    
                <div class="info-grid mt-4">
                    <div>
                        <strong>CNIC:</strong> {{ $employee->cnic_number ?? "No Number Given" }}
                    </div>
                    <div>
                        <strong>EOBI:</strong> {{ $employee->eobi_number  ?? "No Number Given"}}
                    </div>
                    <div>
                        <strong>SESSI:</strong> {{ $employee->sessi_number ??  "No Number Given"}}
                    </div>
                    <div>
                        <strong>Qualification:</strong> {{ $employee->qualification ?? "No Qualification Given" }}
                    </div>
    
                </div>
    
                @php
                    $devices = ZktecoDevice::whereIn("id",json_decode($employee->device_id))->get();
    
                    $schedule_ids = explode(",",$employee->employee_schedule);
                    $scheudles = Schedule::whereIn("id",$schedule_ids)->get();
                @endphp
    
    
                <div class="info-grid mt-4">
                    <div>
                        <strong>Assigned Devices:</strong> @foreach($devices as $device) <br> {{!empty($device) ? $device->name . " | " : "" }}  @endforeach
                    </div>
                    <div>
                        <strong>Device User ID:</strong> {{ $employee->device_user_id  }}
                    </div>
                    <div>
                       @if($scheudles->isNotEmpty())
                       <strong>Assigned Schedules:</strong> @foreach($scheudles as $schedule) <br> {{ $schedule->name . ": " }}
                       {{ $schedule->formatted_times["checkin"] }} - {{ $schedule->formatted_times["checkout"] }} @endforeach
                       @else
                       <strong>Assigned Schedules:</strong> No Schedule Assigned
                       @endif
                    </div>
                    <div>
                        <strong>Salary :</strong> {{ $setting->currency }}  {{ $employee->salary }}
                    </div>
    
                </div>
    
    
                <div class="info-grid mt-4">
                    <div>
                        <strong>Emergency Contact Details:</strong> {{ $employee->emergency_contact_details ?? "No Details Given" }}
                    </div>
                    <div>
                        <strong>Emergency Contact Number:</strong> {{ $employee->emergency_contact_number ?? "No Details Given" }}
                    </div>
                    <div>
                        <strong>Remarks:</strong> {{ $employee->remarks ?? "No Remarks Given" }}
                    </div>
                    <div>
                        <strong>Created By :</strong> {{ $employee->created_by }}
                    </div>
    
                </div>
            </div>
        </div>





        <div class="card">
            <div class="card-body">
                <h3 class="section-title">Family Member Details</h3>
                <div class="row">
                    @if(!empty($employee->family_member_details))
                    <div class="col-md-12 mb-3">
                        <div class="family-member-card">

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>{{ $employee->family_member_details["full_name"] }}</h5>
                                    <p class="mb-1"><strong>Relation:</strong> {{ $employee->family_member_details["relation"] ?? "No Relation Given" }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ $employee->family_member_details["email"] ?? "No Email Given" }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="mb-0"><strong>Contact:</strong> {{ $employee->family_member_details["contact_number"] ?? "No Contact Number Given" }}</p>
                                    <p class="mb-0"><strong>Age:</strong> {{ $employee->family_member_details["age"] ?? "No Age Given" }}</p>
                                    <p class="mb-0"><strong>Address:</strong> {{ $employee->family_member_details["address"] ?? "No Address Given" }}</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    @else

                    <div class="col-md-12 mb-3">
                        <div class="text-center">
                            <h5>No Family Member Details Found</h5>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>


    </div>

 

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="section-title">Resume</h3>
                    <div class="document-list">
        
                        <div class="document-item">
                            <div>
                                <i class="fa fa-file"></i>
                                @if(!empty($employee->resume))
                                <a href="{{ asset("assets/images/employee/resume/" . $employee->resume) }}" download="{{ $employee->employee_name . "_Resume" }}" target="_blank">{{ $employee->resume }}</a>
                                @else
                                <p> No Resume Given </p>
                                @endif
                                <small class="d-block text-muted"></small>
                            </div>

                            @if (!empty($employee->resume))
                            <a href="{{ asset("assets/images/employee/resume/" . $employee->resume) }}"  target="_blank"><i class="fa fa-eye"></i></a>
                          @endif
                        </div>
        
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="section-title">Joining Letter </h3>
                    <div class="document-list">
        
                        <div class="document-item">
                            <div>
                                <i class="fa fa-file"></i>
                                @if(!empty($employee->joining_letter))
                                <a href="{{ asset("assets/images/employee/joining_letter/" . $employee->joining_letter) }}" download="{{ $employee->employee_name . "_Joining_Letter" }}" target="_blank">{{ $employee->joining_letter }}</a>
                                @else
                                <p> No Joining Letter Given </p>
                                @endif
                                <small class="d-block text-muted"></small>
                            </div>

                          @if (!empty($employee->joining_letter))
                            <a href="{{ asset("assets/images/employee/joining_letter/" . $employee->joining_letter) }}" target="_blank"><i class="fa fa-eye"></i></a>
                          @endif
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="section-title">Cnic</h3>
                    <div class="document-list">
                    
                        @if(!empty($employee->cnic))
                            @foreach(json_decode($employee->cnic) as $cnic)
                                    <div class="document-item">
                                        <div>
                                            <i class="fa fa-file"></i>
                                            <a href="{{ asset("assets/images/employee/cnic/" . $cnic) }}" download="{{ $employee->employee_name . "_Cnic" }}" target="_blank">{{ $cnic }}</a>
                                            <small class="d-block text-muted"></small>
                                        </div>

                                        <a href="{{ asset("assets/images/employee/cnic/" . $cnic) }}"  target="_blank"><i class="fa fa-eye"></i></a>
                                    </div>
                            @endforeach

                       @else
                                <div class="document-item">
                                    <div>
                                        <i class="fa fa-file"></i>
                                        <p> No CNIC Given </p>
                                        <small class="d-block text-muted"></small>
                                    </div>
                                </div>  
                       @endif
        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="section-title">Others</h3>
                    <div class="document-list">
                        @if(!empty($employee->others))
                        
                            @foreach(json_decode($employee->others) as $other)
                                    <div class="document-item">
                                        <div>
                                            <i class="fa fa-file"></i>
                                            <a href="{{ asset("assets/images/employee/documents/" . $other) }}" download="{{ $employee->employee_name . "_OtherDocs" }}" target="_blank">{{ $other }}</a>
                                            <small class="d-block text-muted"></small>
                                        </div>

                                        <a href="{{ asset("assets/images/employee/documents/" . $other) }}"  target="_blank"><i class="fa fa-eye"></i></a>
                                       
                                    </div>
                            @endforeach

                         @else
                                <div class="document-item">
                                     <div>
                                        <i class="fa fa-file"></i>
                                        <p> No Other Docs Given </p>
                                        <small class="d-block text-muted"></small>
                                    </div>
                                </div>  

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection


@section("js")

<script>
    

    $(document).ready(function () {
    $(document).on("click","#print-btn", function () {
        var content = $("#printable_sections").clone(); 
        
        var originalContent = document.body.innerHTML;
        var originalTitle = document.title; 

        document.body.innerHTML = content.html();
        document.title = "Employee Details";
        window.print();

        document.body.innerHTML = originalContent;
        document.title = originalTitle;

        location.reload();
      
    });
});



</script>


@endsection
