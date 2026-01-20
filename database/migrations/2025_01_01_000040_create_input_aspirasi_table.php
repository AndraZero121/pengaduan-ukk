<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('input_aspirasi', function (Blueprint $table): void {
            $table->increments('id_pelaporan');
            $table->string('nis', 10);
            $table->unsignedInteger('id_kategori');
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswa')->cascadeOnDelete();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_aspirasi');
    }
};
