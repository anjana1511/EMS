<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TalukaTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('talukas', function (Blueprint $table) {
            $table->increments('taluka_id');
            $table->integer('dist_id');
            $table->integer('state_id')->default(0);
            $table->string('hash_id');
            $table->string('taluka_name');
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
        Schema::dropIfExists('talukas');
    }
}
