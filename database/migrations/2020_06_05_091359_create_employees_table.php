<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('dep_id'); //foreign key to department
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('refugee_status');
            $table->string('birth_place');
            $table->string('district');
            $table->string('quota');
            $table->date('birth_date');
            $table->string('cnic')->unique();
            $table->text('current_address');
            $table->text('permanent_address');
            $table->integer('salary');
            $table->mediumText('image')->nullable();
            $table->boolean('active');
            $table->timestamps();

            $table->index('dep_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
