<div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4 class="font-semibold bg-secondary text-light p-2 rounded">Pending Cash Advances</h4>
        </div>
    </div>


    <div class="row my-3">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="text-uppercase">
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Advance Type</th>
                            <th scope="col">Advance Amount</th>
                            <th scope="col">Advance Status</th>
                            <th scope="col">Advance Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cash_advances as $cash_advance)
                            <tr>
                                <th>{{ $cash_advance->employee->employee_name }}</th>
                                <td>{{ $cash_advance->advance_type }}</td>
                                <td>{{ $setting->currency }} {{ $cash_advance->advance_amount }}</td>
                                <td>
                                    <span
                                        class="badge bg-danger p-2 text-light">{{ $cash_advance->advance_status }}</span>
                                </td>
                                <td>{{ $cash_advance->advance_date }}</td>

                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-none text-light" style="background: #b8232a"
                                                wire:click='rejectCashAdvance({{ $cash_advance->id }})'>
                                                <i class="fa fa-cancel "></i>
                                            </button>
                                        </div>

                                        <div class="col-md-6">

                                            <button class="btn btn-outline-none text-light" style="background: #26a269;"
                                                wire:click='approveCashAdvance({{ $cash_advance->id }})'>
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
                {{ $cash_advances->links(data: ['scrollTo' => false]) }}
            </div>


        </div>
    </div>
</div>
