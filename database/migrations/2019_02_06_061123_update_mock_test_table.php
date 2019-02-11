<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMockTestTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('mock_tests', function ($table) {
            $table->integer('max_time')->after('max_question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mock_tests', function ($table) {
            $table->dropColumn('max_time');
        });
    }
}
