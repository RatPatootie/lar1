<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(){
        Schema::create('tickets',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedinteger('user_id');
            $table->foreign('user_id')->references('id')->on('cinema_users');
            $table->unsignedinteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->integer('price');

        });
    }
    public function down(){
        if (Schema::hasTable('seats')) {
            Schema::table('seats',function(Blueprint $table){
                $table->dropForeign(['ticket_id']);
            });}
        Schema::dropIfExists('tickets');
    }
};
