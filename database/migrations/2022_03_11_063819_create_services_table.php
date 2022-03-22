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
            // $table->id();
            // $table->string('no_plat');
            // $table->foreignId('user_id')->constrained();
            // $table->foreignId('pelanggan_id')->constrained();
            // $table->date('tanggal');
            // $table->string('keluhan')->nullable();
            // $table->boolean('mau_diservice')->nullable();
            // $table->boolean('service_selesai')->default(false);
            // $table->timestamps();
            $table->id();
            // $table->foreignId('pendaftaran_service_id')->constrained();
            $table->dateTime('waktu_mulai');
            $table->enum('status_service', ['cek', 'service', 'selesai'])->default('cek');
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
