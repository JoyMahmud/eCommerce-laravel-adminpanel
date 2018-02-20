<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->string('model');
            $table->string('sku');
            $table->string('upc');
            $table->string('mpn');
            $table->string('isbn');
            $table->string('location');
            $table->decimal('price');
            $table->string('color');
            $table->string('quantity');
            $table->string('minimum_quantity');
            $table->enum('stock_status', ['in_stock', 'out_of_stock','pre-order'])->default('in_stock');
            $table->string('front_image');
            $table->string('details_image');
            $table->string('date_available');
            $table->string('dimension_length')->nullable();
            $table->string('dimension_width')->nullable();
            $table->string('dimension_height')->nullable();
            $table->integer('length_class');
            $table->string('weight');
            $table->integer('weight_class');
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('manufacturer_id');
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('discount');
            $table->string('expire_date')->nullable();
            $table->integer('special_offer_id');
            $table->integer('reward_point');
            $table->enum('hot_label', ['0', '1'])->default('0');
            $table->enum('new_label', ['0', '1'])->default('0');
            $table->enum('is_homepage', ['0', '1'])->default('0');
            $table->enum('is_featured', ['0', '1'])->default('0');
            $table->enum('is_taxable', ['0', '1'])->default('0');
            $table->enum('is_pre_order', ['0', '1'])->default('0');
            $table->string('pre_order_amount');
            $table->string('tax_amount');
            $table->string('meta_tag_description');
            $table->string('meta_keyword_description');
            $table->string('seo_keyword');
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
        Schema::drop('products');
    }
}
