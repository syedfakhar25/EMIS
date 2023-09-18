<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcrPartFoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acr_part_fours', function (Blueprint $table) {
            $table->id();
            $table->integer('acr_part_one_id');
            $table->integer('user_id')->nullable();
            $table->integer('department_id');
            // 1 = Very Frequently, 2 = Frequently, 3 = Rarely, 4 = Never
            $table->integer('reporting_officer_reported_upon');
            $table->text('knowing_about_officer');
            // 1 = Very Good, 2 = Good, 3 = Average, 4 Below Average
            $table->integer('overall_grading')->nullable();
            $table->text('recommendation_for_promotion')->nullable();

            // 1 = Exaggerated, 2 = Fair, 3 = Biased
            $table->integer('evaluation_quality_assessment')->nullable();
            $table->string('name_countersigned_officer')->nullable();
            $table->string('designation')->nullable();
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
        Schema::dropIfExists('acr_part_fours');
    }
}
