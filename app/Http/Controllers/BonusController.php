<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BonusController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Bonus View", ["only" => "index"]),
            new Middleware("permission:Bonus Create", ["only" => "create", "store"]),
            new Middleware("permission:Bonus Edit", ["only" => "edit", "update"]),
            new Middleware("permission:Bonus Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index(Request $request)
    {
        $bonuses = Bonus::latest()->paginate(10);

        $setting = Setting::first();
        if ($request->ajax()) {
            return view("Partials.Bonus.table_body", compact("bonuses", "setting"))->render();
        }

        return view("Bonuses.index", compact("bonuses", "setting"));
    }


    public function create()
    {
        return view("Bonuses.create");
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'bonus_type' => 'required',
            'frequency' => 'required|in:Daily,Monthly,Quarterly,Annually',
            'description' => 'nullable',
            'bonus_amount' => 'required|numeric'
        ]);


        $create = Bonus::create($validated_req);
        if ($create) {
            Toastr()->success("Bonus added successfully");
            return redirect()->route("bonus.index");
        } else {
            Toastr()->success("Failed To Add Bonus");
            return redirect()->back();
        }
    }



    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Bonus not found");
            return redirect()->back();
        }
        $bonus = Bonus::find($id);
        if (empty($bonus)) {
            Toastr()->error("Bonus not found");
            return redirect()->back();
        }
        return view("Bonuses.edit", compact("bonus"));
    }

    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error("Bonus not found");
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'bonus_type' => 'required',
            'frequency' => 'required|in:Daily,Monthly,Quarterly,Annually',
            'description' => 'nullable',
            'bonus_amount' => 'required|numeric'
        ]);

        $bonus = Bonus::find($id);
        if (empty($bonus)) {
            Toastr()->error("Bonus not found");
            return redirect()->back();
        }


        if ($bonus->update($validated_req)) {
            Toastr()->success("Bonus updated successfully");
            return redirect()->route("bonus.index");
        } else {
            Toastr()->error("Failed to update bonus");
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Bonus not found");
            return redirect()->back();
        }


        $bonus = Bonus::find($id);
        if (empty($bonus)) {
            Toastr()->error("Bonus not found");
            return redirect()->back();
        }


        if ($bonus->delete()) {
            Toastr()->success("Bonus deleted successfully");
            return redirect()->route("bonus.index");
        } else {
            Toastr()->error("Failed to delete bonus");
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("bonus_ids");
        $bonuses = Bonus::whereIn("id", $ids)->get();
        if ($bonuses->isEmpty()) {
            return response()->json(["status" => false, "message" => "Bonuses not found"]);
        }

        foreach ($bonuses as $bonus) {
            $bonus->delete();
        }

        return response()->json(["status" => true, "message" => "Bonuses deleted successfully"]);
    }
}
