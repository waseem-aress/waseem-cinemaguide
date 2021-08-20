<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session__times', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->integer('cinema_id')->references('id')->on('cinemas')->onDelete('cascade');
            $table->dateTime('date_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session__times');
    }
}
