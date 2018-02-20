<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->string('tran_id');
            $table->string('val_id')->nullable();
            $table->string('store_amount')->nullable();
            $table->string('error')->nullable();
            $table->string('status');
            $table->string('bank_tran_id');
            $table->string('currency');
            $table->string('tran_date');
            $table->string('amount');
            $table->string('card_type');
            $table->string('card_no');
            $table->string('card_issuer');
            $table->string('card_brand');
            $table->string('card_issuer_country');
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
        Schema::drop('payment_activities');
    }
}
