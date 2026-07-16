<?php

namespace App\Contexts\Clientes\Domain\Entities;

class ClienteTelefono
{
    public function __construct(
        private ?int $id,
        private ?int $clienteId,
        private string $telefono,
        private string $tipoTelefono = 'Celular'
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getClienteId(): ?int { return $this->clienteId; }
    public function getTelefono(): string { return $this->telefono; }
    public function getTipoTelefono(): string { return $this->tipoTelefono; }

   
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'cliente_id' => $this->clienteId,
            'telefono' => $this->telefono,
            'tipo_telefono' => $this->tipoTelefono,
        ];
    }
}