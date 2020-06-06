<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Category;
use App\City;
use App\Fav;
use App\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Resources\RestaurantResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restaurantes = Restaurant::orderBy('id','ASC')->paginate(6);
        //return RestaurantResource::collection($restaurantes);
        return [
            'pagination' => [
                'total' => $restaurantes->total(),
                'current_page' => $restaurantes->currentPage(),
                'per_page' => $restaurantes->perPage(),
                'last_page' => $restaurantes->lastPage(),
                'from' => $restaurantes->firstItem(),
                'to' => $restaurantes->lastpage(),
            ],
            'restaurantes' => $restaurantes

        ];
    }

    public function getAll()
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

        /*$category = Category::where('name',$restaurante['category'])->get();
        $restaurante['category'] = $category[0]->id;

        $city = City::where('name',$restaurante['city'])->get();
        $restaurante['city'] = $city[0]->id;
        */

        //comprobar existencia de imagen, si no existe moverlo a otra carpeta la imagen por defecto y hacerle copia
        if($restaurante['photo'] != null){
            $restaurante['photo'] = 'restaurantimgs/' . $restaurante['photo'];
        } else{
            $restaurante['photo'] = 'defectPhotos/defecto1.jpg';
        }

        $crear = Restaurant::create($restaurante,true);

        return new RestaurantResource($crear);

    }

    //LÓGICAS PARA BUSCAR SEGÚN: >>>>> localidad >>>> categoria >>>> nombre

    public function getLocalidades($criterio){
        //obtenemos localidad con en nombre introducido

            //
            //City::whereRaw("UPPER(name) LIKE '%'". strtoupper($criterio)."'%'")->first();

            $localidad = City::where('name',$criterio)->first();

            if($localidad['id'] != null){
                $restaurantes = Restaurant::where('city',$localidad['id'])->get();

                return $restaurantes;
            } else{
                return "no";
            }


    }
    public function getCategorias($criterio){
        $categoria = Category::where('name',$criterio)->first();

        if($categoria['id'] != null){
            $categorias = Restaurant::where('category',$categoria['id'])->get();

            return $categorias;
        } else{
            return "no";
        }
    }
    public function getNombres($criterio){
        return Restaurant::where('name',$criterio)->get();
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

    public function esFav($idUser , $idRest){
        //Desarrollar lógica para si hay fav o no
        $respuesta = 0; //----> respuesta por defecto, no hay fav, devuelve un 0

        $favorito = Fav::where('user' , $idUser)->where('restaurant' , $idRest)->first();

        if(is_object($favorito)){
            $respuesta = 1; // ----> si es fav
        }

        return $respuesta;
    }

    public function commentsGet($idRest){
        $comment = Comment::where('restaurant' , $idRest)->get();
        return CommentResource::collection($comment);
    }
}
