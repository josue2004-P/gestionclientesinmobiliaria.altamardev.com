<?php

namespace App\Contexts\Public\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Contexts\Viviendas\Infrastructure\LaravelModels\ViviendaEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoViviendaEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\AmenidadEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;

class CatalogoPage extends Component
{
    use WithPagination;

    // Propiedades de Filtros
    public $search = '';
    public $estatus = '';
    public $municipio = '';
    public $tipo_vivienda_id = [];
    public $recamaras = 0;
    public $precio_max = '';
    public $amenidades = [];
    public $sort = 'recent';

    protected $queryString = [
        'search'           => ['except' => ''],
        'estatus'          => ['except' => ''],
        'municipio'        => ['except' => ''],
        'tipo_vivienda_id' => ['except' => []],
        'recamaras'        => ['except' => 0],
        'precio_max'       => ['except' => ''],
        'amenidades'       => ['except' => []],
        'sort'             => ['except' => 'recent'],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingEstatus() { $this->resetPage(); }
    public function updatingMunicipio() { $this->resetPage(); }
    public function updatingTipoViviendaId() { $this->resetPage(); }
    public function updatingRecamaras() { $this->resetPage(); }
    public function updatingPrecioMax() { $this->resetPage(); }
    public function updatingAmenidades() { $this->resetPage(); }
    public function updatingSort() { $this->resetPage(); }

    public function limpiarFiltros()
    {
        $this->reset(['search', 'estatus', 'municipio', 'tipo_vivienda_id', 'recamaras', 'precio_max', 'amenidades', 'sort']);
        $this->resetPage();
    }

    public function render()
    {
        $query = ViviendaEloquentModel::query()
            ->with(['asentamiento', 'tipoVivienda', 'fotos', 'amenidades']);

        // Buscador
        if (!empty($this->search)) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('fraccionamiento', 'LIKE', "%{$search}%")
                  ->orWhere('direccion', 'LIKE', "%{$search}%");
            });
        }

        // Filtro Estatus
        if (!empty($this->estatus)) {
            $query->where('estatus_vivienda', $this->estatus);
        }

        // Filtro Municipio
        if (!empty($this->municipio)) {
            $query->whereHas('asentamiento', function ($q) {
                $q->where('municipio', $this->municipio);
            });
        }

        // Filtro Tipos de Vivienda
        if (!empty($this->tipo_vivienda_id)) {
            $query->whereIn('tipo_vivienda_id', (array) $this->tipo_vivienda_id);
        }

        // Filtro Recámaras
        if ($this->recamaras > 0) {
            $query->where('recamaras', '>=', (int) $this->recamaras);
        }

        // Filtro Precio Máximo
        if (!empty($this->precio_max)) {
            $query->where('precio_lista', '<=', (float) $this->precio_max);
        }

        // Filtro Amenidades
        if (!empty($this->amenidades)) {
            $amenidadIds = (array) $this->amenidades;
            $query->whereHas('amenidades', function ($q) use ($amenidadIds) {
                $q->whereIn('amenidades.id', $amenidadIds);
            });
        }

        // Ordenamiento
        match ($this->sort) {
            'price_asc'  => $query->orderBy('precio_lista', 'asc'),
            'price_desc' => $query->orderBy('precio_lista', 'desc'),
            default      => $query->orderBy('created_at', 'desc'),
        };

        $viviendas = $query->paginate(9);

        // Catálogos auxiliares para los filtros
        $municipios = AsentamientoEloquentModel::distinct()->pluck('municipio')->filter()->values();
        $tiposVivienda = TipoViviendaEloquentModel::all();
        $amenidadesList = AmenidadEloquentModel::all();

        return view('public::catalogo-page', [
            'viviendas'     => $viviendas,
            'municipios'    => $municipios,
            'tiposVivienda' => $tiposVivienda,
            'amenidadesList' => $amenidadesList,
        ])->layout('shared::layouts.public-catalogo');
    }
}