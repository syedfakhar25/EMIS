<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('personal_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('cnic')->nullable();
            $table->string('ddo_code')->nullable();
            $table->string('Scale')->nullable();
            $table->string('payroll_area')->nullable();
            $table->string('designation')->nullable();
            $table->string('is_gazetted')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('appointment_date');
            $table->string('Employee_Group');
            $table->string('dep_id')->nullable();
            $table->string('father_first_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('district_domicile')->nullable();
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
        Schema::dropIfExists('data');
    }
}
