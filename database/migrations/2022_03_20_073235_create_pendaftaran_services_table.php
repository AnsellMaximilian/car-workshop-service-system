<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_services', function (Blueprint $table) {
            $table->id();
            $table->string('keluhan');
            $table->string('no_plat');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('pelanggan_id')->constrained();
            $table->dateTime('waktu_pendaftaran');
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
        Schema::dropIfExists('pendaftaran_services');
    }
}
