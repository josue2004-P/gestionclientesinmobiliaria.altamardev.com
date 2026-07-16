<?php

namespace App\Contexts\Clientes\Application\UseCases;

use App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface;
use App\Contexts\Clientes\Infrastructure\Repositories\EloquentClienteRepository;

class SaveClienteDocumentosUseCase
{
    private EloquentClienteRepository $repository;

    public function __construct(ClienteRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    public function execute(int $clienteId, array $documentos): void
    {
        $this->repository->saveDocumentos($clienteId, $documentos);
    }
}