<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function download($filename){
        return response()->download(public_path('restaurantimgs/' . $filename) , 'Restaurant Image');
    }


    //TODO AÑADIR CAMBIO DE NOMBRE DE FOTO ---> en el front se randomiza un nombre


    public function upload(Request $request){
        $imageName = $request->image->getClientOriginalName() /*. '.' . $request->image->getClientOriginalExtension()*/;
        $request->image->move(public_path('restaurantimgs'), $imageName);

    	return response()->json(['success'=>'¡Éxito!']);
    }
}
