<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu_request');
            $table->string('nama');
            $table->string('email');
            $table->string('keluhan');
            $table->dateTime('waktu_booking');
            $table->string('no_plat');
            $table->string('no_telp');
            $table->boolean('pernah_service')->default(false);
            $table->foreignId('pelanggan_id')->nullable()->constrained();
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
        Schema::dropIfExists('booking_requests');
    }
}
