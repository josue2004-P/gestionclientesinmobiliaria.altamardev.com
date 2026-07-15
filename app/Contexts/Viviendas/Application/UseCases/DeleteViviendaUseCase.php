<?php

namespace App\Contexts\Viviendas\Application\UseCases;

use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;

class DeleteViviendaUseCase
{
    public function __construct(private ViviendaRepositoryInterface $repository) {}

    public function execute(int $id): void
    {
        $this->repository->delete($id);
    }
}