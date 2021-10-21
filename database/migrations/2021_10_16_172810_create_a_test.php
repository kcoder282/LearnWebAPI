<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateATest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_test', function (Blueprint $table) {
            $table->id();
            $table->integer('id_question')->unsigned();
            $table->foreign('id_question')->references('id')->on('questions')->cascadeOnDelete();
            $table->string('input');
            $table->string('output');
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
        Schema::dropIfExists('a_test');
    }
}
