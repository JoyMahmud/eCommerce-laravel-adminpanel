<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('root');
            $table->string('icon');
            $table->enum('main_menu', ['0', '1']);
            $table->enum('highlighted', ['0', '1']);
            $table->integer('row_order');
            $table->integer('is_group_label');
            $table->integer('category_group_id');
            $table->integer('is_tabbed');
            $table->softDeletes();
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
        Schema::drop('categories');
    }
}
