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
            $table->string('image', 250);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('drops')->insert([
            [
                'name' => 'Coffee Shop',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/coffee.shop1.mp3',
                'image' => '/images/hero/coffee-1.jpg'
            ],
            [
                'name' => 'Raindrops on Car',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/raindrops-in-car.mp3',
                'image' => '/images/hero/car-rain-1.jpg'
            ],
            [
                'name' => 'Lunch in the Tunnels',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/tunnels.lunch.mp3',
                'image' => '/images/hero/tunnels-1.jpg'
            ],
            [
                'name' => 'Cuban / Mexican Diner',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/cuban-mexican-diner.mp3',
                'image' => '/images/hero/kitchen-1.jpg'
            ],
            [
                'name' => 'Shirts vs. Skins',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/basketball.mp3',
                'image' => '/images/hero/basketball-1.jpg'
            ],
            [
                'name' => 'Night out to Dinner',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/houstons.mp3',
                'image' => '/images/hero/restaurant-1.jpg'
            ],
            [
                'name' => 'Sunday night laundry',
                'filename' => 'https://s3-us-west-2.amazonaws.com/noisedrops/laundryday.mp3',
                'image' => '/images/hero/laundromat.jpeg'
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
