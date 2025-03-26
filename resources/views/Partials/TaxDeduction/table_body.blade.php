<div class="single-table mt-5">
    <div class="data-tables">
        <table id="TaxDeduction_Table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th class="no-print"></th>
                    <th class="no-print">
                        <label class="checkbox-container">
                            <input type="checkbox" id="select_all">
                            <div class="checkmark"></div>
                        </label>
                    </th>
                    <th>Tax Deduction Type</th>
                    <th>Tax Deduction Percentage</th>
                    <th>Tax Deduction Amount</th>
                    <th>Tax Description</th>
                    <th>Date</th>


                    @if (auth()->user()->can('Tax Deduction Edit') || auth()->user()->can('Tax Deduction Delete'))
                        <th class="no-print">Action</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                @foreach ($taxDeductions as $tax_deduction)
                    <tr class="taxDeduction-table-rows">
                        <td></td>
                        <td>

                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $tax_deduction->id }}">
                                <div class="checkmark"></div>
                            </label>
                        </td>

                        <td>{{ $tax_deduction->tax_type }}</td>
                        <td>{{ $tax_deduction->tax_percentage }}%</td>
                        <td>{{ $setting->currency }} {{ $tax_deduction->tax_amount }}</td>
                        <td>{{ $tax_deduction->description ?? 'No Description Given' }}</td>
                        <td>{{ $tax_deduction->created_at->format('Y-M-d') }}</td>


                        @if (auth()->user()->can('Tax Deduction Edit') || auth()->user()->can('Tax Deduction Delete'))
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">

                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">


                                    @can('Tax Deduction Edit')
                                        <a class="dropdown-item" href="{{ route('tax-deduction.edit', $tax_deduction) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan


                                    @can('Tax Deduction Delete')
                                        <form class="tax-deduction-delete-form"
                                            action="{{ route('tax-deduction.destroy', $tax_deduction) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit">
                                                <i class="fa-solid fa-trash fa-lg mx-1"></i>
                                                Delete</button>
                                        </form>
                                    @endcan

                                </div>
                            </td>
                        @endif

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end flex-wrap my-3" id="taxDeduction-pagination-links">
    {{ $taxDeductions->onEachSide(2)->links() }}
</div>
