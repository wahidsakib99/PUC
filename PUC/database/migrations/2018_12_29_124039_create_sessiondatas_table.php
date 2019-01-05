<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessiondatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessiondatas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('user_id')->on('users');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters');
            /* 
                `type` = 0 regular
                `type` = 1 retake
                `type` = 2 recourse 
            */
            $table->integer('type');

            $table->integer('session_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->boolean('pending');
            $table->float('attendance')->nullable();
            $table->float('rora')->nullable();//Report or Assignment
            $table->float('ct')->nullable();
            $table->float('mid')->nullable();
            $table->float('final')->nullable();
            $table->string('grade')->nullable();
            $table->float('cgpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessiondatas');
    }
}
