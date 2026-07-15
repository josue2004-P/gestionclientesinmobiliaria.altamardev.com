<?php

namespace App\Contexts\Viviendas\Application\UseCases;

use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetViviendasPaginatedUseCase
{
    public function __construct(private ViviendaRepositoryInterface $repository) {}

    public function execute(?string $search, ?string $estatus, int $perPage): LengthAwarePaginator
    {
        return $this->repository->paginateWithSearch($search, $estatus, $perPage);
    }
}