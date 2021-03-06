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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_apotek');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_izin')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('provinsi_id')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('longlat')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
