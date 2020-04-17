<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

    protected $fillable = ['name', 'phonenumber', 'photo', 'description', 'city' , 'category' , 'likes'];

    public function categoriaObject()
    {
        return $this->belongsTo('App\Category', 'category');
    }
    public function ciudadObject()
    {
        return $this->belongsTo('App\City', 'city');
    }

    public function comments(){
        return $this->hasMany('App\Comments', 'restaurant');
    }
    public function favs(){
        return $this->hasMany('App\Fav', 'restaurant');
    }
}
