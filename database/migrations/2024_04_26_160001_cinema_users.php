<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(){
        Schema::create('cinema_users',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->date('birth_day');
            $table->string('email');
            $table->string('password');
        });
    }
    public function down(){
        if (Schema::hasTable('tickets')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });}
        Schema::dropIfExists('cinema_users');
    }
};
