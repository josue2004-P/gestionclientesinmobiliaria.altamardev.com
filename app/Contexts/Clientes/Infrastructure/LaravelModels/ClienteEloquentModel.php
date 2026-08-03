<?php

namespace App\Contexts\Clientes\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // 👈 Importar BelongsTo
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;

class ClienteEloquentModel extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento',
        'rfc', 'curp', 'asentamiento_id', 'calle_numero', 'nss',
        'correo_infonavit', 'contrasena_infonavit', 'tipo_redito_id',
        'precalificacion', 'avaluo_solicitado', 'estado_civil', 'regimen_casamiento'
    ];

    /**
     * Relación con el Asentamiento / Ubicación donde vive el cliente
     */
    public function asentamiento(): BelongsTo
    {
        return $this->belongsTo(AsentamientoEloquentModel::class, 'asentamiento_id');
    }

    public function zonasInteres(): BelongsToMany
    {
        return $this->belongsToMany(
            AsentamientoEloquentModel::class, 
            'cliente_zonas_interes', 
            'cliente_id', 
            'asentamiento_id'
        );
    }

    public function telefonos(): HasMany
    {
        return $this->hasMany(ClienteTelefonoEloquentModel::class, 'cliente_id');
    }

    public function referencias(): HasMany
    {
        return $this->hasMany(ClienteReferenciaEloquentModel::class, 'cliente_id');
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(ClienteDocumentoEloquentModel::class, 'cliente_id');
    }
}