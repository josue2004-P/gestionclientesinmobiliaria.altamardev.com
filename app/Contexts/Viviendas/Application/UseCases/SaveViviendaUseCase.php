<?php

namespace App\Contexts\Viviendas\Application\UseCases;

use App\Contexts\Viviendas\Domain\Entities\Vivienda;
use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;

class SaveViviendaUseCase
{
    public function __construct(
        private ViviendaRepositoryInterface $repository
    ) {}

    public function execute(array $data): int
    {
        $vivienda = new Vivienda(
            $data['id'] ?? null,
            $data['fraccionamiento'] ?? null,
            $data['asentamiento_id'] ?? null,
            $data['tipo_vivienda_id'] ?? null,
            (float)$data['precio_lista'],
            (int)$data['recamaras'],
            $data['direccion'],
            (bool)($data['llaves'] ?? false),
            $data['estatus_vivienda'] ?? 'Disponible',
            $data['creditos_ids'] ?? [],
            $data['amenidades_ids'] ?? []
        );

        return $this->repository->save($vivienda);
    }
}