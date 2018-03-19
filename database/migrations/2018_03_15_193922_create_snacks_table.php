<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('snacks')) {
            Schema::create('snacks', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->string('snack_name');
                $table->integer('pieces');
                $table->string('description')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snacks');
    }
}
