<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxMarksToMockTests extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('mock_tests', function ($table) {
            $table->integer('max_marks')->after('max_time');
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
            $table->dropColumn('max_marks');
        });
    }
}
