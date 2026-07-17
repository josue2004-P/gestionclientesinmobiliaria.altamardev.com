<?php

namespace App\Contexts\Viviendas\Domain\Entities;

class Vivienda
{
    public function __construct(
        private ?int $id,
        private ?string $fraccionamiento,
        private ?int $asentamientoId,
        private ?int $tipoViviendaId,
        private float $precioLista,
        private int $recamaras,
        private string $direccion,
        private bool $llaves,
        private string $estatusVivienda,
        private array $creditosIds = [],
        private array $amenidadesIds = [],
        private array $contactos = [],
        private array $documentos = [],
        private array $fotos = []
    ) {}

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getFraccionamiento(): ?string { return $this->fraccionamiento; }
    public function getAsentamientoId(): ?int { return $this->asentamientoId; }
    public function getTipoViviendaId(): ?int { return $this->tipoViviendaId; }
    public function getPrecioLista(): float { return $this->precioLista; }
    public function getRecamaras(): int { return $this->recamaras; }
    public function getDireccion(): string { return $this->direccion; }
    public function hasLlaves(): bool { return $this->llaves; }
    public function getEstatusVivienda(): string { return $this->estatusVivienda; }
    public function getCreditosIds(): array { return $this->creditosIds; }
    public function getAmenidadesIds(): array { return $this->amenidadesIds; }
    public function getContactos(): array { return $this->contactos; }
    public function getDocumentos(): array { return $this->documentos; }
    public function getFotos(): array { return $this->fotos; }

    public function toArray(): array
    {
        return [
            'id'               => $this->id,
            'fraccionamiento'  => $this->fraccionamiento,
            'asentamiento_id'  => $this->asentamientoId,
            'tipo_vivienda_id' => $this->tipoViviendaId,
            'precio_lista'     => $this->precioLista,
            'recamaras'        => $this->recamaras,
            'direccion'        => $this->direccion,
            'llaves'           => $this->llaves,
            'estatus_vivienda' => $this->estatusVivienda,
        ];
    }
}