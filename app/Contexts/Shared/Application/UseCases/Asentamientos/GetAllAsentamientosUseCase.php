<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class GetAllAsentamientosUseCase
{
    public function __construct(
        private AsentamientoRepositoryInterface $asentamientoRepository
    ) {}

    public function execute(): array
    {
        return $this->asentamientoRepository->all();
    }
}