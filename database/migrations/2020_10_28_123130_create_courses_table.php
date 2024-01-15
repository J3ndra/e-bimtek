<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('trailer')->nullable();
            $table->string('duration')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->float('price', 13, 2);
            $table->boolean('is_draft')->default(1);
            $table->foreignId('category_id')->nullable();
            $table->foreignId('team_id')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
