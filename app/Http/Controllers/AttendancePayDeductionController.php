<?php

namespace App\Http\Controllers;

use App\Models\AttendancePayDeduction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AttendancePayDeductionController extends Controller implements HasMiddleware
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
        $attendance_pay_deduction = AttendancePayDeduction::first();
        return view("setting.AttendancePayDeductions.index", compact("attendance_pay_deduction"));
    }


    public function storeOrUpdate(Request $request)
    {
        $validated_req = $request->validate(
            [
                'late_count' => 'required|numeric|min:1',
                'days' => 'required|numeric|min:1'
            ],
            [
                'late_count.required' => 'Late count is required',
                'late_count.numeric' => 'Late count must be a number',
                'late_count.min' => 'Late count must be Start From  1',

                'days.required' => 'Days count is required',
                'days.numeric' => 'Days count must be a number',
                'days.min' => 'Days count must be  Start From  1'
            ]
        );


        if (AttendancePayDeduction::doesntExist()) {
            AttendancePayDeduction::create($validated_req);
        } else {
            AttendancePayDeduction::first()->update($validated_req);
        }

        Toastr()->success("Your Changes Have Been Saved Successfully");
        return redirect()->route("attendancepaydeduction.index");
    }
}
