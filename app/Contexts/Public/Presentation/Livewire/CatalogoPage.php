<?php

namespace App\Contexts\Public\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

use App\Contexts\Viviendas\Infrastructure\LaravelModels\ViviendaEloquentModel;

// CASOS DE USO REUTILIZADOS DEL BOUNDED CONTEXT SHARED
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueEstadosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueMunicipiosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueCiudadesUseCase;
use App\Contexts\Shared\Application\UseCases\TiposVivienda\GetTiposViviendaForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\Amenidades\GetAmenidadesForSelectUseCase;


class CatalogoPage extends Component
{
    use WithPagination;

    // Buscador general
    #[Url(history: true, keep: true)]
    public $search = '';

    // Filtros de Ubicación en Cadena
    #[Url(keep: true)]
    public $selectedEstado = '';

    #[Url(keep: true)]
    public $selectedMunicipio = '';

    #[Url(keep: true)]
    public $selectedCiudad = '';

    // Filtros Técnicos y de Inmueble
    #[Url(keep: true)]
    public $estatus = '';

    #[Url(keep: true)]
    public $tipo_vivienda_id = [];

    #[Url(keep: true)]
    public $recamaras = 0;

    #[Url(keep: true)]
    public $precio_max = '';

    #[Url(keep: true)]
    public $amenidades = [];

    #[Url(keep: true)]
    public $sort = 'recent';

    // ==========================================
    // PROPIEDADES COMPUTADAS (CASOS DE USO)
    // ==========================================

    #[Computed]
    public function estados()
    {
        return app(GetUniqueEstadosUseCase::class)->execute();
    }

    #[Computed]
    public function municipios()
    {
        return app(GetUniqueMunicipiosUseCase::class)->execute($this->selectedEstado);
    }

    #[Computed]
    public function ciudades()
    {
        return app(GetUniqueCiudadesUseCase::class)->execute($this->selectedEstado, $this->selectedMunicipio);
    }

    #[Computed]
    public function tiposVivienda()
    {
        return app(GetTiposViviendaForSelectUseCase::class)->execute();
    }

    #[Computed]
    public function amenidadesDisponibles()
    {
        return app(GetAmenidadesForSelectUseCase::class)->execute();
    }

    // ==========================================
    // LISTENERS Y CASCADA DE FILTROS DE UBICACIÓN
    // ==========================================

    public function updatedSelectedEstado()
    {
        $this->selectedMunicipio = '';
        $this->selectedCiudad = '';
        $this->resetPage();
    }

    public function updatedSelectedMunicipio()
    {
        $this->selectedCiudad = '';
        $this->resetPage();
    }

    public function updatedSelectedCiudad()
    {
        $this->resetPage();
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingEstatus() { $this->resetPage(); }
    public function updatingTipoViviendaId() { $this->resetPage(); }
    public function updatingRecamaras() { $this->resetPage(); }
    public function updatingPrecioMax() { $this->resetPage(); }
    public function updatingAmenidades() { $this->resetPage(); }
    public function updatingSort() { $this->resetPage(); }

    public function limpiarFiltros()
    {
        $this->reset([
            'search', 
            'selectedEstado', 
            'selectedMunicipio', 
            'selectedCiudad', 
            'estatus', 
            'tipo_vivienda_id', 
            'recamaras', 
            'precio_max', 
            'amenidades', 
            'sort'
        ]);
        $this->resetPage();
    }

    // ==========================================
    // RENDERIZADO DEL CATÁLOGO
    // ==========================================

    public function render()
    {
        $query = ViviendaEloquentModel::query()
            ->with(['asentamiento', 'tipoVivienda', 'fotos', 'amenidades']);

        // Buscador ID / Fraccionamiento / Dirección
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

        // Cadena de Ubicación en Cascada mediante relación Asentamiento
        if (!empty($this->selectedEstado)) {
            $query->whereHas('asentamiento', function ($q) {
                $q->where('estado', $this->selectedEstado);

                if (!empty($this->selectedMunicipio)) {
                    $q->where('municipio', $this->selectedMunicipio);
                }

                if (!empty($this->selectedCiudad)) {
                    $q->where('ciudad', $this->selectedCiudad);
                }
            });
        }

        // Filtro Tipos de Vivienda
        if (!empty($this->tipo_vivienda_id)) {
            $query->whereIn('tipo_vivienda_id', (array) $this->tipo_vivienda_id);
        }

        // Filtro Recámaras Mínimas
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

        return view('public::catalogo-page', [
            'viviendas' => $query->paginate(9)
        ])
        ->layout('shared::layouts.public-catalogo')
        ->title('Catálogo de Inmuebles');
    }
}