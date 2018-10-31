<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id')->index();
            $table->string('product_name');
            $table->string('product_code')->unique();
            $table->string('product_quantity');
            $table->string('product_rate');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('category_id');
            $table->string('product_image');
            $table->integer('product_status');
            
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
