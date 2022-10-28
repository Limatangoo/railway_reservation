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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seat_check_id')->constrained('seat_checks')->onDelete('cascade');
            $table->foreignId('traveller_id')->constrained('travellers')->onDelete('cascade');
            $table->string('city1');
            $table->string('city2');
            $table->integer('seats_booked');
            $table->string('seatNum1');
            $table->string('seatNum2')->nullable();
            $table->string('seatNum3')->nullable();
            $table->string('seatNum4')->nullable();
            $table->string('seatNum5')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
