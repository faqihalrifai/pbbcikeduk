<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pbbs', function (Blueprint $table) {
            $table->id();
            $table->string('no_urut')->nullable();
            $table->string('blok')->nullable();
            $table->string('urut')->nullable();
            $table->string('nop_gabung')->nullable();
            $table->string('nop')->nullable();
            $table->string('nama_wp')->nullable();
            $table->string('nama_wp_lainnya')->nullable();
            $table->decimal('ketetapan_pbb', 15, 2)->nullable();
            $table->string('nama_kolektor')->nullable();
            $table->string('luas')->nullable();
            $table->text('alamat_wajib_pajak')->nullable();
            $table->decimal('hutang_pbb', 15, 2)->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->decimal('jumlah_bayar', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('column1')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pbbs');
    }
};
