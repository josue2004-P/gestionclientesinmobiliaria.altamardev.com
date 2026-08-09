<?php

namespace App\Contexts\Shared\Application\UseCases\Amenidades;

use App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface;
use App\Contexts\Shared\Application\DTOs\Amenidad\AmenidadDTO;

class GetAmenidadesForSelectUseCase
{
    public function __construct(
        private AmenidadRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        $entities = $this->repository->all();

        return array_map(
            fn($amenidad) => AmenidadDTO::fromEntity($amenidad)->toArray(),
            $entities
        );
    }
}