<div>

    <div class="row">
        <div class="col-md-12 text-center">
            <h6 class="text-muted">Additional Filters</h6>
        </div>
    </div>

    <div class="row my-3">
        @if (auth()->user()->hasRole('admin'))
            <div class="col-md-8">
                @if ($isLoaded)
                    <div class="form-group">
                        <label for="employee_dougnut_input">Employees</label>
                        <select class="form-control" id="employee_dougnut_input" wire:model.live='employee_id'
                            data-live-search="true">

                            <option value="" hidden>Filter By Employee</option>

                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @selected($employee_id == $employee->id)>
                                    {{ $employee->employee_name }}</option>
                            @endforeach

                        </select>

                    </div>
                @else
                    <div class="d-flex flex-column align-items-center my-4">
                        <h6>Please Wait Filter May Take Some Seconds To Load</h6>
                        <div class="loader"></div>
                    </div>

                @endif
            </div>
        @endif
        <div class="col-md-4 ">
            <div class="form-group">
                <label for="period">Period</label>
                <select wire:model.live='period' id="period" class="form-control">
                    <option value="" hidden>Select Period</option>

                    <option value="All">All</option>
                    <option value="1">This Month</option>
                    <option value="3">Previous 3 Months</option>
                    <option value="6">Previous 6 Months</option>
                    <option value="12">Last Year</option>
                </select>
            </div>
        </div>
    </div>

    <canvas id="myDoughnutChart" width="700" height="200"></canvas>

    <script>
        let lateAttendancesForDoughnutChart = @json($late_attendances);
        let AbsentAttendancesForDoughnutChart = @json($absent_attendances);
        let EarlyAttendancesForDoughnutChart = @json($early_attendances);
    </script>
</div>
