<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->float('regular_values');
            $table->float('retake_values');
            $table->float('recourse_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_values');
    }
}
