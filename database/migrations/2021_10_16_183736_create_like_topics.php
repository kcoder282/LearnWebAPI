<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_topics', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('id_topic')->unsigned()->nullable();
            $table->foreign('id_topic')->references('id')->on('topics')->cascadeOnDelete();
            $table->integer('id_cmt')->unsigned()->nullable();
            $table->foreign('id_cmt')->references('id')->on('cmt_topics')->cascadeOnDelete();
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
        Schema::dropIfExists('like_topics');
    }
}
