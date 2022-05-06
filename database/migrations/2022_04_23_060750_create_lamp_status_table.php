<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamp_status', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->boolean('mode');
            $table->integer('suhu_nyala');
            $table->integer('suhu_mati');
            $table->time('time_on')->nullable();
            $table->time('time_off')->nullable();
            $table->foreign('id')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lamp_status', function(Blueprint $table){
            $table->dropForeign('lamp_status_id_foreign');
        });
        Schema::dropIfExists('lamp_status');
    }
}
