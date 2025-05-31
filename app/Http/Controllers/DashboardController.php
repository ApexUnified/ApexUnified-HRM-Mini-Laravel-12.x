<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\ZktecoDevice;
use Carbon\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Rats\Zkteco\Lib\ZKTeco;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:Dashboard View", ["only" => "index"])
        ];
    }
    public function index()
    {


        $TotalEmployees = Employee::count();
        $TotalAttendances = Attendance::count();
        $TotalDevices = ZktecoDevice::count();
        $TotalDepartments = Department::count();
        $upcomingHoliday = $this->getUpcomingHoliday();
        $branches = Branch::count();

        return view('dashboard', compact(
            "TotalEmployees",
            "TotalAttendances",
            "TotalDevices",
            "TotalDepartments",
            "upcomingHoliday",
            "branches"
        ));
    }



    private function getUpcomingHoliday()
    {

        $now = Carbon::now();

        $upcomingHoliday = Holiday::whereDate("holiday_date", ">", $now)->first(["holiday_date", "holiday_name"]);
        if (!empty($upcomingHoliday)) {
            $parsedHolidayDate = Carbon::parse($upcomingHoliday->holiday_date);
            $differenceFromHoliday = $parsedHolidayDate->diffForHumans($now);
            return  $upcomingHoliday->holiday_name  . " Holiday "  . $differenceFromHoliday;
        } else {
            return "No Holiday Futher";
        }
    }
}
