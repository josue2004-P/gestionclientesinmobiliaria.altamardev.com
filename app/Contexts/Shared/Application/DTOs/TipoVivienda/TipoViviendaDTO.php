<?php

namespace App\Contexts\Shared\Application\DTOs\TipoVivienda;

use App\Contexts\Shared\Domain\Entities\TipoVivienda;

class TipoViviendaDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $descripcion = null
    ) {}

    public static function fromEntity(TipoVivienda $entity): self
    {
        return new self(
            id: $entity->getId(),
            nombre: $entity->getNombre(),
            descripcion: $entity->getDescripcion()
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ];
    }
}