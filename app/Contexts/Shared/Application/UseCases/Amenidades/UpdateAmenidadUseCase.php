<?php
namespace App\Contexts\Shared\Application\UseCases\Amenidades;
use App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface;

class UpdateAmenidadUseCase {
    public function __construct(private AmenidadRepositoryInterface $rep) {}
    public function execute(int $id, array $d) { $this->rep->update($id, ['nombre' => $d['nombre']]); }
}