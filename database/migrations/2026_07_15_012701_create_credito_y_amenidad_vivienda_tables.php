<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credito_vivienda', function (Blueprint $table) {
            $table->foreignId('tipo_credito_id')->constrained('tipos_credito')->onDelete('cascade');
            $table->foreignId('vivienda_id')->constrained('viviendas')->onDelete('cascade');
            
            $table->primary(['tipo_credito_id', 'vivienda_id'], 'pk_credito_vivienda');
        });

        Schema::create('amenidad_vivienda', function (Blueprint $table) {
            $table->foreignId('amenidad_id')->constrained('amenidades')->onDelete('cascade');
            $table->foreignId('vivienda_id')->constrained('viviendas')->onDelete('cascade');

            $table->primary(['amenidad_id', 'vivienda_id'], 'pk_amenidad_vivienda');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('amenidad_vivienda');
        Schema::dropIfExists('credito_vivienda');
    }
};