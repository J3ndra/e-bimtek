<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->text('n_import_font')->nullable();
            $table->string('n_horizontal')->nullable();
            $table->integer('n_vertical')->unsigned()->nullable();
            $table->integer('n_margin_right')->default(0)->unsigned()->nullable();
            $table->integer('n_margin_left')->default(0)->unsigned()->nullable();
            $table->string('n_font_style')->nullable();
            $table->string('n_font_size')->nullable();
            $table->text('d_import_font')->nullable();
            $table->string('d_horizontal')->nullable();
            $table->integer('d_vertical')->unsigned()->nullable();
            $table->integer('d_margin_right')->default(0)->unsigned()->nullable();
            $table->integer('d_margin_left')->default(0)->unsigned()->nullable();
            $table->string('d_font_style')->nullable();
            $table->string('d_font_size')->nullable();

            $table->integer('is_active')->default(0)->unsigned()->nullable();
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
        Schema::dropIfExists('designs');
    }
}
