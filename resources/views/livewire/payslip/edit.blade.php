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
                            <form wire:submit.prevent='updatePayslip'>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="allowance_amount" class="col-form-label">Allowance Amount *</label>

                                            <div class="input-group">
                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                <input type="number" step="0.01" class="form-control" id="allowance_amount" wire:model='allowance_amount'>
                                            </div>
                                            @error("allowance_amount")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bonus_amount" class="col-form-label">Bonus Amount *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                <input type="number" step="0.01" class="form-control" id="bonus_amount" wire:model='bonus_amount'>
                                            </div>
                                            @error("bonus_amount")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="overtime_amount" class="col-form-label">Overtime Amount *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                <input type="number" step="0.01" class="form-control" id="overtime_amount" wire:model='overtime_amount' >
                                            </div>
                                            @error("overtime_amount")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="loan_deduction_amount" class="col-form-label">Loan Deduction Amount *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                <input type="number" step="0.01" class="form-control" id="loan_deduction_amount" wire:model='loan_deduction_amount' >
                                            </div>
                                            @error("loan_deduction_amount")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="late_absent_deduction_amount" class="col-form-label">Late & Absent Deduction Amount *</label>

                                            <div class="input-group">
                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                <input type="number" step="0.01" class="form-control" id="late_absent_deduction_amount" wire:model='late_absent_deduction_amount' >
                                            </div>
                                            @error("late_absent_deduction_amount")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="deduction_amount" class="col-form-label"> Deduction Amount *</label>

                                            <div class="input-group">
                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                <input type="number" step="0.01" class="form-control" id="deduction_amount" wire:model='deduction_amount' >
                                            </div>
                                            @error("deduction_amount")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>




                                <div class="row align-items-center">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax_deduction_amount" class="col-form-label"> Tax Deduction Amount *</label>

                                            <div class="input-group">
                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                <input type="number" step="0.01" class="form-control" id="tax_deduction_amount" wire:model='tax_deduction_amount' >
                                            </div>
                                            @error("tax_deduction_amount")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Payslip Status *</label>

                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-chart-simple"></i></span>
                                                <select wire:model="status" class="form-control">
                                                    <option value="" hidden>Select Status</option>
                                                    <option value="Pending" {{ $payslip->status == "Pending" ? "selected" : "" }} >Pending</option>
                                                    <option value="Approved" {{ $payslip->status == "Approved" ? "selected" : "" }} >Approved</option>
                                                    <option value="Paid" {{ $payslip->status == "Paid" ? "selected" : "" }} >Paid</option>
                                                </select>
                                            </div>
                                            @error("status")
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
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
                                <td> {{ $setting->currency }} {{ $payslip->base_salary }}</td>
                            </tr>
                            <tr>
                                <td><strong>Allowances:</strong></td>
                                <td>{{ $setting->currency }} {{ $payslip->allowance}}</td>
                            </tr>
                            <tr>
                             
                                <td><strong>Bonus:</strong></td>
                                <td>{{ $setting->currency }} {{ $payslip->bonus }}</td>
                                
                            </tr>
                            <tr>
                                <td><strong>Overtime Pay:</strong></td>
                                <td> {{ $setting->currency }} {{ $payslip->overtime }}</td>
                            </tr>
                            <tr>
                                <td><strong>Late & Absent Deduction:</strong></td>
                                <td>{{ $setting->currency }} - {{ $payslip->attendance_deduction}}</td>
                            </tr>
                            <tr>
                                <td><strong>Loan Deduction:</strong></td>
                                <td>{{ $setting->currency }} - {{ $payslip->loan_deduction }}</td>
                            </tr>
                            <tr>
                                <td><strong>Other Deductions:</strong></td>
                                <td> {{ $setting->currency }} - {{ $payslip->deduction }}</td>
                            </tr>

                            <tr>
                                <td><strong>Tax Deductions:</strong></td>
                                <td> {{ $setting->currency }} - {{ $payslip->tax_deduction }}</td>
                            </tr>
                            <tr class="bg-secondary text-light">
                                <td><strong>Final Salary:</strong></td>
                                <td><strong>{{ $setting->currency }} {{ $payslip->net_salary }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>