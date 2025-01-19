<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            //$table->id();
            $table->string('product_id')->unique()->primary();
            $table->string('name',255);
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->text('description');
            $table->string('image')->default('');
            $table->integer('discount')->default('0');
            $table->integer('category_id');
            $table->tinyInteger('is_sales')->default(1)->comment('0 : Dừng bán hoặc dừng sản xuất  , 1: Có hàng bán');
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
        Schema::dropIfExists('product');
    }
}
