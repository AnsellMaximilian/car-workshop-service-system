<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('rekening_bca')->nullable();
            $table->string('rekening_bni')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('hp_1')->nullable();
            $table->string('hp_2')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('company_configurations');
    }
}
