<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class HolidayController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:Holiday View", ["only" => "index"]),
            new Middleware("permission:Holiday Create", ["only" => "create", "store"]),
            new Middleware("permission:Holiday Edit", ["only" => "edit", "update"]),
            new Middleware("permission:Holiday Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index()
    {
        $holidays = Holiday::orderBy("created_at", "DESC")->get();
        return view("Holidays.index", compact("holidays"));
    }


    public function create()
    {
        return view("Holidays.create");
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'holiday_name' => 'required|string|max:255',
            'holiday_date' => 'required|date'
        ]);

        $create = Holiday::create($validated_req);
        if ($create) {
            Toastr()->success('Holiday created successfully');
            return redirect()->route("holiday.index");
        } else {
            Toastr()->success('Error Occured While Creating holiday');
            return redirect()->route("holiday.index");
        }
    }


    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Holiday not found');
            return redirect()->route("holiday.index");
        }


        $holiday = Holiday::find($id);
        if (empty($holiday)) {
            Toastr()->error('Holiday not found');
            return redirect()->route("holiday.index");
        }

        return view("Holidays.edit", compact("holiday"));
    }

    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error('Holiday not found');
            return redirect()->route("holiday.index");
        }

        $validated_req = $request->validate([
            'holiday_name' => 'required|string|max:255',
            'holiday_date' => 'required|date'
        ]);

        $holiday = Holiday::find($id);
        if (empty($holiday)) {
            Toastr()->error('Holiday not found');
            return redirect()->route("holiday.index");
        }

        if ($holiday->update($validated_req)) {
            Toastr()->success('Holiday updated successfully');
            return redirect()->route("holiday.index");
        } else {
            Toastr()->error('Failed to update Holiday');
            return redirect()->route("holiday.index");
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Holiday not found');
            return redirect()->route("holiday.index");
        }


        $holiday = Holiday::find($id);
        if (empty($holiday)) {
            Toastr()->error('Holiday not found');
            return redirect()->route("holiday.index");
        }


        if ($holiday->delete()) {
            Toastr()->success('Holiday deleted successfully');
            return redirect()->route("holiday.index");
        } else {
            Toastr()->error('Error Occured While Deleting Holiday');
            return redirect()->route("holiday.index");
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("holiday_ids");


        $holidays = Holiday::whereIn('id', $ids)->get();

        if ($holidays->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete holidays'
            ]);
        }


        foreach ($holidays as $holiday) {
            $holiday->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Holidays deleted successfully'
        ]);
    }
}
