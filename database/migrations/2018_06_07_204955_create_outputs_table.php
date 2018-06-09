<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outputs', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->unsignedInteger('justification_id');
            $table->foreign('justification_id')->references('id')->on('justifications');
            
            $table->integer('applicant_id');
            $table->text('description_j')->nullable();
            $table->text('observation')->nullable();
            $table->string('voucher')->nullable();
            $table->integer('approve')->nullable();
            $table->dateTime('date_to_approved')->nullable();
            $table->integer('deliver')->nullable();
            $table->dateTime('date_to_delivered')->nullable();
            $table->enum('status',['REQUESTED','APPROVED','DELIVERED'])->default('REQUESTED');
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
        Schema::dropIfExists('outputs');
    }
}