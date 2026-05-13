<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wajib_pajaks', function (Blueprint $table) {
            $table->id();
            $table->string('nop')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wajib_pajaks');
    }
};
