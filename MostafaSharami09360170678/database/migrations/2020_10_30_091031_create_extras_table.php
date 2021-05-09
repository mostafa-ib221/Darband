<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('extras', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('price');
            $table->timestamps();
        });

        Schema::create('dish_extra', function (Blueprint $table) {
            $table->unsignedBigInteger('dish_id')->index()->nullable();
            $table->foreign('dish_id')
                ->references('id')
                ->on('dishes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('extra_id')->index()->nullable();
            $table->foreign('extra_id')
                ->references('id')
                ->on('extras')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('dish_extra');
        Schema::dropIfExists('extras');
    }
}
