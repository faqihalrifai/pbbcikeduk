<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balik_nama_pbbs', function (Blueprint $table) {
            $table->id();
            $table->string('nop');
            $table->string('nama_pemilik_lama');
            $table->text('alamat_objek');
            $table->string('nama_pemilik_baru');
            $table->string('nik');
            $table->string('no_hp');
            $table->text('alamat_baru');
            $table->string('ktp');
            $table->string('kk');
            $table->string('bukti_kepemilikan');
            $table->string('sppt_lama');
            $table->string('status')->default('Menunggu Verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balik_nama_pbbs');
    }
};
