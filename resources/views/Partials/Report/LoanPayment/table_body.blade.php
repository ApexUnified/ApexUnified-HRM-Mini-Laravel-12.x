<div class="single-table mt-5">
    <div class="data-tables">
        <table id="loan_payment_report_table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th>Employee Profile</th>
                    <th>Employee Name</th>
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Loan Remeaning Amount</th>
                    <th>Loan Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loanPayments as $loan_payment)
                    <tr class="loanPayment-table-rows">
                        <td>
                            @if (!empty($loan_payment->employee->profile))
                                <img src="{{ asset('assets/images/employee/profile/' . $loan_payment->employee->profile) }}"
                                    alt="" style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                            @else
                                <img src="{{ asset('assets/images/default-img.webp') }}" alt=""
                                    style="width:50px; height:50px; object-fit:cover; border-radius:3rem">
                            @endif
                        </td>
                        <td>{{ $loan_payment->employee->employee_name }}</td>
                        <td>{{ $loan_payment->loan_type }}</td>
                        <td>{{ $setting->currency }} {{ $loan_payment->loan_amount }}</td>
                        <td>{{ $setting->currency }} {{ $loan_payment->remeaning_loan }}</td>


                        <td>
                            <span
                                class="badge badge-{{ $loan_payment->status == 'Active' ? 'primary' : 'success' }} p-2">
                                {{ $loan_payment->status }}
                            </span>
                        </td>

                        <td>{{ $loan_payment->created_at->format('Y-M-d') }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end flex-wrap my-3" id="loanPayment-pagination-links">
    {{ $loanPayments->onEachSide(2)->links() }}
</div>
