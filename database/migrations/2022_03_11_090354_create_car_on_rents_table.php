<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarOnRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_on_rents', function (Blueprint $table) {
            $table->id();
            $table->string('cityName');
            $table->string('carName');
            $table->string('bookingDate');
            $table->string('bookingType');
            $table->string('halfDay');
            $table->string('hourly');
            $table->string('fromTime');
            $table->string('toTime');
            $table->string('destination');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_on_rents');
    }
}
