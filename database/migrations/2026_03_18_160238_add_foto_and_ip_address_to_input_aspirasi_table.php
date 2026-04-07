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
            $table->string('foto')->nullable()->after('ket');
            $table->string('ip_address', 45)->nullable()->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('input_aspirasi', function (Blueprint $table) {
            $table->dropColumn(['foto', 'ip_address']);
        });
    }
};
