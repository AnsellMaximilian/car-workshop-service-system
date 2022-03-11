<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('tanggal_pendaftaran');
            $table->date('tanggal_faktur')->nullable();
            $table->string('keluhan')->nullable();
            $table->boolean('dicek')->default(false);
            $table->boolean('mau_diservice')->nullable();
            $table->boolean('service_selesai')->nullable();
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
        Schema::dropIfExists('services');
    }
}
