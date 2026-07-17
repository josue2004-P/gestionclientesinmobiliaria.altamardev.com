<?php

namespace App\Contexts\Shared\Application\UseCases\Asentamientos;

use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;

class BulkInsertAsentamientosUseCase
{
    public function __construct(
        private AsentamientoRepositoryInterface $repository
    ) {}

    public function execute(array $asentamientos): void
    {
        if (empty($asentamientos)) {
            return;
        }

        $loteLimpio = [];
        $identificadoresLocales = [];

        foreach ($asentamientos as $item) {
            $cp     = trim((string)($item['codigo_postal'] ?? ''));
            $nombre = trim((string)($item['nombre_asentamiento'] ?? ''));
            $tipo   = trim((string)($item['tipo_asentamiento'] ?? 'Colonia'));

            if (empty($cp) || empty($nombre)) {
                continue;
            }

            $llaveLocal = md5(strtolower($cp . '|' . $nombre . '|' . $tipo));
            if (isset($identificadoresLocales[$llaveLocal])) {
                continue;
            }
            $identificadoresLocales[$llaveLocal] = true;

            $duplicadoEnBaseDatos = $this->repository->findDuplicate($cp, $nombre, $tipo);

            if (!$duplicadoEnBaseDatos) {
                $loteLimpio[] = [
                    'codigo_postal'       => $cp,
                    'estado'              => trim((string)($item['estado'] ?? 'Sin Estado')),
                    'municipio'           => trim((string)($item['municipio'] ?? 'Sin Municipio')),
                    'ciudad'              => !empty($item['ciudad']) ? trim((string)$item['ciudad']) : null,
                    'tipo_asentamiento'   => $tipo,
                    'nombre_asentamiento' => $nombre,
                ];
            }
        }

        if (!empty($loteLimpio)) {
            $this->repository->bulkInsert($loteLimpio);
        }
    }
}