<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.home');
});

Route::get('/crudmenu', function () {
    return view('crud.crudmenu');
});

Route::get('/restaurants' , function(){
    return view('vueRestaurants.index');
});

Route::get('/restaurants/{id}' , function($id){
    return view('vueRestaurants.show', compact('id'));
});
