<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_data', function (Blueprint $table) {
            $table->string('id',8)->primary();
            $table->integer('temp');
            $table->integer('humi');
            $table->timestamp('waktu')->useCurrent();

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
        Schema::table('temp_data', function(Blueprint $table){
            $table->dropForeign('temp_data_id_foreign');
        });
        Schema::dropIfExists('temp_data');
    }
}
