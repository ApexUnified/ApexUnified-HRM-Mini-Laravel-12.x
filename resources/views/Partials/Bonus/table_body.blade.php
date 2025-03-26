<div class="single-table mt-5">
    <div class="data-tables">
        <table id="Bonus_Table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th class="no-print"></th>
                    <th class="no-print">
                        <label class="checkbox-container">
                            <input type="checkbox" id="select_all">
                            <div class="checkmark"></div>
                        </label>
                    </th>
                    <th>Bonus Type</th>
                    <th>Bonus Frequency</th>
                    <th>Bonus Description</th>
                    <th>Bonus Amount</th>
                    <th>Date</th>

                    @if (auth()->user()->can('Bonus Edit') || auth()->user()->can('Bonus Delete'))
                        <th class="no-print">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($bonuses as $bonus)
                    <tr class="bonus-table-rows">
                        <td></td>
                        <td>

                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $bonus->id }}">
                                <div class="checkmark"></div>
                            </label>
                        </td>
                        <td>{{ $bonus->bonus_type }}</td>
                        <td>{{ $bonus->frequency }}</td>
                        <td>{{ $bonus->description ?? 'No Description Given' }}</td>
                        <td> {{ $setting->currency }} {{ $bonus->bonus_amount }}</td>
                        <td>{{ $bonus->created_at->format('Y-M-d') }}</td>

                        @if (auth()->user()->can('Bonus Edit') || auth()->user()->can('Bonus Delete'))
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    @can('Bonus Edit')
                                        <a class="dropdown-item" href="{{ route('bonus.edit', $bonus) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan

                                    @can('Bonus Delete')
                                        <form class="bonus-delete-form" action="{{ route('bonus.destroy', $bonus) }}"
                                            method="POST">
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
<div class="d-flex justify-content-end flex-wrap my-3" id="bonus-pagination-links">
    {{ $bonuses->onEachSide(2)->links() }}
</div>
