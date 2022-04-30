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

        DB::table('backdrops')->insert([
            [
                'name' => 'Coffee Shop',
                'link' => '/images/hero/coffee-4.jpg',
                'description' => 'A Sunday afternoon brew.',
                'id_drops' => 1
            ],
            [
                'name' => 'Rain drops on Car',
                'link' => '/images/hero/car-rain-1.jpg',
                'description' => 'Pitter patter of rain falling on a parked car.',
                'id_drops' => 2
            ],
            [
                'name' => 'Lunch in the Tunnels',
                'link' => '/images/hero/tunnels-1.jpg',
                'description' => 'Lunch in the Downtown tunnels.',
                'id_drops' => 3
            ],
            [
                'name' => 'Cuban / Mexican Diner',
                'link' => '/images/hero/kitchen-1.jpg',
                'description' => 'Breakfast or lunch on a sunday.',
                'id_drops' => 4
            ],
            [
                'name' => 'Shirts vs. Skins',
                'link' => '/images/hero/basketball-1.jpg',
                'description' => 'Late night pickup game.',
                'id_drops' => 5
            ],
            [
                'name' => 'Night out to Dinner',
                'link' => '/images/hero/restaurant-1.jpg',
                'description' => 'Grab a reservation and bring your appetite.',
                'id_drops' => 6
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
        Schema::drop('backdrops');
    }
}
