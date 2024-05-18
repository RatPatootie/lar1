<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(){
        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->unsignedinteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->integer('row');
            $table->integer('seat');
            $table->boolean('is_booked');
        });

    }
    public function down(){

        Schema::dropIfExists('seats');
    }
};
