<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('duration')->nullable();
            $table->string('video')->nullable();
            $table->string('pdf')->nullable();
            $table->foreignId('quiz_id')->nullable();
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
        Schema::dropIfExists('sub_lessons');
    }
}
