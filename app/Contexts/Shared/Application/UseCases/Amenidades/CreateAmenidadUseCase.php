<?php
namespace App\Contexts\Shared\Application\UseCases\Amenidades;
use App\Contexts\Shared\Domain\Entities\Amenidad;
use App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface;

class CreateAmenidadUseCase {
    public function __construct(private AmenidadRepositoryInterface $rep) {}
    public function execute(array $d) { $this->rep->create(new Amenidad(null, $d['nombre'])); }
}