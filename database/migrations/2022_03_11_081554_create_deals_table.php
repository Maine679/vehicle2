<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('salesman_id');
            $table->foreign('salesman_id')->on('users')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->on('users')->references('id')->onDelete('cascade');

            $table->integer('price');
            $table->integer('mileage');

            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->on('vehicles')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('deals');
    }
}
