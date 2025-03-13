<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\ZktecoDevice;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Rats\Zkteco\Lib\ZKTeco;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware() : array
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


        return view('dashboard', compact("TotalEmployees", "TotalAttendances", "TotalDevices","TotalDepartments"));
    }

    public function deviceCheck()
    {

        $devices = ZktecoDevice::all();
        // $employees = [];
        $attendances = [];
        $devicesTime = [];
        if ($devices->isNotEmpty()) {
            foreach ($devices as $device) {

                $zk = new ZKTeco($device->ip_address, $device->port);
                if ($zk->connect()) {
                    set_time_limit(120);
                    // $employees[] = $zk->getUser();
                    $attendances[] = $zk->getAttendance();
                    // $zk->clearAttendance();
                    // $devicesTime[] = $zk->getTime();
                }


            }
        }

        // return $devicesTime;
        // return $employees;
        return $attendances;
    }
}
