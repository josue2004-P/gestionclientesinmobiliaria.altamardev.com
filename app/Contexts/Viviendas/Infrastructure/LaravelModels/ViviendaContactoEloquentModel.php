<?php
namespace App\Contexts\Viviendas\Infrastructure\LaravelModels;
use Illuminate\Database\Eloquent\Model;

class ViviendaContactoEloquentModel extends Model {
    protected $table = 'vivienda_contactos';
    protected $fillable = ['vivienda_id', 'nombre', 'relacion', 'telefono', 'correo', 'notes'];
}