<div>



    @if (auth()->user()->hasRole('admin'))

        <div class="row">
            <div class="col-md-12 text-center">
                <h6 class="text-muted">Filter By Employee</h6>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                @if ($isLoaded)

                    <div class="form-group w-50">
                        <label for="employee_input">Employees</label>
                        <select class="form-control" id="employee_input" wire:model.live='employee_id'
                            data-live-search="true" ">
                    <option value="" hidden>Filter By Employee</option>
                           @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" @selected($employee_id == $employee->id)>
                                {{ $employee->employee_name }}</option>
                @endforeach
                </select>
            </div>
        @else
            <div class="d-flex flex-column align-items-center my-4">
                <h5>Please Wait Filter May Take Some Seconds To Load</h5>
                <div class="loader"></div>
            </div>
    @endif
</div>
</div>

@endif
<canvas id="myLineChart" width="700" height="200"></canvas>

<script>
    const months = @json($allMonths);
    let AttendancesForLineChart = @json($attendances);
    let OvertimesForLineChart = @json($overtimes);
    let LoansForLineChart = @json($loans);
    let CashAdvanceForLineChart = @json($cash_advances);
    let AdvanceSalaryForLineChart = @json($advance_salaries);
</script>
</div>
