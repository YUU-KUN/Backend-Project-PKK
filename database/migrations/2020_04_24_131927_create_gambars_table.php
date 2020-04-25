<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGambarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file');
            $table->integer('stock');
            $table->enum('jenis',['pertamax','pertamax_turbo','pertamina_dex','premium','pertalite','dextalite','bio_solar']);
            $table->string('harga');
            $table->string('takaran');
            $table->integer('dibeli');            
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
        Schema::dropIfExists('gambar');
    }
}
