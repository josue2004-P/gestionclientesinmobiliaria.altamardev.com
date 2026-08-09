<?php

namespace App\Contexts\Shared\Application\UseCases\TiposVivienda;

use App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface;
use App\Contexts\Shared\Application\DTOs\TipoVivienda\TipoViviendaDTO;

class GetTiposViviendaForSelectUseCase
{
    public function __construct(
        private TipoViviendaRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        $entities = $this->repository->all();

        return array_map(function ($tipo) {
            if (method_exists($tipo, 'toArray')) {
                return $tipo->toArray();
            }

            return [
                'id'          => $tipo->getId(),
                'nombre'      => $tipo->getNombre(),
                'descripcion' => $tipo->getDescripcion(),
            ];
        }, $entities);
    }
}