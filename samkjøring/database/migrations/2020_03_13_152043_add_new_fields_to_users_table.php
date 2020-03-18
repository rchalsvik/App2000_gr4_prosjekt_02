<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->renameColumn('name', 'firstname');
          $table->string('lastname');
          $table->char('phone', 8);
          $table->string('address');
          $table->char('zipcode', 4);
          $table->date('date_of_birth');
          $table->boolean('hasLicense')->default($value = false);

          $table->index('lastname', 'firstname');
          //$table->foreign('zipcode')->references('zipcode')->on('county');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname', 'name');
            $table->dropColumn('lastname');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('zipcode');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('hasLicense');
        });
    }
}
