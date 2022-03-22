<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkiraanPenjualanServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkiraan_penjualan_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_service_id')->constrained();
            $table->foreignId('pendaftaran_service_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('harga');
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
        Schema::dropIfExists('perkiraan_penjualan_services');
    }
}
