<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\PositionLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PositionLevelController extends Controller
{

    public function index()
    {
        $position_levels = PositionLevel::orderBy("created_at", "DESC")->get();
        return view("setting.PositionLevels.index", compact("position_levels"));
    }


    public function create()
    {
        return view("setting.PositionLevels.create");
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'position_level' => 'required'
        ]);

        $create = PositionLevel::create($validated_req);
        if ($create) {
            Toastr()->success("Position Level Created Succesfully");
            return redirect()->route("position-level.index");
        } else {
            Toastr()->error("Failed to create Position Level");
            return redirect()->back();
        }
    }




    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Position Level not found");
            return redirect()->back();
        }

        $position_level = PositionLevel::find($id);
        if (empty($position_level)) {
            Toastr()->error("Position Level not found");
            return redirect()->back();
        }

        return view("setting.PositionLevels.edit", compact("position_level"));
    }

    public function update(Request $request, string $id)
    {
        if (empty($id)) {
            Toastr()->error("Position Level not found");
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'position_level' => 'required'
        ]);

        $position_level = PositionLevel::find($id);
        if (empty($position_level)) {
            Toastr()->error("Position Level not found");
            return redirect()->back();
        }

        Position::where("position_level", "=", $position_level->position_level)->update(["position_level" => $request->input("position_level")]);
        if ($position_level->update($validated_req)) {
            Toastr()->success("Position Level updated successfully");
            return redirect()->route("position-level.index");
        } else {
            Toastr()->error("Failed to update Position Level");
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error("Position Level not found");
            return redirect()->back();
        }

        $position_level = PositionLevel::find($id);
        if (empty($position_level)) {
            Toastr()->error("Position Level not found");
            return redirect()->back();
        }

        if ($position_level->delete()) {
            Toastr()->success("Position Level deleted successfully");
            return redirect()->route("position-level.index");
        } else {
            Toastr()->error("Failed to delete Position Level");
            return redirect()->back();
        }
    }


    public function deletebyselection(Request $request)
    {
        $ids = $request->input("position_level_ids");
        $delete = PositionLevel::whereIn('id', $ids)->delete();

        if ($delete) {
            return response()->json(["status" => true, "message" => "Position Levels deleted successfully"]);
        } else {
            return response()->json(["status" => false, "message" => "Position Levels Not Found"]);
        }
    }
}
