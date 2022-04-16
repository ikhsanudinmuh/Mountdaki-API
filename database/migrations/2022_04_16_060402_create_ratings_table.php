<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('climbing_registration_id')->unsigned();
            $table->integer('mountain_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('review');
            $table->float('rate');
            $table->timestamps();

            $table->foreign('climbing_registration_id')->references('id')->on('climbing_registrations');
            $table->foreign('mountain_id')->references('id')->on('mountains');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};
