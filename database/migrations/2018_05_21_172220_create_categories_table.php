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
			$table->string('name',100)->unique();
            $table->text('description')->nullable();
            $table->string('slug',100);
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
