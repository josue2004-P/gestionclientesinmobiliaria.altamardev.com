<?php

namespace App\Contexts\Clientes\Domain\Entities;

class ClienteDocumento
{
    public function __construct(
        private ?int $id,
        private ?int $clienteId,
        private string $url,
        private ?string $nombreOriginal,
        private string $tipoDocumento,
        private ?int $pesoBytes,
        private bool $verificado = false
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getClienteId(): ?int { return $this->clienteId; }
    public function getUrl(): string { return $this->url; }
    public function getNombreOriginal(): ?string { return $this->nombreOriginal; }
    public function getTipoDocumento(): string { return $this->tipoDocumento; }
    public function getPesoBytes(): ?int { return $this->pesoBytes; }
    public function isVerificado(): bool { return $this->verificado; }

    public function toArray(): array
    {
        return [
            'id'              => $this->id,
            'cliente_id'      => $this->clienteId,
            'url'             => $this->url,
            'nombre_original' => $this->nombreOriginal,
            'tipo_documento'  => $this->tipoDocumento,
            'peso_bytes'      => $this->pesoBytes,
            'verificado'      => $this->verificado,
        ];
    }
}