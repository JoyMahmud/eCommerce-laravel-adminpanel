<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideshowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slideshows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text_line_one');
            $table->string('text_line_two');
            $table->string('text_line_three');
            $table->string('text_line_one_color');
            $table->string('text_line_two_color');
            $table->string('text_line_three_color');

            $table->integer('category_id');
            $table->integer('product_id');
            $table->string('image');
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
        Schema::drop('slideshows');
    }
}
