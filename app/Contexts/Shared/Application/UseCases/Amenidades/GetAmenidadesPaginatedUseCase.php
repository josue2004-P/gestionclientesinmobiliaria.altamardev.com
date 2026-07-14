<?php
namespace App\Contexts\Shared\Application\UseCases\Amenidades;
use App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface;

class GetAmenidadesPaginatedUseCase {
    public function __construct(private AmenidadRepositoryInterface $rep) {}
    public function execute(?string $s, int $p) { return $this->rep->paginateWithSearch($s, $p); }
}