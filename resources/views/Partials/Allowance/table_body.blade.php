<div class="single-table mt-5">
    <div class="data-tables">
        <table id="Allowance_Table" class="text-center">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th class="no-print"></th>
                    <th class="no-print">
                        <label class="checkbox-container">
                            <input type="checkbox" id="select_all">
                            <div class="checkmark"></div>
                        </label>
                    </th>
                    <th>Allowance Type</th>
                    <th>Allowance Frequency</th>
                    <th>Allowance Eligibility</th>
                    <th>Allowance Amount</th>
                    <th>Allowance Description</th>
                    <th>Date</th>

                    @if (auth()->user()->can('Allowance Edit') || auth()->user()->can('Allowance Delete'))
                        <th class="no-print">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($allowances as $allowance)
                    <tr class="allowance-table-rows">
                        <td></td>
                        <td>

                            <label class="checkbox-container" style="margin-left: 0.5rem">
                                <input type="checkbox" class="each_select" value="{{ $allowance->id }}">
                                <div class="checkmark"></div>
                            </label>
                        </td>
                        <td>{{ $allowance->allowance_type }}</td>
                        <td>{{ $allowance->frequency }}</td>

                        @php
                            $eligibilityArray = json_decode($allowance->eligibility, true);
                            if (!empty($eligibilityArray)) {
                                $eligibility_key = array_key_first($eligibilityArray);
                                $eligibility_value = $eligibilityArray[$eligibility_key];
                            }
                        @endphp

                        <td>
                            @if (!empty($eligibilityArray))
                                {{ $eligibility_key }} - [
                                @if ($eligibility_key == 'department')
                                    @php
                                        $departments = \App\Models\Department::whereIn('id', $eligibility_value)->get();
                                    @endphp

                                    @foreach ($departments as $department)
                                        {{ $department->department_name }} ,
                                    @endforeach
                                @elseif($eligibility_key == 'position')
                                    @php
                                        $positions = \App\Models\Position::whereIn('id', $eligibility_value)->get();
                                    @endphp

                                    @foreach ($positions as $position)
                                        {{ $position->position_name }} ,
                                    @endforeach
                                @endif
                                ]
                            @else
                                All
                            @endif
                        </td>
                        <td> {{ $setting->currency }} {{ $allowance->allowance_amount }}</td>
                        <td>{{ $allowance->description ?? 'No Description Given' }}</td>
                        <td>{{ $allowance->created_at->format('Y-M-d') }}</td>

                        @if (auth()->user()->can('Allowance Edit') || auth()->user()->can('Allowance Delete'))
                            <td>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-hexagon-nodes-bolt fa-lg mx-1"></i>
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform:translate3d(15px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">

                                    @can('Allowance Edit')
                                        <a class="dropdown-item" href="{{ route('allowance.edit', $allowance) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg mx-1"></i>
                                            Edit</a>
                                    @endcan

                                    @can('Allowance Delete')
                                        <form class="allowance-delete-form"
                                            action="{{ route('allowance.destroy', $allowance) }}" method="POST">
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
<div class="d-flex justify-content-end flex-wrap my-3" id="allowance-pagination-links">
    {{ $allowances->onEachSide(2)->links() }}
</div>
