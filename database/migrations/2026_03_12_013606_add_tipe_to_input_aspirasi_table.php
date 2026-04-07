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
        Schema::table('input_aspirasi', function (Blueprint $table) {
            $table->enum('tipe', ['Pengaduan', 'Aspirasi'])->default('Pengaduan')->after('id_pelaporan');
            $table->string('lokasi', 50)->nullable()->change(); // Allow null for Aspirasi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('input_aspirasi', function (Blueprint $table) {
            $table->dropColumn('tipe');
            $table->string('lokasi', 50)->nullable(false)->change();
        });
    }
};
