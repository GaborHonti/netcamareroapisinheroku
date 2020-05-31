<?php

namespace App\Http\Controllers\API;

use App\Fav;
use App\User;
use App\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FavResource;

class FavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FavResource::collection(Fav::all());
    }
    public function getMyFavs($id)
    {
        return FavResource::collection(Fav::where('user' , $id)->get());
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
        $fav = json_decode($request->getContent(),true);
        /*
        $restaurant = Restaurant::where('name',$fav['restaurant'])->get();
        $fav['restaurant'] = $restaurant[0]->id;

        $user = User::where('name',$fav['user'])->get();
        $fav['user'] = $user[0]->id;
        */
        $crear = Fav::create($fav,true);

        return new FavResource($crear);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fav  $fav
     * @return \Illuminate\Http\Response
     */
    public function show(Fav $fav)
    {
        return new FavResource($fav);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fav  $fav
     * @return \Illuminate\Http\Response
     */
    public function edit(Fav $fav)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fav  $fav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fav $fav)
    {
        $fav->update(json_decode($request->getContent(), true));
        return new FavResource($fav);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fav  $fav
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fav $fav)
    {
        if($fav->delete()){
            return "Se ha borrado con éxito";
        }
    }

    public function borraFav($idUser,$idRest){
        $fav = Fav::where('user' , $idUser)->where('restaurant' , $idRest)->first();

        if($fav->delete()){
            return "Se ha borrado con éxito";
        }
    }
}
