<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmtBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmt_blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('id_blog')->unsigned()->nullable();
            $table->foreign('id_blog')->references('id')->on('blogs')->cascadeOnDelete();
            $table->integer('id_cmt')->unsigned()->nullable();
            $table->foreign('id_cmt')->references('id')->on('cmt_blogs')->cascadeOnDelete();
            $table->string('content');
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
        Schema::dropIfExists('cmt_blogs');
    }
}
