<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function getUserInfo(){
        return auth()->user();
    }
}