<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash_id');
            $table->string('name');
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
        //      dropIfExists
        Schema::dropIfExists('designation');
    }
}
