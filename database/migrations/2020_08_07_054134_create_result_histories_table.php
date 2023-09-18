<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('number')->nullable();
            $table->string('subject')->nullable();
            $table->string('class')->nullable();
            $table->string('year')->nullable();
            $table->integer('percentage_board')->nullable();
            $table->integer('percentage_college')->nullable();
            $table->integer('percentage_individual')->nullable();
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
        Schema::dropIfExists('result_history');
    }
}
