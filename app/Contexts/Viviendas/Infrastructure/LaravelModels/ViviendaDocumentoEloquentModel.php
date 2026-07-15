<?php

namespace App\Contexts\Viviendas\Infrastructure\LaravelModels;
use Illuminate\Database\Eloquent\Model;

class ViviendaDocumentoEloquentModel extends Model {
    protected $table = 'vivienda_documentos';
    protected $fillable = ['vivienda_id', 'url', 'nombre_original', 'tipo_documento', 'peso_bytes', 'verificado'];
}