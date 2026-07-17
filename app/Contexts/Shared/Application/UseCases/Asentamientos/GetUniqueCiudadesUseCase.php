<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class GetUniqueCiudadesUseCase
{
    public function __construct(
        private AsentamientoRepositoryInterface $repository
    ) {}

    public function execute(?string $estado = null, ?string $municipio = null): array
    {
        return $this->repository->getUniqueCiudades($estado, $municipio);
    }
}