<?php

namespace App\Console\Commands;

use App\Models\ZktecoDevice;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Rats\Zkteco\Lib\ZKTeco;

class ZkTecoAutoTimeSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:zk-teco-auto-time-set';

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
        $devices = ZktecoDevice::all();
        if ($devices->isNotEmpty()) {
            $timeout = 3;
            foreach ($devices as $device) {
                $isConnected = false;
                $socket = stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
                if ($socket) {
                    fclose($socket);
                    $isConnected = true;
                }

                if ($isConnected) {
                    $zk = new ZKTeco($device->ip_address, $device->port);
                    if ($zk->connect()) {
                        $device_time = $zk->getTime();
                        $current_time = Carbon::now()->format("Y-m-d H:i:s");

                        if ($device_time !== $current_time) {
                            $zk->setTime($current_time);
                        }
                    } else {
                        // Log::error("Failed to connect to ZkTeco Device: ". $device->ip_address);
                        continue;
                    }
                } else {
                    continue;
                }
            }
        } else {
            // Log::info("No Device found");
        }
    }
}
