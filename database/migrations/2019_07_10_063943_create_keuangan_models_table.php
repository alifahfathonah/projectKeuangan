<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeuanganModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keuangan_models', function (Blueprint $table) {
            $table->bigIncrements('id_trans');
            $table->string('nama');
            $table->string('jenis');
            $table->string('type');
            $table->string('status');
            $table->integer('harga')->usigned();
            $table->integer('bayar')->usigned();
            $table->date('tgl_bayar');
            $table->date('tgl_kridit')->nullable();
            $table->date('tgl_lunas')->nullable();
            $table->text('keterangan');
            $table->string('costem')->nullable();
            $table->bigInteger('nohp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keuangan_models');
    }
}
