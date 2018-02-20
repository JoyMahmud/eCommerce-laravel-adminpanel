<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderShippingInformations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('fax');
            $table->string('company');
            $table->string('address');
            $table->string('city');
            $table->string('post_code');
            $table->string('country');
            $table->string('state');
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
        Schema::drop('order_shipping_informations');
    }
}
