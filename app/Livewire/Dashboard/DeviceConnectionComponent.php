<?php

namespace App\Livewire\Dashboard;

use App\Models\ZktecoDevice;
use Livewire\Component;

class DeviceConnectionComponent extends Component
{

    public $connectedDevices = 0;
    public $isLoaded = false;


    protected $listeners = ["loadConnectedDevices"];

    public function loadConnectedDevices()
    {
        $this->connectedDevices = $this->getConnectedDevices();
        $this->isLoaded = true;
    }
    private function getConnectedDevices()
    {

        $devices = ZktecoDevice::all();

        if ($devices->isEmpty()) {
            return 0;
        }

        $connectedDevices = 0;
        $timeout = 3;
        foreach ($devices as $device) {
            if ($device->ip_address == "192.168.100.1" || $device->ip_address == "127.0.0.1") {
                continue;
            } else {
                $socket = stream_socket_client("tcp://{$device->ip_address}:{$device->port}", $errno, $errstr, $timeout);
                if ($socket) {
                    $connectedDevices++;
                    fclose($socket);
                }
            }
        }

        return $connectedDevices;
    }

    public function render()
    {
        return view('livewire.dashboard.device-connection-component');
    }
}
