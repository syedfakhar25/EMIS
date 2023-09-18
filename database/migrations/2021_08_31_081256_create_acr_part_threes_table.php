<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcrPartThreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acr_part_threes', function (Blueprint $table) {
            $table->id();
            $table->integer('acr_part_one_id');
            $table->integer('user_id')->nullable();
            $table->integer('department_id');
            $table->text('comment_officer_performance')->nullable();
            $table->text('integrity')->nullable();
            $table->text('officer_strength_weaknesses')->nullable();
            $table->text('area_and_level_of_profession')->nullable();
            $table->text('training_and_development_needs')->nullable();
            // 1 = Very Good, 2 = Good, 3 = Average, 4 Below Average
            $table->integer('overall_grading')->nullable();
            // 1 = Top 10%, 2 = Next 20%, 3 = Next 70%
            $table->integer('comparative_grading')->nullable();

            // 1 = Top 10%, 2 = Next 20%, 3 = Next 70%
            $table->text('comment_holding_higher_position')->nullable();
            $table->text('name_of_reporting_officer')->nullable();
            $table->text('designation_reporting_officer')->nullable();

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
        Schema::dropIfExists('acr_part_threes');
    }
}
