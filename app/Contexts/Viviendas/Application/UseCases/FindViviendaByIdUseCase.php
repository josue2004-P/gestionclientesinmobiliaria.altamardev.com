<?php

namespace App\Contexts\Viviendas\Application\UseCases;

use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;
use App\Contexts\Viviendas\Domain\Entities\Vivienda;

class FindViviendaByIdUseCase
{
    public function __construct(
        private ViviendaRepositoryInterface $repository
    ) {}

    public function execute(int $id): ?Vivienda
    {
        return $this->repository->findById($id);
    }
}