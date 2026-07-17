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

    public function saveDocumentos(int $viviendaId, array $documentos): void
    {
        DB::transaction(function () use ($viviendaId, $documentos) {
            $model = ViviendaEloquentModel::findOrFail($viviendaId);

            $documentosValidos = array_filter($documentos, function ($d) {
                return !empty($d['url']) && !empty($d['tipo_documento']);
            });

            $idsEnviados = array_filter(array_column($documentosValidos, 'id'));

            $model->documentos()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($documentosValidos as $datos) {
                $model->documentos()->updateOrCreate(
                    ['id' => $datos['id'] ?? null],
                    [
                        'url'             => $datos['url'],
                        'nombre_original' => $datos['nombre_original'] ?? null,
                        'tipo_documento'  => $datos['tipo_documento'],
                        'peso_bytes'      => $datos['peso_bytes'] ?? null,
                        'verificado'      => (bool)($datos['verificado'] ?? false),
                    ]
                );
            }
        });
    }

    public function saveFotos(int $viviendaId, array $fotos): void
    {
        DB::transaction(function () use ($viviendaId, $fotos) {
            $model = ViviendaEloquentModel::findOrFail($viviendaId);

            $fotosValidas = array_filter($fotos, function ($f) {
                return !empty($f['url']);
            });

            $idsEnviados = array_filter(array_column($fotosValidas, 'id'));

            $model->fotos()->whereNotIn('id', $idsEnviados)->delete();

            foreach ($fotosValidas as $index => $datos) {
                $model->fotos()->updateOrCreate(
                    ['id' => $datos['id'] ?? null],
                    [
                        'url'             => $datos['url'],
                        'nombre_original' => $datos['nombre_original'] ?? null,
                        'orden'           => $datos['orden'] ?? $index,
                        'es_principal'    => (bool)($datos['es_principal'] ?? false),
                    ]
                );
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
        $model = ViviendaEloquentModel::with(['creditos', 'amenidades', 'contactos', 'documentos', 'fotos'])->find($id);
        if (!$model) {
            return null;
        }

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
            $model->amenidades->pluck('id')->toArray(),
            // Transformamos colecciones Eloquent en matrices primitivas asociativas limpias
            $model->contactos->map(fn($c) => [
                'id' => $c->id, 'nombre' => $c->nombre, 'relacion' => $c->relacion, 'telefono' => $c->telefono, 'correo' => $c->correo, 'notes' => $c->notes
            ])->toArray(),
            $model->documentos->map(fn($d) => [
                'id' => $d->id, 'url' => $d->url, 'nombre_original' => $d->nombre_original, 'tipo_documento' => $d->tipo_documento, 'peso_bytes' => $d->peso_bytes, 'verificado' => (bool)$d->verificado
            ])->toArray(),
            $model->fotos->sortBy('orden')->map(fn($f) => [
                'id' => $f->id, 'url' => $f->url, 'nombre_original' => $f->nombre_original, 'orden' => $f->orden, 'es_principal' => (bool)$f->es_principal, 'preview' => null
            ])->toArray()
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