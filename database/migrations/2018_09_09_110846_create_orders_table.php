<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id')->index();
            $table->date('order_date');
            $table->string('client_name');
            $table->string('client_contact');
            $table->string('sub_total');
            $table->string('vat');
            $table->string('total_amount');
            $table->string('discount')->default('0')->nullable();
            $table->string('grand_total');
            $table->string('paid')->default('0')->nullable();
            $table->string('due');
            $table->integer('payment_type');
            $table->integer('payment_status');
            
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
        Schema::dropIfExists('orders');
    }
}
