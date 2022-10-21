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
        Schema::create('train_routes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('route_id');
            $table->string('city1')->nullable();
            $table->string('city2')->nullable();
            $table->string('city3')->nullable();
            $table->string('city4')->nullable();
            $table->string('city5')->nullable();
            $table->string('city6')->nullable();
            $table->string('city7')->nullable();
            $table->string('city8')->nullable();
            $table->string('city9')->nullable();
            $table->string('city10')->nullable();
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
