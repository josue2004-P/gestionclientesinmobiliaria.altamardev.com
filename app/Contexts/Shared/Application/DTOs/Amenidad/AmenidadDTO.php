<?php

namespace App\Contexts\Shared\Application\DTOs\Amenidad;

use App\Contexts\Shared\Domain\Entities\Amenidad;

class AmenidadDTO
{
    public function __construct(
        public int $id,
        public string $nombre
    ) {}

    public static function fromEntity(Amenidad $entity): self
    {
        return new self(
            id: $entity->getId(),
            nombre: $entity->getNombre()
        );
    }

    public function toArray(): array
    {
        return [
            'id'     => $this->id,
            'nombre' => $this->nombre,
        ];
    }
}