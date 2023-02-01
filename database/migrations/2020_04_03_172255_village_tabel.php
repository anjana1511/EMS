<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VillageTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        
        Schema::create('village', function (Blueprint $table) {
            $table->increments('village_id');
            $table->integer('taluka_id')->default(0);
            $table->integer('dist_id')->default(0);
            $table->integer('state_id')->default(0);
            $table->string('hash_id');
            $table->string('village_name');
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
        Schema::dropIfExists('village');
    }
}
