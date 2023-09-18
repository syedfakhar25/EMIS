<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcrPartFivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acr_part_fives', function (Blueprint $table) {
            $table->id();
            $table->integer('acr_part_one_id');
            $table->integer('user_id')->nullable();
            $table->integer('department_id');
            $table->text('remarks_second_countersigned_officer');
            $table->string('name');
            $table->string('designation');
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
        Schema::dropIfExists('acr_part_fives');
    }
}
