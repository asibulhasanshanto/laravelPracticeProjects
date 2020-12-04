<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('card_num');
            $table->integer('card_exp_month');
            $table->year('card_exp_year');
            $table->integer('card_cvv');
            $table->string('item_name');
            $table->string('item_number');
            $table->float('item_price');
            $table->string('currency');
            $table->string('paid_amount');
            $table->string('order_number');
            $table->string('txn_id');
            $table->string('payment_status');
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
        Schema::dropIfExists('payments');
    }
}
