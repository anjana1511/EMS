<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManageSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('manage_salary', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('emp_id');
            $table->string('total_leave');
            $table->string('leave_pay');

            $table->string('working_days');
            $table->string('tax');
            $table->string('gross_salary');
            $table->string('advance');
            $table->string('net_salary');
            $table->string('total');
 
          //FOREIGN KEY CONSTRAINTS
            $table->foreign('emp_id')->references('emp_id')->on('employee');
 
          //SETTING THE PRIMARY KEYS
            $table->primary(['id']);
            $table->softDeletes();
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
        //
        Schema::dropIfExists('manage_salary');
    }
}
