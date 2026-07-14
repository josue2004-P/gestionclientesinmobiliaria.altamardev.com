<?php

namespace App\Contexts\Shared\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Model;

class AmenidadEloquentModel extends Model
{
    protected $table = 'amenidades';

    protected $fillable = [
        'nombre',
    ];
}