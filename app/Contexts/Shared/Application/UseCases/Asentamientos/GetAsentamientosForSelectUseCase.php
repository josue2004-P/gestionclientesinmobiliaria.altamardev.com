<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class GetAsentamientosForSelectUseCase
{
    public function __construct(
        private AsentamientoRepositoryInterface $asentamientoRepository
    ) {}

    public function execute(?string $search = null, ?int $selectedId = null, ?string $estado = null, ?string $municipio = null, ?string $ciudad = null): array
    {
        return $this->asentamientoRepository->searchForSelect($search, $selectedId, $estado, $municipio, $ciudad);
    }
}