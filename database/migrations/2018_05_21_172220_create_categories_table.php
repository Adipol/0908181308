<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name',50)->unique();
			$table->string('description',250)->nullable();
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
        Schema::dropIfExists('categories');
    }
}
