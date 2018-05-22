<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_details', function (Blueprint $table) {
			$table->increments('id');

			$table->unsignedInteger('income_id');
			$table->foreign('income_id')->references('id')->on('incomes');

			$table->unsignedInteger('product_id');
			$table->foreign('product_id')->references('id')->on('products');

			$table->integer('quantity');
			$table->timestamps();
			$table->integer('ucm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_details');
    }
}
