<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class GetUniqueEstadosUseCase
{
    public function __construct(
        private AsentamientoRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->getUniqueEstados();
    }
}