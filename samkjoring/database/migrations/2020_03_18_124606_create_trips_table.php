<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trips', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('driver_id'); // Denne her må være en 'unsigned' for å ikke tillate minus verdier
      $table->string('start_point');
      $table->string('end_point');
      $table->date('start_date');
      $table->date('end_date');
      $table->time('start_time');
      $table->time('end_time');
      $table->unsignedTinyInteger('seats_available'); // Denne her må være en 'unsigned' for å ikke tillate minus verdier
      $table->string('car_description');
      $table->text('trip_info');
      $table->boolean('pets_allowed')->default(false); // false uten herme/gåseteikn!
      $table->boolean('kids_allowed')->default(false); // false uten herme/gåseteikn!
      $table->timestamps();
      $table->foreign('driver_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::dropIfExists('trips');
  }
}
