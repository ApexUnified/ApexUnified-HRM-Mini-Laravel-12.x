@extends('layouts.app')

@use("App\Models\Setting")
@use("Carbon\Carbon")

@section('title', 'Payslip Invoice')



@section("css")
    <style>
        body {
            background-color: #f8f9fa;
        }
        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .invoice-header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }
        .table th, .table td {
            vertical-align: middle;
        }

    </style>
    <script src="{{ asset("assets/js/spdf.js") }}"></script>
    <script src="{{ asset("assets/js/htmlcanvas.js") }}"></script>
    
@endsection


@section('content')

@php
$setting = Setting::first();
@endphp



<div class="main-content-inner">
    <div class="row">
        <div class="mt-5 col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="mb-5 d-flex justify-content-between align-items-center">
                        <h2 class="display-5">Generate Payroll Invoice</h2>
                        
                        <a href="{{ route('payslip.index') }}" class="btn btn-primary">
                            <i class="fa-solid fa-backward fa-lg mx-1"></i> 
                            Back To Payslips</a>
                      
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-sm btn-primary" id="download-pdf">
                            <i class="fa-solid fa-file-lines fa-xl mx-1"></i>
                            Download PDF
                        </button>

                        <button class="btn btn-sm btn-primary mx-3" id="send-mail">
                            <i class="fa fa-envelope fa-xl mx-1"></i>
                            Send Mail
                        </button>
                    </div>
                    <div class="invoice-container">
                        <div class="invoice-header">
                            <h2>Payroll Invoice</h2>
                            <p>{{ $setting->company_name }}</p>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Employee Details</h5>
                                <p><strong>Name:</strong> {{$payslip->employee->employee_name}}</p>
                                <p><strong>Employee ID:</strong> {{ $payslip->employee->employee_id }} </p>
                                <p><strong>Designation:</strong> {{ $payslip->employee->designation }}</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5>Invoice Details</h5>
                                <p><strong>Date:</strong> <span>{{$payslip->created_at->format("Y-m-d")}}</span></p>
                            </div>
                        </div>
                        
                        <table class="table table-bordered mt-4">
                            <thead class="table-primary">
                                <tr>
                                    <th>Description</th>
                                    <th>Amount ({{ $setting->currency }})</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Base Salary</td>
                                    <td>{{ $setting->currency }} {{$payslip->base_salary}}</td>
                                </tr>
                                <tr>
                                    <td>Overtime Pay</td>
                                    <td>{{ $setting->currency }} {{$payslip->overtime}}</td>
                                </tr>
                                <tr>
                                    <td>Allowances</td>
                                    <td>{{ $setting->currency }} {{$payslip->allowance}}</td>
                                </tr>

                                <tr>
                                    <td>Bonus</td>
                                    <td>{{ $setting->currency }} {{$payslip->bonus}}</td>
                                </tr>

                                <tr>
                                    <td>Deductions</td>
                                    <td>{{ $setting->currency }} -{{ $payslip->deduction }}</td>
                                </tr>

                                <tr>
                                    <td>Tax Deductions</td>
                                    <td>{{ $setting->currency }} -{{ $payslip->tax_deduction }}</td>
                                </tr>

                                <tr>
                                    <td>Loan Deductions</td>
                                    <td>{{ $setting->currency }} -{{ $payslip->loan_deduction }}</td>
                                </tr>

                                <tr>
                                    <td>Late & Absent Deduction</td>
                                    <td>{{ $setting->currency }} -{{ $payslip->attendance_deduction }}</td>
                                </tr>

                                <tr class="table-success">
                                    <td><strong>Net Salary</strong></td>
                                    <td><strong>{{ $setting->currency }} {{ $payslip->net_salary }} </strong></td>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection


@section("js")

    <script>
            $(document).ready(function(){
                var employee_name = @json($payslip->employee->employee_name);
                var employee_email = @json($payslip->employee->email);

                $(document).on("click","#download-pdf",function(){
                    const { jsPDF } = window.jspdf;
                    var invoice = document.querySelector(".invoice-container");
                    html2canvas(invoice, { scale: 2 }).then(canvas => {
                        var imgData = canvas.toDataURL("image/png");
                        var pdf = new jsPDF("p", "mm", "a4");

                        var imgWidth = 210; 
                        var pageHeight = 100;
                        var imgHeight = (canvas.height * imgWidth) / canvas.width;


                        pdf.addImage(imgData, "PNG", 0, 10, imgWidth, imgHeight);

                        pdf.save(`${employee_name } Payroll_Invoice.pdf`);
                    });
                });



                $(document).on("click","#send-mail",function() {
                    console.log("Mail Sending");


                    const { jsPDF } = window.jspdf;
                    var invoice = document.querySelector(".invoice-container");

                    html2canvas(invoice, { scale: 1 }).then(canvas => { // Reduce scale to reduce size
                        var imgData = canvas.toDataURL("image/jpeg", 1); // Convert to JPEG with 70% quality
                        var pdf = new jsPDF("p", "mm", "a4");

                        var imgWidth = 210;
                        var imgHeight = (canvas.height * imgWidth) / canvas.width;

                        pdf.addImage(imgData, "JPEG", 0, 10, imgWidth, imgHeight);
                        
                        // Compress PDF before sending
                        var pdfBlob = pdf.output("blob");

                        var formData = new FormData();
                        formData.append("pdf", pdfBlob, "invoice.pdf");
                        formData.append("email", employee_email);



                    $.ajax({
                        url: "/send-payslip-via-mail",
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            if(response.status)
                            {
                                Swal.fire({
                                    title: 'Action Completed',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                    icon: 'error',
                                    confirmButtonText: 'Okay',
                                    confirmButtonColor: "#435ebe",
                                });
                        }
                    });
                });


            });

        });
    </script>

@endsection