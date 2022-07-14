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
        Schema::create('medichines', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 100);
            $table->integer('kelas_obat_id');
            $table->integer('subkelas_obat_id')->nullable();
            $table->integer('sediaan_obat_id')->nullable();
            $table->string('kekuatan', 20)->nullable();
            $table->string('satuan', 100)->nullable();
            $table->text('retriksi')->nullable();
            $table->text('retriksi_obat')->nullable();
            $table->text('retriksi_sediaan')->nullable();
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
        Schema::dropIfExists('medichines');
    }
};
