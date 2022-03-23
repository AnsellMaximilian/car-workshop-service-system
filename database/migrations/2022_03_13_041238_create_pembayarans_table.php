<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('service_id')->constrained();
            $table->date('tanggal');
            $table->enum('tipe_pembayaran', ['debit', 'cash']);
            $table->string('bukti_pembayaran')->nullable();
            // $table->integer('jumlah');
            // $table->integer('kembali')->default(0);
            $table->string('keterangan')->nullable();
            $table->primary('service_id');
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
        Schema::dropIfExists('pembayarans');
    }
}
