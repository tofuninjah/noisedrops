<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('drops');

        Schema::create('drops', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name', 250);
            $table->string('filename', 250);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('drops')->insert([
            [
                'name' => 'Tunnels Lunch',
                'filename' => 'raindrops-in-car.mp3'
            ],
            [
                'name' => 'Raindrops on Car',
                'filename' => 'tunnels.lunch.mp3'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('drops');
    }
}
