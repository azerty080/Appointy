<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpeninghoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openinghours', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('dayofweek');
            $table->string('opentime')->nullable();
            $table->string('closetime')->nullable();

            $table->integer('opentime_in_min')->nullable();
            $table->integer('closetime_in_min')->nullable();

            $table->boolean('closed')->default(0);
            
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            
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
        Schema::dropIfExists('openinghours');
    }
}
