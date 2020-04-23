<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('passengers', function (Blueprint $table) {
        $table->unsignedBigInteger('trip_id');
        $table->unsignedBigInteger('passenger_id');
        $table->unsignedTinyInteger('seats_requested');
        $table->timestamps();

        $table->primary(['trip_id', 'passenger_id']);
        $table->foreign('trip_id')->references('id')->on('trips');
        $table->foreign('passenger_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
