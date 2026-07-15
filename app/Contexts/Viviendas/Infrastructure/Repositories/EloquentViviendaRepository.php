<?php

namespace App\Contexts\Viviendas\Infrastructure\Repositories;

use App\Contexts\Viviendas\Domain\Entities\Vivienda;
use App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface;
use App\Contexts\Viviendas\Infrastructure\LaravelModels\ViviendaEloquentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentViviendaRepository implements ViviendaRepositoryInterface
{
    public function save(Vivienda $vivienda): int
    {
        return DB::transaction(function () use ($vivienda) {
            $model = ViviendaEloquentModel::updateOrCreate(
                ['id' => $vivienda->getId()],
                $vivienda->toArray()
            );

            $model->creditos()->sync($vivienda->getCreditosIds());
            $model->amenidades()->sync($vivienda->getAmenidadesIds());

            return $model->id;
        });
    }

    public function saveContactos(int $viviendaId, array $contactos): void
    {
        DB::transaction(function () use ($viviendaId, $contactos) {
            $model = ViviendaEloquentModel::findOrFail($viviendaId);

            $contactosValidos = array_filter($contactos, function ($c) {
                return !empty($c['nombre']) && !empty($c['telefono']);
            });

            $idsEnviados = array_filter(array_column($contactosValidos, 'id'));

            $model->contactos()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($contactosValidos as $datos) {
                $payload = [
                    'nombre'   => $datos['nombre'],
                    'relacion' => $datos['relacion'] ?? null,
                    'telefono' => $datos['telefono'],
                    'correo'   => $datos['correo'] ?? null,
                    'notes'    => $datos['notes'] ?? null,
                ];

                if (!empty($datos['id'])) {
                    $model->contactos()->where('id', $datos['id'])->update($payload);
                } else {
                    $model->contactos()->create($payload);
                }
            }
        });
    }

    public function delete(int $id): void
    {
        $model = ViviendaEloquentModel::findOrFail($id);
        $model->delete();
    }

    public function findById(int $id): ?Vivienda
    {
        $model = ViviendaEloquentModel::with(['creditos', 'amenidades'])->find($id);
        if (!$model) return null;

        return new Vivienda(
            $model->id,
            $model->fraccionamiento,
            $model->asentamiento_id,
            $model->tipo_vivienda_id,
            $model->precio_lista,
            $model->recamaras,
            $model->direccion,
            $model->llaves,
            $model->estatus_vivienda,
            $model->creditos->pluck('id')->toArray(),
            $model->amenidades->pluck('id')->toArray()
        );
    }

    public function paginateWithSearch(?string $search, ?string $estatus, int $perPage): LengthAwarePaginator
    {
        return ViviendaEloquentModel::query()
            ->with(['asentamiento', 'tipoVivienda'])
            ->when($estatus, function ($query) use ($estatus) {
                $query->where('estatus_vivienda', $estatus);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('fraccionamiento', 'like', '%' . $search . '%')
                      ->orWhere('direccion', 'like', '%' . $search . '%');
            })
            ->paginate($perPage);
    }
}