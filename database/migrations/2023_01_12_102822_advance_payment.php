<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvancePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('advance_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('emp_id');
            $table->date('date');
            $table->bigInteger('amount');
 
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
        Schema::dropIfExists('advance_payment');
        //
    }
}
