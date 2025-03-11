<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DepartmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware("permission:Department View", ["only" => "index"]),
            new Middleware("permission:Department Create", ["only" => "create", "store"]),
            new Middleware("permission:Department Edit", ["only" => "edit", "update"]),
            new Middleware("permission:Department Delete", ["only" => "destroy", "deletebyselection"]),
        ];
    }
    public function index()
    {
        $departments = Department::orderBy("created_at", "DESC")->get();
        return view('deparments.index', compact("departments"));
    }


    public function create()
    {
        $branches = Branch::all();
        return view('deparments.create', compact("branches"));
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'department_name' => 'required|min:3',
            'branch_id' => 'required|exists:branches,id'
        ], [
            "branch.required" => "Branch is Required To Create Department"
        ]);

        $create = Department::create($validated_req);
        if ($create) {
            Toastr()->success("Deparment created successfully");
            return redirect()->route('department.index');
        } else {
            Toastr()->error("Failed to create deparment");
            return redirect()->back();
        }
    }



    public function edit(string $id)
    {
        $department = Department::find($id);
        $branches = Branch::all();
        return view('deparments.edit', compact('department', 'branches'));
    }


    public function update(Request $request, string $id)
    {
        $validated_req = $request->validate([
            'department_name' => 'required|min:3',
            'branch_id' => 'required|exists:branches,id'
        ], [
            "branch.required" => "Branch is Required To Create Department"
        ]);

        $department = Department::find($id);
        if ($department) {
            $department->update($validated_req);
            Toastr()->success("Deparment updated successfully");
            return redirect()->route('department.index');
        } else {
            Toastr()->error("Failed to update deparment");
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {

        $ids = $request->input('department_ids');

        if (in_array(1, $ids)) {
            return response()->json([
                'status' => false,
                'message' => 'The Departments You Have Selected In Which There is Defualt Department Also Present So You Cannot Delete The Default Department Please UnSelect It'
            ]);
        }

        $delete = Department::whereIn('id', $ids)->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => "Selected Department has been deleted"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Failed to delete selected department"
            ]);
        }
    }


    public function destroy(string $id)
    {
        $deparment = Department::find($id);
        if ($deparment) {
            $deparment->delete();
            Toastr()->success("Deparment deleted successfully");
            return redirect()->route('department.index');
        }
    }
}
