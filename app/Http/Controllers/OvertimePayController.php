<?php

namespace App\Http\Controllers;

use App\Models\OvertimePay;
use Illuminate\Http\Request;

class OvertimePayController extends Controller
{

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
