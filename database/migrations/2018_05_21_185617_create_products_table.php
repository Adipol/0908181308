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
			$table->increments('id');

			$table->unsignedInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories');

			$table->unsignedInteger('unit_id');
			$table->foreign('unit_id')->references('id')->on('units');

			$table->string('name',50)->unique();
			$table->string('description',250)->nullable();
			$table->integer('stock');
			$table->boolean('condition')->default(1);
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
        Schema::dropIfExists('products');
    }
}
