<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackdropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('backdrops');

        Schema::create('backdrops', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name', 250);
            $table->string('link', 250);
            $table->text('description')->nullable();
            $table->integer('id_drops')->unsigned();
            $table->foreign('id_drops')->references('id')->on('drops');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('backdrops');
    }
}
