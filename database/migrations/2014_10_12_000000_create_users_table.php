<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 50);
            $table->string('first_name', 25)->nullable();
            $table->string('last_name', 25)->nullable();
            $table->string('mobile_number', 25)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password');
            $table->string('signup_type', 25)->nullable();
            $table->date('date_of_birth')->nullable($value = true);
            $table->string('qualification')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('contact_number')->nullable();
            $table->tinyInteger('verify_email')->default(0)->comment("0=>Not verified, 1=>verified");
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_deleted')->default(0)->comment("0=>Not deleted, 1=>Deleted");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
