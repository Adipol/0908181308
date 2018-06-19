<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJustificationOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justification_output', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('justification_id');
            $table->foreign('justification_id')->references('id')->on('justifications');
            $table->unsignedInteger('output_id');
            $table->foreign('output_id')->references('id')->on('outputs');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justification_output');
    }
}
