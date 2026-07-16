<?php

namespace App\Contexts\Shared\Application\UseCases\TiposVivienda;

use App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface;

class GetTiposViviendaForSelectUseCase
{
    public function __construct(
        private TipoViviendaRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->all();
    }
}