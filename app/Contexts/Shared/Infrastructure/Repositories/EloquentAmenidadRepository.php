<?php

namespace App\Contexts\Shared\Infrastructure\Repositories;

use App\Contexts\Shared\Domain\Entities\Amenidad;
use App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface;
use App\Contexts\Shared\Infrastructure\LaravelModels\AmenidadEloquentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentAmenidadRepository implements AmenidadRepositoryInterface
{
    public function all(): array
    {
        $models = AmenidadEloquentModel::select('id', 'nombre')->orderBy('nombre', 'asc')->get();

        return $models->map(function ($model) {
            return new Amenidad(
                $model->id,
                $model->nombre
            );
        })->toArray();
    }
    
    public function create(Amenidad $amenidad): void
    {
        AmenidadEloquentModel::create($amenidad->toArray());
    }

    public function update(int $id, array $data): void
    {
        $model = AmenidadEloquentModel::findOrFail($id);
        $model->update($data);
    }

    public function delete(int $id): void
    {
        $model = AmenidadEloquentModel::findOrFail($id);
        $model->delete();
    }

    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator
    {
        return AmenidadEloquentModel::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->paginate($perPage);
    }
}