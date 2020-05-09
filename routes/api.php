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


//testeo de una ruta protegida de return de informacion de usuario
Route::middleware('auth:api')->group(function () {
    Route::get('userinfo', 'API\UserController@getUserInfo');
});

