<?php

namespace App\Contexts\Viviendas\Domain\Repositories;

use App\Contexts\Viviendas\Domain\Entities\Vivienda;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ViviendaRepositoryInterface
{
    public function save(Vivienda $vivienda): int;
    public function delete(int $id): void;
    public function findById(int $id): ?Vivienda;
    public function paginateWithSearch(?string $search, ?string $estatus, int $perPage): LengthAwarePaginator;
}