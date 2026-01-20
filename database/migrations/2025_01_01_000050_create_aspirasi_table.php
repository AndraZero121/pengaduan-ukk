<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasi', function (Blueprint $table): void {
            $table->unsignedInteger('id_aspirasi')->primary();
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->unsignedInteger('id_kategori');
            $table->string('feedback', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_aspirasi')->references('id_pelaporan')->on('input_aspirasi')->cascadeOnDelete();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
