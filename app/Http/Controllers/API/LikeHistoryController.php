<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\LikeHistory;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Resources\LikeHistoryResource;

class LikeHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "nada";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "nada";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $like = json_decode($request->getContent(),true);

        if($this->esLiked($like['user'], $like['restaurant']) == 0){

        $crear = new LikeHistory();

        $crear->user = $like['user'];
        $crear->restaurant = $like['restaurant'];

        $crear->save();

        $likeado = intval($like['restaurant']);

        $restaurant = Restaurant::where('name' , $like['name'])->first();


        $numLikes = intval($restaurant['likes']);

        $numLikes++;

        $restaurant->update(array('likes' => $numLikes));

        return "Exito";
        } else{
            return "ya esta liked";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LikeHistory  $likeHistory
     * @return \Illuminate\Http\Response
     */
    public function show(LikeHistory $likeHistory)
    {
        return "nada";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LikeHistory  $likeHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(LikeHistory $likeHistory)
    {
        return "nada";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LikeHistory  $likeHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LikeHistory $likeHistory)
    {
        return "nada";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LikeHistory  $likeHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(LikeHistory $likeHistory)
    {
        return "nada";
    }

    public function esLiked($idUser , $idRest){
        //Desarrollar lógica para si hay like o no
        $respuesta = 0; //----> respuesta por defecto, no hay like, devuelve un 0

        $idUser = intval($idUser);
        $idRest = intval($idRest);

        $restaurant = LikeHistory::where('user' , intval($idUser))->where('restaurant' , intval($idRest))->first();

        if(is_object($restaurant) != null){
            $respuesta = 1; // ----> si es liked
        }

        return $respuesta;
    }

}
