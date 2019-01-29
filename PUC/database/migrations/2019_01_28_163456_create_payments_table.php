<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('user_id')->on('users');
            $table->string('client_id');
            $table->integer('session_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->string('reference');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
