<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('customer_id')->unique()->primary();
            $table->string('name',255);
            $table->string('email',50)->unique();
            $table->string('phone_number',20);
            $table->string('password',255);
            $table->tinyInteger('is_active')->default(1)->comment('0: Không hoạt động, 1: Hoạt động')->nullable();
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
        Schema::dropIfExists('customer');
    }
}
