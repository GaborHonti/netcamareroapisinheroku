<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CityResource::collection(City::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = json_decode($request->getContent(),true);


        $crear = City::create($city,true);

        return new CityResource($crear);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $city->update(json_decode($request->getContent(), true));
        return new CityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if($city->delete()){
            return "Se ha borrado con éxito";
        }
    }
}
