<?php

namespace App\Contexts\Viviendas\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;
use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoViviendaEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoCreditoEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\AmenidadEloquentModel;

class ViviendaEloquentModel extends Model
{
    protected $table = 'viviendas';

    protected $fillable = [
        'fraccionamiento', 'asentamiento_id', 'tipo_vivienda_id', 
        'precio_lista', 'recamaras', 'direccion', 'llaves', 'estatus_vivienda'
    ];

    protected $casts = [
        'llaves'       => 'boolean',
        'precio_lista' => 'float',
    ];

    // Relaciones del Modelo
    public function asentamiento() {
        return $this->belongsTo(AsentamientoEloquentModel::class, 'asentamiento_id');
    }

    public function tipoVivienda() {
        return $this->belongsTo(TipoViviendaEloquentModel::class, 'tipo_vivienda_id');
    }

    public function creditos() {
        return $this->belongsToMany(TipoCreditoEloquentModel::class, 'credito_vivienda', 'vivienda_id', 'tipo_credito_id');
    }

    public function amenidades() {
        return $this->belongsToMany(AmenidadEloquentModel::class, 'amenidad_vivienda', 'vivienda_id', 'amenidad_id');
    }

    public function contactos() {
        return $this->hasMany(ViviendaContactoEloquentModel::class, 'vivienda_id');
    }

    public function documentos() {
        return $this->hasMany(ViviendaDocumentoEloquentModel::class, 'vivienda_id');
    }

    public function fotos() {
        return $this->hasMany(ViviendaFotoEloquentModel::class, 'vivienda_id');
    }
}