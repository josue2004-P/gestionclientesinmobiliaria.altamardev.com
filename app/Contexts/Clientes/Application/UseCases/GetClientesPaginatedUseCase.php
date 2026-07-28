<?php

namespace App\Contexts\Clientes\Application\UseCases;

use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetClientesPaginatedUseCase
{
    public function __construct(
        private ClienteRepositoryInterface $repository
    ) {}

    public function execute(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginateWithSearch($search, $perPage);
    }
}