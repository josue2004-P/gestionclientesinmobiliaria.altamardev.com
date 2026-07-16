<?php

namespace App\Contexts\Shared\Domain\Repositories;

use App\Contexts\Shared\Domain\Entities\Amenidad;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AmenidadRepositoryInterface
{
    public function all(): array;
    public function create(Amenidad $amenidad): void;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator;
}