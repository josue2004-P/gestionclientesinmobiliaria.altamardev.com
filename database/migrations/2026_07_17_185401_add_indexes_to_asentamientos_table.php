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
        Schema::table('asentamientos', function (Blueprint $table) {
            $table->index('estado', 'asentamientos_estado_idx');
            $table->index(['estado', 'municipio'], 'asentamientos_edo_mun_idx');
            $table->index(['estado', 'municipio', 'ciudad'], 'asentamientos_edo_mun_ciu_idx');
            $table->index('nombre_asentamiento', 'asentamientos_nombre_asentamiento_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asentamientos', function (Blueprint $table) {
            $table->dropIndex('asentamientos_estado_idx');
            $table->dropIndex('asentamientos_edo_mun_idx');
            $table->dropIndex('asentamientos_edo_mun_ciu_idx');
            $table->dropIndex('asentamientos_nombre_asentamiento_idx');
        });
    }
};