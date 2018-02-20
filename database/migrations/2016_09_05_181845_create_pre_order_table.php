<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->integer('area_id');
            $table->string('price');
            $table->string('pre_order_amount');
            $table->string('shipping_payable');
            $table->enum('booking_payment', ['cash', 'online']);
            $table->enum('booking-payment_status', ['pending', 'complete','verification']);
            $table->integer('payment_activity_id');
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
        Schema::drop('pre_order');
    }
}
