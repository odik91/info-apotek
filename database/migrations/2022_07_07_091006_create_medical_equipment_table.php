<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_equipment', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
            $table->integer('kelompok_alkes_id')->nullable();
            $table->integer('kategori_alkes_id')->nullable();
            $table->integer('kelas_alkes_id')->nullable();
            $table->integer('kelas_resiko_alkes_id')->nullable();
            $table->integer('sifat_alkes_id')->nullable();
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
        Schema::dropIfExists('medical_equipment');
    }
};
