<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;

use Illuminate\Http\Request;


class UserController extends Controller
{
    public function getUserInfo(){
        return auth()->user();
    }

    public function changeName(Request $request){
        $contenido = json_decode($request->getContent(),true);
        $user = User::where('id' , $contenido['id'])->first();
        $user->update(json_decode($request->getContent(), true));
        return new UserResource($user);
    }
}
