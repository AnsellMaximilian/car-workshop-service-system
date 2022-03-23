<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuanServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuan_services', function (Blueprint $table) {
            // $table->id();
            $table->dateTime('waktu_persetujuan');
            $table->foreignId('service_id')->constrained();
            $table->enum('status_persetujuan', ['setuju', 'tolak'])->default('tolak');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->primary('service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persetujuan_services');
    }
}
