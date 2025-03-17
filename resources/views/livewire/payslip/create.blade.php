

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="display-5">Create Payslip</h2>
                            <a href="{{ route('payslip.index') }}" class="btn btn-primary">Back To Payslips</a>
                        </div>


                        <form wire:submit.prevent="checkEmployee" class="m-auto w-75" >
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="employee_id" class="col-form-label">Employee*</label>

                                    <select class="form-control"  wire:model="employee_id" id="employee_id" 
                                    @disabled($isDisabled ? true : false) >
                                        <option value="" hidden>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                        @endforeach
                                    </select>
                                   @error("employee_id")                                       
                                        <small class="text-danger ml-2">{{ $message }}</small>
                                    @enderror
                                </div>
    
                            </div>
                            <div class="col-md-4 mt-4">
                                <button class="btn btn-primary mt-2" type="submit"   @disabled($isDisabled ? true : false)  >Check Eligibilities</button>
                                <button class="btn btn-danger mt-2" type="submit" wire:click='resetEverything'  >Reset Form</button>
                            </div>
                        </div>
                      </form>



                      @if($showForm)
                      <hr>

                      <!-- Deductions & Bonuses Form -->
                      <form wire:submit.prevent="calculateFinalSalary">
                          <div class="row">
                              <!-- Allowances -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="allowance">Allowances</label>
                                     <select class="form-control" wire:model='allowances_arr'  id="allowances_arr"  multiple>
                                         <option value="" hidden>Select Allowance</option>
                                         @foreach ($eligibleAllowances as $allowance)
                                             <option value="{{ $allowance["id"] }}">{{ $allowance["allowance_type"] }}
                                                - {{ $setting->currency }} {{ $allowance["allowance_amount"] }}
                                             </option>
                                         @endforeach
                                     </select>
                                     @error("allowances_arr")
                                            <small class="text-danger">{{$message}}</small>
                                     @enderror
                                  </div>
                              </div>

                              <!-- Bonuses -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="bonus">Bonus</label>
                                      <select class="form-control" wire:model='bonuses_arr'  id="bonus" multiple >
                                        <option value="" hidden>Select Bonus</option>
                                        @foreach ($bonuses as $bonus)
                                            <option value="{{ $bonus->id }}"> {{ $bonus->bonus_type }} - {{ $setting->currency }} {{$bonus->bonus_amount}}</option>
                                        @endforeach
                                    </select>
                                    @error("bonuses_arr")
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                  </div>
                              </div>

                              <!--  Deductions -->
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="deductions">Deductions</label>
                                      <select class="form-control" wire:model='deductions_arr'  id="deductions"  multiple>
                                        <option value="" hidden>Select Deduction</option>
                                        @foreach ($deductions as $deduction)
                                            <option value="{{ $deduction->id }}"> {{ $deduction->deduction_type }} - {{ $setting->currency }} {{$deduction->deduction_amount}}</option>
                                        @endforeach
                                    </select>
                                    @error("deductions_arr")
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                  </div>
                              </div>
                          </div>




                          <div class="row">
                            <!-- Tax Deduction -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tax_deductions_arr">Tax Deductions</label>
                                   <select class="form-control" wire:model='tax_deductions_arr'  id="tax_deductions_arr"  multiple>
                                       <option value="" hidden>Select Tax Deductions</option>
                                       @foreach ($tax_deductions as $tax_deduction)
                                           <option value="{{ $tax_deduction->id}}">{{ $tax_deduction->tax_type}}
                                              - {{ $setting->currency }} {{ $tax_deduction->tax_amount }}
                                           </option>
                                       @endforeach
                                   </select>
                                   @error("tax_deductions_arr")
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                       

                          <!-- Submit Button -->
                          <div class="row mt-3">
                              <div class="col-md-12 text-right">
                                  <button class="btn btn-success" type="submit">Calculate Final Salary</button>
                              </div>
                          </div>
                      </form>

                      <hr>
                      <div class="card mt-4">
                        <div class="card-body">
                           <div class="d-flex justify-content-between my-3">
                            <h4 class="mb-3">Payslip Summary</h4>
                            <button class="btn btn-primary"wire:click="createPayslip">Create Payslip</button>
                           </div>
                            <table class="table table-bordered">
                                <tr class="bg-secondary text-light ">
                                    <td><strong>Basic Salary:</strong></td>
                                    <td> {{ $setting->currency }} {{ number_format($base_salary, 2) }}</td>
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
                                    <td> {{ $setting->currency }} {{ number_format($overtime_pay, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Late & Absent Deduction:</strong></td>
                                    <td>{{ $setting->currency }} - {{ number_format($late_absent_deduction, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Loan Deduction:</strong></td>
                                    <td>{{ $setting->currency }} - {{ number_format($loan_deduction, 2) }}</td>
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
                       @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

