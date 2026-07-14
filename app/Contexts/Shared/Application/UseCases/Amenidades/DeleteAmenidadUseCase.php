<?php
namespace App\Contexts\Shared\Application\UseCases\Amenidades;
use App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface;

class DeleteAmenidadUseCase {
    public function __construct(private AmenidadRepositoryInterface $rep) {}
    public function execute(int $id) { $this->rep->delete($id); }
}