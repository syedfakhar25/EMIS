<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employement_details', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('emp_status')->nullable();
            $table->string('designation')->nullable();
            $table->string('bps')->nullable();
            $table->string('time_scale')->nullable();
            $table->date('time_scale_date')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('initial_appointed_as')->nullable();
            $table->date('present_join_date')->nullable();
            $table->bigInteger('gross_salary')->nullable();
            $table->string('present_work_at')->nullable();
            $table->string('office_name')->nullable();
            $table->string('emis_code')->nullable();
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
        Schema::dropIfExists('employement_details');
    }
}
