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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('route_id')->constrained('train_routes')->onDelete('cascade');
            $table->time('city1')->nullable();
            $table->time('city2')->nullable();
            $table->time('city3')->nullable();
            $table->time('city4')->nullable();
            $table->time('city5')->nullable();
            $table->time('city6')->nullable();
            $table->time('city7')->nullable();
            $table->time('city8')->nullable();
            $table->time('city9')->nullable();
            $table->time('city10')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tables');
    }
};
