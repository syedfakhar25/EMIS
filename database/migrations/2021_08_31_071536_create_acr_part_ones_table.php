<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcrPartOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acr_part_ones', function (Blueprint $table) {
            $table->id();
            // employee id emp_id in other tables
            $table->integer('user_id')->nullable();
            // dep_id in other tables
            $table->integer('department_id');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('name')->nullable();
            $table->string('personal_no')->nullable();
            $table->date('dob')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('post_held_during_period_with_bps')->nullable();
            $table->string('academic_qualification')->nullable();
            $table->text('knowledge_of_languages_speaking_reading_writing')->nullable();
            $table->string('post_served')->nullable();
            $table->string('in_present_post')->nullable();
            $table->string('under_the_reporting_officer_name')->nullable();
            $table->string('under_the_reporting_officer_cnic')->nullable();
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
        Schema::dropIfExists('acr_part_ones');
    }
}
