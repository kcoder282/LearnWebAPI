<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regis_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('id_course');
            $table->foreign('id_course')->references('id')->on('courses')->cascadeOnDelete();           
            $table->tinyInteger("evaluate")->nullable();
            $table->integer("sumpoint")->default(0);
            $table->primary(['id_user', 'id_course']);
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

        Schema::dropIfExists('regis_courses');
    }
}
