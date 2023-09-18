<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcrPartTwosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acr_part_twos', function (Blueprint $table) {
            $table->id();
            $table->integer('acr_part_one_id');
            $table->integer('user_id')->nullable();
            $table->text('job_description');
            $table->text('brief_account_achievements');
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
        Schema::dropIfExists('acr_part_twos');
    }
}
