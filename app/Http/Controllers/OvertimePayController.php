<?php

namespace App\Http\Controllers;

use App\Models\OvertimePay;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OvertimePayController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {
        return [
            new Middleware("permission:Settings View", ["only" => "index"]),
            new Middleware("permission:Settings View", ["only" => "storeOrUpdate"]),
        ];
    }

    public function index()
    {
        $overtime_pay = OvertimePay::first();
        return view('setting.overtime_pays.index', compact('overtime_pay'));
    }


    public function storeOrUpdate(Request $request)
    {

        $validated_req =  $request->validate([
            'overtime_pay' => 'required|numeric|decimal:0,2'
        ]);

        if (OvertimePay::doesntExist()) {
            OvertimePay::create($validated_req);
        } else {
            OvertimePay::first()->update($validated_req);
        }


        Toastr()->success("Your Changes Have Been Saved Succesfully");
        return redirect()->route("overtimepay.index");
    }
}
