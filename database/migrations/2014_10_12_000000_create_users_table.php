<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('password');
            $table->string('username');
            $table->enum('gender', ['male', 'female']);
            $table->bigInteger('national_id');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('image');
            $table->string('city');
            $table->string('street');
            // $table->string('overview')->nullable();
            $table->string('job');
            $table->string('university');
            $table->string('specialization');
            $table->string('experience');
            $table->integer('rate');
            $table->string('credit');
            $table->enum('type', ['developer', 'client']);
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
