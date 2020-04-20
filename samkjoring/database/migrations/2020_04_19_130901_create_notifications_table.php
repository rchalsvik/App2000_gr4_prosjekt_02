<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
          $table->unsignedBigInteger('trip_id');
          $table->unsignedBigInteger('user_id');
          $table->string('start_point');
          $table->string('end_point');
          $table->unsignedBigInteger('type_id');
          $table->timestamps();


          $table->primary(['trip_id', 'user_id']);
          $table->foreign('trip_id')->references('id')->on('trips');
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('type_id')->references('id')->on('notification_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
