<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpLeave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::create('EmpLeave', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('emp_id');
              $table->string('hash_id');
              $table->integer('l_id');
              $table->date('leave_fromdate');
              $table->date('leave_todate');
              $table->string('leave_description');
              $table->integer('leave_status');
              $table->string('admin_remark');
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
        Schema::dropIfExists('EmpLeave');
    }
}
