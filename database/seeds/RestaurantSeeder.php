<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            'name' => 'Oneils English Pub',
            'photo' => 'restaurantimgs/oneils.jpg',
            'city' => 1,
            'category' => 1,
            'likes' => 0,
            'phonenumber' => 693746840,
            'description' => 'soy el primer restaurante de esta pagina',
            'latitud' => 37.976483,
            'longitud' =>  -0.793203,
        ]);
    }
}
