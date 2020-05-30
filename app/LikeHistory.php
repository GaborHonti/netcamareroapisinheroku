<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeHistory extends Model
{

    protected $table = "likehistory";

    protected $fillable = ['user', 'restaurant'];

    public function restaurantObject()
    {
        return $this->belongsTo('App\Restaurant', 'restaurant');
    }
    public function userObject()
    {
        return $this->belongsTo('App\User', 'user');
    }
}
