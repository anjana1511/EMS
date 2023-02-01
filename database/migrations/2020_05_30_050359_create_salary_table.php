<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
              $table->increments('id');
            $table->integer('gross_salary');
            $table->integer('emp_id');
            $table->string('hash_id');
            $table->string('tax');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('emp_id')->references('emp_id')->on('employee');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
