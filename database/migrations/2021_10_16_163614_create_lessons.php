<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->integer('id_chapter')->unsigned();
            $table->foreign('id_chapter')->references('id')->on('chapters')->cascadeOnDelete();

            $table->integer('id_lesson')->unsigned()->nullable();
            $table->foreign('id_lesson')->references('id')->on('lessons')->cascadeOnDelete();
            
            $table->mediumText('name');
            $table->string('video')->nullable();
            $table->text('content');
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
        Schema::dropIfExists('lessons');
    }
}
