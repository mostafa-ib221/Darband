<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('code');
            $table->text('order')->comment('order in jSon');
            $table->text('date_time')->comment('DATE - TIME');
            $table->text('address')->comment('address in jSon');
            $table->text('pey_type')->default('cash');
            $table->text('pey_status')->nullable();
            $table->text('order_no')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {Schema::dropIfExists('orders');}
}
