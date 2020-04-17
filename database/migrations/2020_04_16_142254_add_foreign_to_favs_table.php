<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToFavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favs', function (Blueprint $table) {
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favs', function (Blueprint $table) {
            $table->dropForeign('user_users_foreign');
            $table->dropForeign('restaurant_restaurants_foreign');
        });
    }
}
