<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CurrencyController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware("permission:Settings View", ["only" => "index"]),
            new Middleware("permission:Settings View", ["only" => "create", "store"]),
            new Middleware("permission:Settings View", ["only" => "Edit", "update"]),
            new Middleware("permission:Settings View", ["only" => "destroy", "deletebyselection"]),
        ];
    }

    public function index()
    {
        $currencies = Currency::orderby("created_at", "DESC")->get();

        return view("setting.Currencies.index", compact("currencies"));
    }

    public function create()
    {
        return view("setting.Currencies.create");
    }


    public function store(Request $request)
    {
        $validated_req = $request->validate([
            'currency_name' => 'required',
            'currency_symbol' => 'required|max:6'
        ], [
            'currency_symbol.max' => 'currency Symbol Must Be Valid'
        ]);


        $create = Currency::create($validated_req);
        if ($create) {
            Toastr()->success("Currency Created Successfully");
            return redirect()->route("currency.index");
        } else {
            Toastr()->error("Failed to create Currency");
            return redirect()->back();
        }
    }


    public function edit(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Currency not found');
            return redirect()->back();
        }

        $currency = Currency::find($id);
        if (empty($currency)) {
            Toastr()->error('Currency not found');
            return redirect()->back();
        }

        return view("setting.Currencies.edit", compact("currency"));
    }
    public function update(Request $request, string $id)
    {


        if (empty($id)) {
            Toastr()->error('Currency not found');
            return redirect()->back();
        }

        $validated_req = $request->validate([
            'currency_name' => 'required',
            'currency_symbol' => 'required|max:6'
        ], [
            'currency_symbol.max' => 'currency Symbol Must Be Valid'
        ]);


        $currency = Currency::find($id);
        if (empty($currency)) {
            Toastr()->error('Currency not found');
            return redirect()->back();
        }

        if ($currency->update($validated_req)) {
            Toastr()->success("Currency Updated Successfully");
            return redirect()->route("currency.index");
        } else {
            Toastr()->error("Failed to update Currency");
            return redirect()->back();
        }
    }


    public function destroy(string $id)
    {
        if (empty($id)) {
            Toastr()->error('Currency not found');
            return redirect()->back();
        }

        $currency = Currency::find($id);
        if (empty($currency)) {
            Toastr()->error('Currency not found');
            return redirect()->back();
        }

        if ($currency->delete()) {
            Toastr()->success('Currency deleted successfully');
            return redirect()->route("currency.index");
        } else {
            Toastr()->error('Failed to delete currency');
            return redirect()->back();
        }
    }

    public function deletebyselection(Request $request)
    {
        $ids = $request->input("currency_ids");

        $currencies = Currency::whereIn("id", $ids)->get();
        if ($currencies->isEmpty()) {
            return response()->json(["status" => false, "message" => "Currencies Not Found"]);
        }

        foreach ($currencies as $currency) {
            $currency->delete();
        }

        return response()->json(["status" => true, "message" => "Currencies deleted successfully"]);
    }
}
