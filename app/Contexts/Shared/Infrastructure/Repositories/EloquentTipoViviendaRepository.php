<?php

namespace App\Contexts\Shared\Infrastructure\Repositories;

use App\Contexts\Shared\Domain\Entities\TipoVivienda;
use App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoViviendaEloquentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentTipoViviendaRepository implements TipoViviendaRepositoryInterface
{
    public function all(): array
    {
        $models = TipoViviendaEloquentModel::select('id', 'nombre', 'descripcion')
            ->orderBy('nombre', 'asc')
            ->get();

        return $models->map(function ($model) {
            return new TipoVivienda(
                $model->id,
                $model->nombre,
                $model->descripcion 
            );
        })->toArray();
    }
    
    public function create(TipoVivienda $tipoVivienda): void
    {
        TipoViviendaEloquentModel::create($tipoVivienda->toArray());
    }

    public function update(int $id, array $data): void
    {
        $model = TipoViviendaEloquentModel::findOrFail($id);
        $model->update($data);
    }

    public function delete(int $id): void
    {
        $model = TipoViviendaEloquentModel::findOrFail($id);
        $model->delete();
    }

    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator
    {
        return TipoViviendaEloquentModel::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('descripcion', 'like', '%' . $search . '%');
            })
            ->paginate($perPage);
    }
}