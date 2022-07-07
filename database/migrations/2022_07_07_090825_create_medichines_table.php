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
            $table->integer('sediaan_obat_id');
            $table->float('kekuatan', 8, 2);
            $table->string('satuan', 100);
            $table->text('retriksi_obat');
            $table->text('retriksi_sediaan');
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
