<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'posted_at' , 'restaurant' , 'user'];

    public function restaurantObject()
    {
        return $this->belongsTo('App\Restaurant', 'restaurant');
    }
    public function userObject()
    {
        return $this->belongsTo('App\User', 'user');
    }
}
