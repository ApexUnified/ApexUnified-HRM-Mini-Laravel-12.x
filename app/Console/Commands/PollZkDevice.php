<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\ZktecoDevice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Rats\Zkteco\Lib\ZKTeco;

class PollZkDevice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:poll-zk-device';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Log::info("Polling Zk Device");
        $employees = [];
        $devices = ZktecoDevice::all();
        $timeout = 3;
        // $deviceTImes = [] ;
        foreach ($devices as $device) {
            $isConnected = false;
            $socket = stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
            if ($socket) {
                fclose($socket);
                $isConnected = true;
            }

            if($isConnected){
                $zk = new ZKTeco($device->ip_address,$device->port);

            if($zk->connect()){
                // $deviceTImes[] = $zk->getTime();
                $deviceEmployees = $zk->getUser();
                if(!empty($deviceEmployees)){
                        foreach ($deviceEmployees as $key => $employeeData) {
                            if (isset($employeeData['userid'])) {
                                $exists = Employee::where("device_user_id", $employeeData['userid'])
                                    ->first();
                                if(!$exists){
                                    $create = Employee::create([
                                        'employee_id' =>  rand(0000000000,9999999999),
                                        'father_name' => "Device Created User",
                                        'employee_dob' => now()->format("Y-m-d"),
                                        'date_of_hiring' => now()->format("Y-m-d"),
                                        'department_id' => 1,
                                        'employee_schedule' => "No SChedule Assigned",
                                        'device_id' => json_encode([$device->id]),
                                        'device_user_id' => $employeeData['userid'],
                                        'employee_name' => $employeeData['name'],
                                        'designation' => "No Designation Assigned"
                                    ]);

                                    if($create){
                                        // Log::info("Employee Created: ". $employeeData['name']);
                                    }
                                }else{
                                    // Log::info("Employees Are Exists");
                                }


                            } else {
                                // Log::warning("Missing 'userid' for employee key $key.");
                            }
                        }


                    // Log::info($userIds);

            }


            }
            }else{
                continue;
            }


        }

        // Log::info($deviceTImes);

}
}
