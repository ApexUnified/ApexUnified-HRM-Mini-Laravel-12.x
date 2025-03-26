<div class="single-table mt-5">
    <div class="data-tables">
        <table id="Deduction_Table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th class="no-print"></th>
                    <th class="no-print">
                        <label class="checkbox-container">
                            <input type="checkbox" id="select_all">
                            <div class="checkmark"></div>
                        </label>
                    </th>
                    <th>Deduction Type</th>
                    <th>Deduction Amount</th>
                    <th>Description</th>
                    <th>Date</th>

                    @if (auth()->user()->can('Deduction Edit') || auth()->user()->can('Deduction Delete'))
                        <th class="no-print">Action</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                @foreach ($deductions as $deduction)
                    <tr class="deduction-table-rows">
                        <td></td>
                        <td>

                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $deduction->id }}">
                                <div class="checkmark"></div>
                            </label>
                        </td>

                        <td>{{ $deduction->deduction_type }}</td>
                        <td>{{ $setting->currency }} {{ $deduction->deduction_amount }}</td>
                        <td>{{ $deduction->description ?? 'No Description Given' }}</td>
                        <td>{{ $deduction->created_at->format('Y-M-d') }}</td>

                        @if (auth()->user()->can('Deduction Edit') || auth()->user()->can('Deduction Delete'))
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">

                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    @can('Deduction Edit')
                                        <a class="dropdown-item" href="{{ route('deduction.edit', $deduction) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan


                                    @can('Deduction Delete')
                                        <form class="deduction-delete-form"
                                            action="{{ route('deduction.destroy', $deduction) }}" method="POST">
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

<div class="d-flex justify-content-end flex-wrap my-3" id="deduction-pagination-links">
    {{ $deductions->onEachSide(2)->links() }}
</div>
