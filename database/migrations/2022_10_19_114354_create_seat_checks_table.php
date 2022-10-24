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
        Schema::create('seat_checks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('route_id')->constrained('train_routes')->onDelete('cascade');
            $table->foreignId('train_id')->constrained('train_details')->onDelete('cascade');
            $table->date('date');
            $table->integer('city1')->nullable();
            $table->integer('city2')->nullable();
            $table->integer('city3')->nullable();
            $table->integer('city4')->nullable();
            $table->integer('city5')->nullable();
            $table->integer('city6')->nullable();
            $table->integer('city7')->nullable();
            $table->integer('city8')->nullable();
            $table->integer('city9')->nullable();
            $table->integer('city10')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_checks');
    }
    
};
