<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BranchController extends Controller implements HasMiddleware
{

    public static function middleware(): array {
        return [
           new Middleware("permission:Setting View",["only" => "index"]),
           new Middleware("permission:Setting View",["only" => "Create"]),
           new Middleware("permission:Setting View",["only" => "Edit"]),
           new Middleware("permission:Setting View",["only" => "destroy"]),
        ];
    }
 
    public function index()
    {
        $branches = Branch::orderBy("created_at","DESC")->get();
        return view("setting.Branch.index",compact("branches"));
    }


    public function create()
    {
       return view("setting.Branch.create");
    }

    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required'
        ],[
            "latitude.required" => "Location Is Required Please Select Your Branch Location",
            "longtitude.required" => "Location Is Required Please Select Your Branch Location",
        ]);


        $create = Branch::create($validated_req);
        if($create){
            Toastr()->success('Branch created successfully');
            return redirect()->route("branch.index");
        }else{
            Toastr()->error('Failed to create branch');
            return redirect()->back();
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
       if(empty($id)){
            Toastr()->error('Branch not found');
            return redirect()->back();
       }


       $branch = Branch::find($id);
       if(empty($branch)){
            Toastr()->error('Branch not found');
            return redirect()->back();
       }


       return view("setting.Branch.edit",compact("branch"));


    }

  
    public function update(Request $request, string $id)
    {
        
        if(empty($id)){
            Toastr()->error('Branch not found');
            return redirect()->back();
        }
        
        $validated_req = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required'
        ],[
            "latitude.required" => "Location Is Required Please Select Your Branch Location",
            "longtitude.required" => "Location Is Required Please Select Your Branch Location",
        ]);
        $branch = Branch::find($id);
        if(empty($branch)){
            Toastr()->error('Branch not found');
            return redirect()->back();
        }
        
        
        $update = $branch->update($validated_req);
        if($update){
            Toastr()->success('Branch updated successfully');
            return redirect()->route("branch.index");
        }else{
            Toastr()->error('Failed to update branch');
            return redirect()->back();
        }


    }

   
    public function destroy(string $id)
    {
        if(empty($id)){
            Toastr()->error('Branch not found');
            return redirect()->back();
        }

        $branch = Branch::find($id);
        if(empty($branch)){
            Toastr()->error('Branch not found');
            return redirect()->back();
        }


        if($branch->delete()){
            Toastr()->success('Branch deleted successfully');
            return redirect()->route("branch.index");
        }else{
            Toastr()->error('Failed to delete branch');
            return redirect()->back();
        }
    }



    public function deleteBySelection(Request $request){

        $ids = $request->input("branch_ids");
        $branches = Branch::whereIn("id",$ids)->get();
        
        if($branches->isEmpty()){
            return response()->json(["status" => false, "message" => "Branches Not Found"]);
        }


        foreach($branches as $branch){
            $branch->delete();
        }

        return response()->json(["status" => true, "message" => "branches Has Been Deleted Succesfully"]);
        
    }
}
