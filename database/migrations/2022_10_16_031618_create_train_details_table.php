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
        Schema::create('train_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('train_id');
            $table->integer('class1')->nullable();
            $table->integer('class2')->nullable();
            $table->integer('class3')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('train_details');
    }
};
