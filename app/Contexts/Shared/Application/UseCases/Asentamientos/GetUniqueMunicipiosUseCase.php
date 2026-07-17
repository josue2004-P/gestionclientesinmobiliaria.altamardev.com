<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class GetUniqueMunicipiosUseCase
{
    public function __construct(
        private AsentamientoRepositoryInterface $repository
    ) {}

    public function execute(?string $estado = null): array
    {
        return $this->repository->getUniqueMunicipios($estado);
    }
}