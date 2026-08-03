<?php

namespace App\Contexts\Security\Infrastructure\LaravelModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserEloquentModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'usuario',
        'name',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'is_activo',
        'foto',
        'firma',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_activo'         => 'boolean',
        ];
    }

    /**
     * Obtiene el nombre completo del usuario omitiendo el apellido materno si es null o vacío.
     */
    public function getNombreCompleto(): string
    {
        return implode(' ', array_filter([
            $this->name,
            $this->apellido_paterno,
            $this->apellido_materno
        ]));
    }

    /**
     * Accessor para acceder como propiedad ($user->nombre_completo)
     */
    public function getNombreCompletoAttribute(): string
    {
        return $this->getNombreCompleto();
    }
    
    public function perfiles(): BelongsToMany
    {
        return $this->belongsToMany(PerfilEloquentModel::class, 'perfil_user', 'user_id', 'perfil_id')
                    ->withTimestamps(); 
    }

    public function checkPerfil($perfilNombre)
    {
        return $this->perfiles()->where('nombre', $perfilNombre)->exists();
    }
}