<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMockTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mock_tests', function (Blueprint $table) {
            $table->increments('test_id');
            $table->integer('section_id')->unsigned();
            $table->integer('examination_id')->unsigned();
            $table->string('test_name');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('examination_id')->references('id')->on('examinations');
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
        Schema::dropIfExists('mock_tests');
    }
}
