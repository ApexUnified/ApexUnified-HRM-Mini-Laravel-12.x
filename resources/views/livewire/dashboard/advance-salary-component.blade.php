<div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4 class="font-semibold bg-secondary text-light p-2 rounded">Pending Advance Salaries</h4>
        </div>
    </div>


    <div class="row my-3">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Advance Salary Amount</th>
                            <th scope="col">Advance Salary Status</th>
                            <th scope="col">Advance Salary Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($advance_salaries as $advance_salary)
                            <tr>
                                <th>{{ $advance_salary->employee->employee_name }}</th>
                                <td>{{ $setting->currency }} {{ $advance_salary->advance_salary_amount }}</td>
                                <td>
                                    <span
                                        class="badge bg-danger p-2 text-light">{{ $advance_salary->advance_salary_status }}</span>
                                </td>
                                <td>{{ $advance_salary->advance_salary_date }}</td>

                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-none text-light" style="background: #b8232a"
                                                wire:click='rejectAdvanceSalary({{ $advance_salary->id }})'>
                                                <i class="fa fa-cancel "></i>
                                            </button>
                                        </div>

                                        <div class="col-md-6">

                                            <button class="btn btn-outline-none text-light" style="background: #26a269;"
                                                wire:click='approveAdvanceSalary({{ $advance_salary->id }})'>
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
                {{ $advance_salaries->links(data: ['scrollTo' => false]) }}
            </div>


        </div>
    </div>
</div>
