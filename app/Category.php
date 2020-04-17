<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['name', 'icon'];

    public function restaurantes(){
        return $this->hasMany('App\Restaurant', 'category');
    }
}
