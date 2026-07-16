<?php

namespace App\Contexts\Shared\Domain\Repositories;

use App\Contexts\Shared\Domain\Entities\TipoVivienda;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TipoViviendaRepositoryInterface
{
    public function all(): array;
    public function create(TipoVivienda $tipoVivienda): void;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator;
}