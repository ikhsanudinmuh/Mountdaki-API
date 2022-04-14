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
        Schema::create('climbing_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mountain_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('identity_card');
            $table->text('healthy_letter');
            $table->date('schedule')->format('Y/m/d');
            $table->enum('status', ['pending', 'declined', 'approved', 'climbing', 'done'])->default('pending');
            $table->timestamps();

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
        Schema::dropIfExists('climbing_registrations');
    }
};
