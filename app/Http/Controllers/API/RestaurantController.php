<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Category;
use App\City;
use App\Http\Resources\RestaurantResource;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestaurantResource::collection(Restaurant::all());
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
        $restaurante = json_decode($request->getContent(),true);

        $category = Category::where('name',$restaurante['category'])->get();
        $restaurante['category'] = $category[0]->id;

        $city = City::where('name',$restaurante['city'])->get();
        $restaurante['city'] = $city[0]->id;

        $crear = Restaurant::create($restaurante,true);

        return new RestaurantResource($crear);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return new RestaurantResource($restaurant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->update(json_decode($request->getContent(), true));
        return new RestaurantResource($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if($restaurant->delete()){
            return "Se ha borrado con éxito";
        }
    }
}
