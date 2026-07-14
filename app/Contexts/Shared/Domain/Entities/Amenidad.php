<?php

namespace App\Contexts\Shared\Domain\Entities;

class Amenidad
{
    public function __construct(
        private ?int $id,
        private string $nombre,
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }

    public function toArray(): array
    {
        return [
            'id'     => $this->id,
            'nombre' => $this->nombre,
        ];
    }
}