<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWiresTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('wires', function (Blueprint $table) {
            $table->id();
            $table->string('cat');
            $table->string('code');
            $table->string('title');
            $table->text('des');
            $table->text('tables');
            $table->string('pic');
            $table->tinyInteger('is_rtl', 1)->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {Schema::dropIfExists('wires');}
}
