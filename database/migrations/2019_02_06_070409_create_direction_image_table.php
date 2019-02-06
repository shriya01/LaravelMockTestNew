<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectionImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direction_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('direction_set_id')->unsigned();
            $table->longtext('image_name');
            $table->foreign('direction_set_id')->references('id')->on('direction_set');
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
        Schema::dropIfExists('direction_image');
    }
}
