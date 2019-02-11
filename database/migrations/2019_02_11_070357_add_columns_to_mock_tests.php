<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToMockTests extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('mock_tests', function ($table) {
            $table->tinyInteger('is_switchable')->after('max_marks');
            $table->decimal('negative_marks',3,3)->after('is_switchable');
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
            $table->dropColumn('is_switchable');
            $table->dropColumn('negative_marks');
        });
    }
}
