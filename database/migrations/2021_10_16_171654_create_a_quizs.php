<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAQuizs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_quizs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_question')->unsigned();
            $table->foreign('id_question')->references('id')
                ->on('questions')
                ->cascadeOnDelete();
            $table->text('plan');
            $table->boolean('res')->default(false);
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
        Schema::dropIfExists('a_quizs');
    }
}