<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h2 class="display-5">Edit Payslip</h2>
                        <a href="{{ route('payslip.index') }}" class="btn btn-primary">Back To Payslips</a>
                    </div>



                    <div class="card mt-3">
                        <div class="card-body">
                            <form wire:submit.prevent='updatePayslip' class="w-75 m-auto">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Payslip Status *</label>
                                            <select wire:model="status" class="form-control">
                                                <option value="" hidden>Select Status</option>
                                                <option value="Pending" {{ $payslip->status == "Pending" ? "selected" : "" }} >Pending</option>
                                                <option value="Approved" {{ $payslip->status == "Approved" ? "selected" : "" }} >Approved</option>
                                                <option value="Paid" {{ $payslip->status == "Paid" ? "selected" : "" }} >Paid</option>
                                            </select>
                                            @error("status")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-md-4 mt-3">
                                        <button class="btn btn-primary">Update Payslip</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   

                  <div class="card mt-4">
                    <div class="card-body">
                        
                        <h4 class="mb-3">Payslip Summary</h4>
                        <table class="table table-bordered">
                            <tr class="bg-secondary text-light ">
                                <td><strong>Basic Salary:</strong></td>
                                <td> {{ $setting->currency }} {{ number_format($payslip->base_salary, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Allowances:</strong></td>
                                <td>{{ $setting->currency }} {{ number_format($allowance_amount, 2) }}</td>
                            </tr>
                            <tr>
                             
                                <td><strong>Bonus:</strong></td>
                                <td>{{ $setting->currency }} {{ number_format($bonus_amount, 2) }}</td>
                                
                            </tr>
                            <tr>
                                <td><strong>Overtime Pay:</strong></td>
                                <td> {{ $setting->currency }} {{ number_format($overtime_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Late & Absent Deduction:</strong></td>
                                <td>{{ $setting->currency }} - {{ number_format($late_absent_deduction_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Loan Deduction:</strong></td>
                                <td>{{ $setting->currency }} - {{ number_format($loan_deduction_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Other Deductions:</strong></td>
                                <td> {{ $setting->currency }} - {{ number_format($deduction_amount, 2) }}</td>
                            </tr>

                            <tr>
                                <td><strong>Tax Deductions:</strong></td>
                                <td> {{ $setting->currency }} - {{ number_format($tax_deduction_amount, 2) }}</td>
                            </tr>
                            <tr class="bg-secondary text-light">
                                <td><strong>Final Salary:</strong></td>
                                <td><strong>{{ $setting->currency }} {{ number_format($net_salary, 2) }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>