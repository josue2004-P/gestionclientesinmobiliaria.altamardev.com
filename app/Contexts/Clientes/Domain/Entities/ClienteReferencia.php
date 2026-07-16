<?php

namespace App\Contexts\Clientes\Domain\Entities;

class ClienteReferencia
{
    public function __construct(
        private ?int $id,
        private ?int $clienteId,
        private string $nombre,
        private ?string $celular,
        private ?string $parentesco,
        private ?int $asentamientoId,
        private ?string $calleNumero
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getClienteId(): ?int { return $this->clienteId; }
    public function getNombre(): string { return $this->nombre; }
    public function getCelular(): ?string { return $this->celular; }
    public function getParentesco(): ?string { return $this->parentesco; }
    public function getAsentamientoId(): ?int { return $this->asentamientoId; }
    public function getCalleNumero(): ?string { return $this->calleNumero; }

    public function toArray(): array
    {
        return [
            'id'              => $this->id,
            'cliente_id'      => $this->clienteId,
            'nombre'          => $this->nombre,
            'celular'         => $this->celular,
            'parentesco'      => $this->parentesco,
            'asentamiento_id' => $this->asentamientoId,
            'calle_numero'    => $this->calleNumero,
        ];
    }
}