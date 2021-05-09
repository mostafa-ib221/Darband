<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgcatsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('msgcats', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            //$table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->integer('unread_admin')->default(0);
            $table->integer('unread_customer')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {Schema::dropIfExists('msgcats');}
}
