<?php

namespace App\Http\Controllers;

use App\Models\Jobnature;
use App\Models\Position;
use App\Models\PositionLevel;
use Illuminate\Http\Request;
use PDO;
use PhpParser\Node\Expr\Empty_;

class PositionController extends Controller
{

    public function index()
    {
        $positions = Position::all();

        return view("Positions.index", compact("positions"));
    }


    public function create()
    {
        $jobNatures = Jobnature::all();
        if ($jobNatures->isEmpty()) {
            Toastr()->error('No Job Natures Available To Assign Please Create Job Nature First');
            return redirect()->route("jobnature.create");
        }

        $position_levels = PositionLevel::all();
        if ($position_levels->isEmpty()) {
            Toastr()->info('No Position Levels Available To Assign Please Create Position Level First');
            return redirect()->route("position-level.create");
        }
        return view("Positions.create", compact("jobNatures", "position_levels"));
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'position_name' => 'required',
            'jobnature_id' => 'required|exists:jobnatures,id',
            'position_level' => 'required|exists:position_levels,position_level',
        ], [
            'jobnature_id.required' => 'Job Nature Must Be Required For Position',
            'jobnature_id.exists' => 'Selected Job Nature Must Be Already Exist In The Database'
        ]);


        $create = Position::create($validated_req);

        if ($create) {
            Toastr()->success('Position Created Successfully');
            return redirect()->route("position.index");
        } else {
            Toastr()->error('Failed to create Position');
            return redirect()->back();
        }
    }



    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Position not found');
            return redirect()->back();
        }

        $position = Position::find($id);
        if (empty($position)) {
            Toastr()->error('Position not found');
            return redirect()->back();
        }

        $jobNatures = Jobnature::all();

        if ($jobNatures->isEmpty()) {
            Toastr()->error('No Job Natures Available To Assign Please Create Job Nature First');
            return redirect()->route("jobnature.create");
        }

        $position_levels = PositionLevel::all();
        if ($position_levels->isEmpty()) {
            Toastr()->info('No Position Levels Available To Assign Please Create Position Level First');
            return redirect()->route("position-level.create");
        }
        return view("Positions.edit", compact("position", "jobNatures", "position_levels"));
    }

    public function update(Request $request, string $id)
    {

        if (empty($id)) {
            Toastr()->error('Position not found');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'position_name' => 'required',
            'jobnature_id' => 'required|exists:jobnatures,id',
            'position_level' => 'required|exists:position_levels,position_level',
        ], [
            'jobnature_id.required' => 'Job Nature Must Be Required For Position',
            'jobnature_id.exists' => 'Selected Job Nature Must Be Already Exist In The Database'
        ]);

        $position = Position::find($id);
        if (empty($id)) {
            Toastr()->error('Position not found');
            return redirect()->back();
        }

        if ($position->update($validated_req)) {
            Toastr()->success('Position updated successfully');
            return redirect()->route("position.index");
        } else {
            Toastr()->error('Failed to update Position');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Position not found');
            return redirect()->back();
        }



        $position = Position::find($id);
        if (empty($id)) {
            Toastr()->error('Position not found');
            return redirect()->back();
        }


        if ($position->delete()) {
            Toastr()->success('Position deleted successfully');
            return redirect()->route("position.index");
        } else {
            Toastr()->error('Failed to delete position');
            return redirect()->back();
        }
    }


    public function deletebyselection(Request $request)
    {

        $ids = $request->input("position_ids");

        $positions = Position::whereIn("id", $ids)->get();

        if ($positions->isEmpty()) {
            return response()->json(["status" => false, "message" => "Positions Not Found"]);
        }


        foreach ($positions as $position) {
            $position->delete();
        }

        return response()->json([
            "status" => true,
            "message" => "Positions deleted successfully"
        ]);
    }
}
