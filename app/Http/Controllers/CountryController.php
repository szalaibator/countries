<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = DB::table("countries")->get();
        return response()->json($countries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (empty($request->name))
            return response('Missing data', 400);
        $id = DB::table('countries')->insertGetId(["name" => $request->name]);
        $country = DB::table("countries")->where("id", $id)->first();
            return response("", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = DB::table("countries")->where("id", $id)->first();
        if ($country == null)
            return response("",404);
        return response()->json($country, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $country = DB::table("countries")->where("id", $id)->first();
        if ($country == null)
            return response("", 404);
        $id = DB::table("countries")->update(["name" => $request->name]);

        $country = DB::table("countries")->where("id", $id)->first();
            return response()->json($country, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = DB::table("countries")->where("id", $id)->first();
        if ($country == null)
            return response("", 404);
        DB::table("countries")->delete($id);
            return response("",204);
    }
}
