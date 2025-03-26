<div class="single-table mt-5">
    <div class="data-tables">
        <table id="CashAdvance_Table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th class="no-print"></th>
                    <th class="no-print">
                        <label class="checkbox-container">
                            <input type="checkbox" id="select_all">
                            <div class="checkmark"></div>
                        </label>
                    </th>
                    <th>Cash Advance Employee</th>
                    <th>Cash Advance Type</th>
                    <th>Cash Advance Amount</th>
                    <th>Cash Advance Status</th>
                    <th>Description</th>
                    <th>Cash Advance Date</th>

                    @if (auth()->user()->can('Cash Advance Edit') || auth()->user()->can('Cash Advance Delete'))
                        <th class="no-print">Action</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                @foreach ($cash_advances as $cash_advance)
                    <tr class="cashAdvance-table-rows">
                        <td></td>
                        <td>

                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $cash_advance->id }}">
                                <div class="checkmark"></div>
                            </label>
                        </td>
                        <td>{{ $cash_advance->employee->employee_name }}</td>
                        <td>{{ $cash_advance->advance_type }}</td>
                        <td> {{ $setting->currency }} {{ $cash_advance->advance_amount }}</td>
                        <td>
                            @if ($cash_advance->advance_status == 'Rejected')
                                <span class="badge bg-danger p-2 text-light">{{ $cash_advance->advance_status }}</span>
                            @elseif($cash_advance->advance_status == 'Pending')
                                <span class="badge bg-danger p-2 text-light">{{ $cash_advance->advance_status }}</span>
                            @else
                                <span class="badge bg-success p-2 text-light">{{ $cash_advance->advance_status }}</span>
                            @endif
                        </td>
                        <td>{{ $cash_advance->description ?? 'No Description Given' }}</td>
                        <td>{{ $cash_advance->advance_date }}</td>


                        @if (auth()->user()->can('Cash Advance Edit') || auth()->user()->can('Cash Advance Delete'))
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    @can('Cash Advance Edit')
                                        <a class="dropdown-item" href="{{ route('cash-advance.edit', $cash_advance) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan

                                    @can('Cash Advance Delete')
                                        <form class="cash-advance-delete-form"
                                            action="{{ route('cash-advance.destroy', $cash_advance) }}" method="POST">
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
<div class="d-flex justify-content-end flex-wrap my-3" id="cashAdvance-pagination-links">
    {{ $cash_advances->onEachSide(2)->links() }}
</div>
