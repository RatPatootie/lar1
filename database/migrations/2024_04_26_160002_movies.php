<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->date('release_date');
            $table->integer('duration_minutes');
            $table->string('poster_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        if (Schema::hasTable('sessions')) {
           Schema::table('sessions',function(Blueprint $table){
               $table->dropForeign(['movies_id']);
           });
        }
        Schema::dropIfExists('movies');
    }
};
/*
return new class extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned();
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->integer('start_time');
            $table->integer('hall_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
return new class extends Migration {
    public function up (){
        Schema::create('hall',function(Blueprint $table){
            $table->increment('id');
            $table->foreign('id')->reference('hall_number')->on('session');
            $table->string('description');
            $table->integer('row');
            $table->integer('seat');


        });
    }
    public function down(){
        Schema::dropIfExist('hall');
    }
}
return new class extends Migration {
    public function up(){
        Schema::create('seats',function(Blueprint $table){
            $table->increment('id');
            $table->integer('hall_id');
            $table->foreign('hall_id')->reference('id')->on('hall');
            $table->integer('row');
            $table->integer('seat');
            $table->boolean('is_booked');
        });
    }
    public function down(){
        Schema::dropIfExist('seats');
    }
}
return new class extends Migration {
    public function up(){
        Schema::create('ticket',function(Blueprint $table){
            $table->increment('id');
            $table->integer('user_id');
            $table->foreign('user_id')->reference('id')->on('user');
            $table->integer('session_id');
            $table->foreign('session_id')->reference('id')->on('session');
            $table->integer('seat_number');
            $table->integer('price');
            $table->boolean('is_booked');
        });
    }
    public function down(){
        Schema::dropIfExist('ticket');
    }
}
return new class extends Migration{
    public function up(){
        Schema::create('user',function(Blueprint $table){
            $table->increment('id');
            $table->string('name');
            $table->date('birth_day');
            $table->varchar('email');
            $table->bcrypt('password');
        });
    }
    public function down(){
        Schema::dropIfExist('user');
    }
} */
