<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('pic');
            $table->string('price');
            $table->timestamps();
        });

        /*Schema::create('catfood_food', function (Blueprint $table) {
            $table->unsignedBigInteger('catfood_id')->index()->nullable();
            $table->foreign('catfood_id')
                ->references('id')
                ->on('catfood')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('food_id')->index()->nullable();
            $table->foreign('food_id')
                ->references('id')
                ->on('food')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('food');
    }
}
