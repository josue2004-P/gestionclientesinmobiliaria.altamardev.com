<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->string('fraccionamiento', 255)->nullable();
            $table->foreignId('asentamiento_id')->nullable()->constrained('asentamientos')->nullOnDelete();
            $table->foreignId('tipo_vivienda_id')->nullable()->constrained('tipos_vivienda')->nullOnDelete();
            $table->decimal('precio_lista', 12, 2);
            $table->integer('recamaras')->default(0);
            $table->text('direccion');
            $table->boolean('llaves')->default(false);
            $table->enum('estatus_vivienda', ['Disponible', 'Apartada', 'Vendida', 'Rentada', 'Mantenimiento', 'Suspendida'])->default('Disponible');
            $table->timestamps();

            $table->index('estatus_vivienda', 'viviendas_estatus_index');
            $table->index('fraccionamiento', 'viviendas_fraccionamiento_index');
        });

        Schema::create('vivienda_contactos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vivienda_id')->constrained('viviendas')->onDelete('cascade');
            $table->string('nombre', 255);
            $table->string('relacion', 100)->nullable();
            $table->string('telefono', 20);
            $table->string('correo', 255)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('vivienda_id', 'contactos_vivienda_id_index');
        });

        Schema::create('vivienda_documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vivienda_id')->constrained('viviendas')->onDelete('cascade');
            $table->string('url', 255);
            $table->string('nombre_original', 255)->nullable();
            $table->string('tipo_documento', 100);
            $table->integer('peso_bytes')->nullable();
            $table->boolean('verificado')->default(false);
            $table->timestamps();

            $table->index(['vivienda_id', 'tipo_documento'], 'vivienda_documento_tipo_index');
        });

        Schema::create('vivienda_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vivienda_id')->constrained('viviendas')->onDelete('cascade');
            $table->string('url', 255);
            $table->string('nombre_original', 255)->nullable();
            $table->integer('orden')->default(0);
            $table->boolean('es_principal')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vivienda_fotos');
        Schema::dropIfExists('vivienda_documentos');
        Schema::dropIfExists('vivienda_contactos');
        Schema::dropIfExists('viviendas');
    }
};