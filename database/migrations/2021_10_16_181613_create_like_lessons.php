<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('id_lesson')->unsigned()->nullable();
            $table->foreign('id_lesson')->references('id')->on('lessons')->cascadeOnDelete();
            $table->integer('id_cmt')->unsigned()->nullable();
            $table->foreign('id_cmt')->references('id')->on('cmt_lessons')->cascadeOnDelete();
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
        Schema::dropIfExists('like_lessons');
    }
}
