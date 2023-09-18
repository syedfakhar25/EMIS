<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaching_details', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('number')->nullable();
            $table->string('subject')->nullable();
            $table->string('class')->nullable();
            $table->string('periods')->nullable();
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
        Schema::dropIfExists('teaching_details');
    }
}
