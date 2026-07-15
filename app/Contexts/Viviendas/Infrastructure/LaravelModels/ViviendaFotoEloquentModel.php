<?php

namespace App\Contexts\Viviendas\Infrastructure\LaravelModels;
use Illuminate\Database\Eloquent\Model;

class ViviendaFotoEloquentModel extends Model {
    protected $table = 'vivienda_fotos';
    protected $fillable = ['vivienda_id', 'url', 'nombre_original', 'orden', 'es_principal'];
}