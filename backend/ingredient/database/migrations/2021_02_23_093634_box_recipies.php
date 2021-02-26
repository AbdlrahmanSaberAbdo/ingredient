<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BoxRecipies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_recipies', function (Blueprint $table) {
            $table->id();
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->unsignedBigInteger('recipe_id');
            
            $table->foreign('box_id')->references('id')->on('boxes');
            $table->unsignedBigInteger('box_id');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('box_recipies');
    }
}
