<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonatursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donatur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_jenis');
            $table->string('nama', 60);
            $table->string('tempat_lahir', 60)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('jenis_kelamin')->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('donatur');
    }
}
