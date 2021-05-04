<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function(Blueprint $table){
            $table->increments('id'); 
            $table->string('make', 64);
            $table->string('model', 128); // According to Google the longest car name is 66 chars.. lets give a bit of extra incase someone fancies a bit of one-upmanship.`
            $table->timestamp('build_date');
            $table->integer('colour_id')->unsigned();

            $table->foreign('colour_id', 'fk_car_colour')
                ->references('id')
                ->on('colours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
