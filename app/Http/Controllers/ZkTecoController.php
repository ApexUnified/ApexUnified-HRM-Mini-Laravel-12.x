<?php

namespace App\Http\Controllers;

use App\Models\ZktecoDevice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Rats\Zkteco\Lib\ZKTeco;

class ZkTecoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:Device View", ["only" => "index"]),
            new Middleware("permission:Device Create", ["only" => "create"]),
            new Middleware("permission:Device Edit", ["only" => "edit"]),
            new Middleware("permission:Device Delete", ["only" => "destroy"]),
        ];
    }
    public function index()
    {
        $devices = ZktecoDevice::all();
        return view("zkteco_devices.index", compact("devices"));
    }


    public function create()
    {
        return view("zkteco_devices.create");
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ipv4',
            'port' => 'required',
        ]);



        $create = ZktecoDevice::create($validated_req);
        if ($create) {
            Toastr()->success("Device created successfully");
            return redirect()->route('zkteco_device.index');
        } else {
            Toastr()->error("Failed to create device");
            return redirect()->back();
        }
    }



    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Device not found");
            return redirect()->back();
        }

        $device = ZktecoDevice::find($id);
        if (empty($device)) {
            Toastr()->error("Device not found");
            return redirect()->back();
        }

        return view("zkteco_devices.edit", compact("device"));
    }

    public function update(Request $request, string $id)
    {
        $validated_req = $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ipv4',
            'port' => 'required',
        ]);

        $device = ZktecoDevice::find($id);
        if (empty($device)) {
            Toastr()->error("Device not found");
            return redirect()->back();
        }

        $update = $device->update($validated_req);
        if ($update) {
            Toastr()->success("Device updated successfully");
            return redirect()->route('zkteco_device.index');
        } else {
            Toastr()->error("Failed to update device");
            return redirect()->back();
        }
    }



    public function deleteBySelection(Request $request)
    {
        $ids = $request->input("device_ids");
        $delete = ZktecoDevice::whereIn('id', $ids)->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => "Device(s) deleted successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete device(s)"
            ]);
        }
    }


    public function destroy(string $id)
    {
        $device = ZktecoDevice::find($id);
        if (!empty($device)) {
            $delete = $device->delete();
            if ($delete) {
                Toastr()->success("Device deleted successfully");
                return redirect()->route('zkteco_device.index');
            } else {
                Toastr()->error("Failed to delete device");
                return redirect()->back();
            }
        } else {
            Toastr()->error("Device not found");
            return redirect()->back();
        }
    }
}
