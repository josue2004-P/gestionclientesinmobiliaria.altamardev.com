<?php

namespace App\Contexts\Shared\Domain\Repositories;

use App\Contexts\Shared\Domain\Entities\Asentamiento;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AsentamientoRepositoryInterface
{
    public function all(): array;
    public function searchForSelect(?string $search, ?int $selectedId, ?string $estado = null, ?string $municipio = null, ?string $ciudad = null): array;
    
    public function getUniqueEstados(): array;
    public function getUniqueMunicipios(?string $estado = null): array;
    public function getUniqueCiudades(?string $estado = null, ?string $municipio = null): array;

    public function findDuplicate(string $codigoPostal, string $nombreAsentamiento, string $tipoAsentamiento): ?Asentamiento;
    public function findByCodigoPostal(string $codigoPostal): array;
    public function create(Asentamiento $asentamiento): void;
    public function bulkInsert(array $asentamientos): void;
    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator;
    public function delete(int $id): void;
}