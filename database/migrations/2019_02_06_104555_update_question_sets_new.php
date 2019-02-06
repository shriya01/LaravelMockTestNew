<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionSetsNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_sets', function ($table) {
            $table->integer('direction_set_id')->unsigned();
            $table->foreign('direction_set_id')->references('id')->on('direction_set');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_sets', function ($table) {
            $table->dropColumn('direction_set_id');
            $table->dropForeign('direction_set_id');
        });
    }
}
