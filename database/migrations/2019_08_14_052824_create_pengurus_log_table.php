<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengurusLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_pengurus')->index();
            $table->string('description')->nullable()->default(null);
            $table->datetime('last_login_at')->nullable()->default(null);
            $table->string('last_login_ip')->nullable()->default(null);
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
        Schema::dropIfExists('pengurus_log');
    }
}
