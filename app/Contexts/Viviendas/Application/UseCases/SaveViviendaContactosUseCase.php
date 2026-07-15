<?php

namespace App\Contexts\Viviendas\Application\UseCases;

use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;

class SaveViviendaContactosUseCase
{
    public function __construct(
        private ViviendaRepositoryInterface $repository
    ) {}

    public function execute(int $viviendaId, array $contactos): void
    {
        $this->repository->saveContactos($viviendaId, $contactos);
    }
}