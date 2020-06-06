<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'San Miguel de Salinas'
        ]);
    }
}
