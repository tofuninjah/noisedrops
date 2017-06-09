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
                'name' => 'Coffee Shop',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/coffee.shop1.mp3'
            ],
            [
                'name' => 'Raindrops on Car',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/raindrops-in-car.mp3'
            ],
            [
                'name' => 'Lunch in the Tunnels',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/tunnels.lunch.mp3'
            ],
            [
                'name' => 'Cuban / Mexican Diner',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/cuban-mexican-diner.mp3'
            ],
            [
                'name' => 'Shirts vs. Skins',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/basketball.mp3'
            ],
            [
                'name' => 'Night out to Dinner',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/houstons.mp3'
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
