<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaranModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kpn');
            $table->integer('jumlah')->usigned();
            $table->string('total');
            $table->integer('level')->unigned();
            $table->date('tanggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran_models');
    }
}
