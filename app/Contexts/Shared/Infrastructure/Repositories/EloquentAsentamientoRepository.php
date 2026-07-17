<?php

namespace App\Contexts\Shared\Infrastructure\Repositories;

use App\Contexts\Shared\Domain\Entities\Asentamiento;
use App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface;
use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EloquentAsentamientoRepository implements AsentamientoRepositoryInterface
{
    private string $cacheKey = 'catalogo_asentamientos_entities_ram';

    public function all(): array
    {
        $rawArray = Cache::get($this->cacheKey);
        $necesitaRecargar = false;

        if (is_array($rawArray)) {
            foreach ($rawArray as $item) {
                if (!is_array($item)) {
                    $necesitaRecargar = true;
                    break;
                }
            }
        } else {
            $necesitaRecargar = true;
        }

        if ($necesitaRecargar) {
            $rawArray = AsentamientoEloquentModel::orderBy('nombre_asentamiento', 'asc')
                ->select(['id', 'codigo_postal', 'estado', 'municipio', 'tipo_asentamiento', 'nombre_asentamiento', 'ciudad'])
                ->get()
                ->toArray();

            Cache::forever($this->cacheKey, $rawArray);
        }

        return array_map(function ($data) {
            return new Asentamiento(
                isset($data['id']) ? (int)$data['id'] : null,
                (string)($data['codigo_postal'] ?? ''),
                (string)($data['estado'] ?? 'Sin Estado'),
                (string)($data['municipio'] ?? 'Sin Municipio'), 
                (string)($data['tipo_asentamiento'] ?? 'Colonia'),
                (string)($data['nombre_asentamiento'] ?? 'Sin Nombre'),
                !empty($data['ciudad']) ? (string)$data['ciudad'] : null 
            );
        }, $rawArray);
    }

    public function searchForSelect(?string $search, ?int $selectedId, ?string $estado = null, ?string $municipio = null, ?string $ciudad = null): array
    {
        $query = AsentamientoEloquentModel::query();

        if (!empty($estado)) {
            $query->where('estado', $estado);
        }
        if (!empty($municipio)) {
            $query->where('municipio', $municipio);
        }
        if (!empty($ciudad)) {
            $query->where('ciudad', $ciudad);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('codigo_postal', 'like', $search . '%')
                  ->orWhere('nombre_asentamiento', 'like', '%' . $search . '%');
            });
        } elseif (!empty($selectedId)) {
            $query->where('id', $selectedId);
        } else {
            if (empty($estado) && empty($municipio) && empty($ciudad)) {
                return [];
            }
        }

        $models = $query->orderBy('nombre_asentamiento', 'asc')->get();

        if (!empty($search) && !empty($selectedId) && !$models->contains('id', $selectedId)) {
            $selectedModel = AsentamientoEloquentModel::find($selectedId);
            if ($selectedModel) {
                $models->push($selectedModel);
            }
        }

        return $models->map(function ($model) {
            return new Asentamiento(
                $model->id,
                $model->codigo_postal,
                $model->estado ?? 'Sin Estado',
                $model->municipio ?? 'Sin Municipio',
                $model->tipo_asentamiento ?? 'Colonia',
                $model->nombre_asentamiento ?? 'Sin Nombre',
                $model->ciudad
            );
        })->toArray();
    }

    public function getUniqueEstados(): array
    {
        return Cache::rememberForever('geo_estados_unicos', function () {
            return AsentamientoEloquentModel::query()
                ->whereNotNull('estado')
                ->where('estado', '!=', '')
                ->distinct()
                ->orderBy('estado', 'asc')
                ->pluck('estado')
                ->toArray();
        });
    }

    public function getUniqueMunicipios(?string $estado = null): array
    {
        if (empty($estado)) return [];

        $cacheKey = 'geo_municipios_de_' . md5($estado);
        
        return Cache::remember($cacheKey, now()->addDays(7), function () use ($estado) {
            return AsentamientoEloquentModel::query()
                ->whereNotNull('municipio')
                ->where('municipio', '!=', '')
                ->where('estado', $estado)
                ->distinct()
                ->orderBy('municipio', 'asc')
                ->pluck('municipio')
                ->toArray();
        });
    }

    public function getUniqueCiudades(?string $estado = null, ?string $municipio = null): array
    {
        if (empty($estado) || empty($municipio)) return [];

        $cacheKey = 'geo_ciudades_de_' . md5($estado . '_' . $municipio);

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($estado, $municipio) {
            return AsentamientoEloquentModel::query()
                ->whereNotNull('ciudad')
                ->where('ciudad', '!=', '')
                ->where('estado', $estado)
                ->where('municipio', $municipio)
                ->distinct()
                ->orderBy('ciudad', 'asc')
                ->pluck('ciudad')
                ->toArray();
        });
    }

    public function create(Asentamiento $asentamiento): void
    {
        AsentamientoEloquentModel::create($asentamiento->toArray());
        Cache::forget($this->cacheKey);
    }

    public function bulkInsert(array $asentamientos): void
    {
        AsentamientoEloquentModel::insert($asentamientos);
        Cache::forget($this->cacheKey);
    }

    public function delete(int $id): void
    {
        $model = AsentamientoEloquentModel::findOrFail($id);
        $model->delete();
        Cache::forget($this->cacheKey);
    }

    public function findDuplicate(string $codigoPostal, string $nombreAsentamiento, string $tipoAsentamiento): ?Asentamiento
    {
        $model = AsentamientoEloquentModel::where('codigo_postal', $codigoPostal)
            ->where('nombre_asentamiento', $nombreAsentamiento)
            ->where('tipo_asentamiento', $tipoAsentamiento)
            ->first();

        if (!$model) {
            return null;
        }

        return new Asentamiento(
            $model->id,
            $model->codigo_postal,
            $model->estado,
            $model->municipio,
            $model->tipo_asentamiento,
            $model->nombre_asentamiento,
            $model->ciudad
        );
    }
    
    public function findByCodigoPostal(string $codigoPostal): array
    {
        $models = AsentamientoEloquentModel::where('codigo_postal', $codigoPostal)->get();

        return $models->map(function ($model) {
            return new Asentamiento(
                $model->id,
                $model->codigo_postal,
                $model->estado,
                $model->municipio,
                $model->tipo_asentamiento,
                $model->nombre_asentamiento,
                $model->ciudad
            );
        })->toArray();
    }

    public function paginateWithSearch(?string $search, int $perPage): LengthAwarePaginator
    {
        return AsentamientoEloquentModel::query()
            ->when($search, function ($query) use ($search) {
                $query->where('codigo_postal', 'like', '%' . $search . '%')
                    ->orWhere('nombre_asentamiento', 'like', '%' . $search . '%')
                    ->orWhere('municipio', 'like', '%' . $search . '%')
                    ->orWhere('estado', 'like', '%' . $search . '%');
            })
            ->paginate($perPage);
    }
}