<?php

namespace App\Contexts\Clientes\Domain\Repositories;

use App\Contexts\Clientes\Domain\Entities\Cliente;

interface ClienteRepositoryInterface
{
    public function getAll(): array;
    public function findById(int $id): ?Cliente;
    public function save(Cliente $cliente): int;
    public function delete(int $id): bool;
}