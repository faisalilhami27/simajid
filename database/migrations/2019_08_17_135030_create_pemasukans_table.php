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
            $table->integer('id_jenis');
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
