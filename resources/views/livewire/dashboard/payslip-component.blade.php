<div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4 class="font-semibold bg-secondary text-light p-2 rounded">Pending Payslips</h4>
        </div>
    </div>


    <div class="row my-3">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Base Salary</th>
                            <th scope="col">Net Salary</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payslip Creation Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payslips as $payslip)
                            <tr>
                                <th>{{ $payslip->employee->employee_name }}</th>
                                <td>{{ $setting->currency }} {{ $payslip->base_salary }}</td>
                                <td>{{ $setting->currency }} {{ $payslip->net_salary }}</td>
                                <td>
                                    <span class="badge bg-danger p-2 text-light">
                                        {{ $payslip->status }}
                                    </span>
                                </td>
                                <td>{{ $payslip->created_at->format('Y-m-d') }}</td>
                                <td>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-none text-light payslip-delete-btn"
                                                style="background: #b8232a" data-id="{{ $payslip->id }}">
                                                <i class="fa fa-trash "></i>
                                            </button>
                                        </div>

                                        <div class="col-md-6">

                                            <button class="btn btn-outline-none text-light" style="background: #26a269;"
                                                wire:click='updatePayslipStatus({{ $payslip->id }})'>
                                                <i class="fa-solid fa-check-double fa-xl"></i>
                                            </button>

                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>



            <div class="d-flex justify-content-end my-4">
                {{ $payslips->links(data: ['scrollTo' => false]) }}
            </div>



        </div>
    </div>
</div>
