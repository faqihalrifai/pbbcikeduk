<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tunggakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wajib_pajak_id')->constrained('wajib_pajaks')->onDelete('cascade');
            $table->year('tahun');
            $table->decimal('jumlah_tagihan', 15, 2);
            $table->enum('status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tunggakans');
    }
};
