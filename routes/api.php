<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//---------------------------------------RUTAS GET, PÚBLICAS -----------------------------------------------------------------------------------

Route::get('restaurantsAll', 'API\RestaurantController@getAll');
Route::get('downloadFile/{filename}' , 'API\FileController@download');
//Rutas para buscar restaurantes segun: >>>>> localidad >>>> categoria >>>> nombre
Route::get('localidad/{criterio}', 'API\RestaurantController@getLocalidades');
Route::get('categoria/{criterio}', 'API\RestaurantController@getCategorias');
Route::get('nombre/{criterio}', 'API\RestaurantController@getNombres');
//ruta para cargar los comentarios de un restaurante en concreto
Route::get('restaurants/comments/{idRest}' , 'API\RestaurantController@commentsGet');

//---------------------------------------RUTAS POST PÚBLICAS
Route::post('/registro', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

//rutas protegidas--------------->FALTA AÑADIR RUTAS DE POST, PUT Y DELETE DE LOS APIRESOURCE
Route::middleware('auth:api')->group(function () {
    Route::get('userinfo', 'API\UserController@getUserInfo');
    Route::get('myFavs/{id}', 'API\FavController@getMyFavs');
    Route::put('cambianombre', 'API\UserController@changeName');
    Route::post('/restaurants/like', 'API\LikeHistoryController@store');
    Route::post('uploadFile' , 'API\FileController@upload');
    //ruta para obtener si un restaurante es fav o no
    Route::get('restaurants/esFav/{idUser}/{idRest}' , 'API\RestaurantController@esFav');
    //ruta para obtener si hay like o no
    Route::get('restaurants/esLike/{idUser}/{idRest}' , 'API\LikeHistoryController@esLiked');
    //ruta para borrar fav
    Route::delete('restaurants/borraFav/{idUser}/{idRest}' , 'API\FavController@borraFav');

    Route::apiResource('restaurants', 'API\RestaurantController');

    Route::apiResource('categories', 'API\CategoryController');

    Route::apiResource('cities', 'API\CityController');

    Route::apiResource('comments', 'API\CommentController');

    Route::apiResource('favs', 'API\FavController');

});

//APIresource rutas get publicas
Route::get('restaurants' ,  'API\RestaurantController@index');
Route::get('categories' ,  'API\CategoryController@index');
Route::get('cities' ,  'API\CityController@index');
Route::get('comments' ,  'API\CommentController@index');
Route::get('favs' ,  'API\FavController@index');

Route::get('restaurants/{restaurant}' ,  'API\RestaurantController@show');
Route::get('categories/{category}' ,  'API\CategoryController@show');
Route::get('cities/{city}' ,  'API\CityController@show');
Route::get('comments/{comment}' ,  'API\CommentController@show');
Route::get('favs/{fav}' ,  'API\FavController@show');
