<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemasukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal');
            $table->date('id_pengurus')->nullable();
            $table->date('id_donatur')->nullable();
            $table->date('id_pengubah')->nullable();
            $table->integer('id_jenis_infaq')->nullable();
            $table->integer('jumlah');
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukan');
    }
}
