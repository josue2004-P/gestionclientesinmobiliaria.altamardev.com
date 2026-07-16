<?php

namespace App\Contexts\Shared\Application\UseCases\Amenidades;

use App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface;

class GetAmenidadesForSelectUseCase
{
    public function __construct(
        private AmenidadRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->all();
    }
}