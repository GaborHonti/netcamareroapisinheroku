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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('restaurants', 'API\RestaurantController');

Route::get('restaurantsAll', 'API\RestaurantController@getAll');

Route::apiResource('categories', 'API\CategoryController');

Route::apiResource('cities', 'API\CityController');

Route::apiResource('comments', 'API\CommentController');

Route::apiResource('favs', 'API\FavController');

Route::post('/registro', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');


//rutas protegidas
Route::middleware('auth:api')->group(function () {
    Route::get('userinfo', 'API\UserController@getUserInfo');
    Route::get('myFavs/{id}', 'API\FavController@getMyFavs');
});

//rutas para descargar y subir fotos de restaurantes
Route::get('downloadFile/{filename}' , 'API\FileController@download');
Route::post('uploadFile' , 'API\FileController@upload');

//ruta para obtener si un restaurante es fav o no
Route::get('restaurants/esFav/{idUser}/{idRest}' , 'API\RestaurantController@esFav');

//Rutas para buscar restaurantes segun: >>>>> localidad >>>> categoria >>>> nombre
Route::get('localidad/{criterio}', 'API\RestaurantController@getLocalidades');
Route::get('categoria/{criterio}', 'API\RestaurantController@getCategorias');
Route::get('nombre/{criterio}', 'API\RestaurantController@getNombres');


