<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->unsignedinteger('hall_number');
            $table->foreign('hall_number')->references('id')->on('halls');
            $table->time('start_time');
            $table->date('date_of_session');
            $table->timestamps();
        });
    }

    public function down()
    {
        if (Schema::hasTable('tickets')) {
        Schema::table('tickets',function(Blueprint $table){
            $table->dropForeign(['session_id']);
        });}
        if (Schema::hasTable('seats')) {
            Schema::table('seats',function(Blueprint $table){
                $table->dropForeign(['session_id']);
            });}
        Schema::dropIfExists('sessions');
    }
};
