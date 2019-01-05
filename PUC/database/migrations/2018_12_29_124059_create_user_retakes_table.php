<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRetakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_retakes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('user_id')->on('users');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('session_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->float('final')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_retakes');
    }
}
