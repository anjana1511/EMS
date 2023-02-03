<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('emp_id');
            $table->string('hash_id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('email')->unique();
            $table->integer('Mono');
            $table->integer('village_id')->default(0);
            $table->integer('taluka_id')->default(0);
            $table->integer('dist_id')->default(0);
            $table->integer('state_id')->default(0);
            $table->integer('age');
            $table->date('dob');
            $table->date('join_date');
            $table->integer('dept');
            $table->integer('des_id');
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
        Schema::dropIfExists('employee');
    }
}
