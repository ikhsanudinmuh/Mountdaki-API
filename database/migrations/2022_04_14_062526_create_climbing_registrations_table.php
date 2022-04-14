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
            $table->integer('mountain_id');
            $table->integer('user_id');
            $table->text('identitiy_card');
            $table->text('healthy_letter');
            $table->date('schedule')->format('Y/m/d');
            $table->enum('status', ['pending', 'approved', 'climbing', 'done'])->default('pending');
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
        Schema::dropIfExists('climbing_registrations');
    }
};
