<?php

namespace App\Contexts\Viviendas\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Viviendas\Application\UseCases\GetViviendasPaginatedUseCase;
use App\Contexts\Viviendas\Application\UseCases\DeleteViviendaUseCase;

class IndexViviendas extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $estatus = '';

    #[Url(keep: true)]
    public $perPage = 10;

    public function mount()
    {
        if (!checkPermiso('viviendas.is_read')) {
            abort(403, 'Acceso denegado.');
        }
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedEstatus() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar propiedad?',
            'text'  => 'Esta acción eliminará de forma permanente la ficha y todo su expediente.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-vivienda',
        ]);
    }

    #[On('delete-vivienda')]
    public function deleteVivienda($id, DeleteViviendaUseCase $useCase)
    {
        if (!checkPermiso('viviendas.is_update')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'Sin permisos.']);
            return;
        }

        $useCase->execute((int)$id);
        $this->dispatch('swal-init', ['icon' => 'success', 'title' => 'Eliminada', 'text' => 'La propiedad ha sido removida del inventario.']);
    }

    public function render(GetViviendasPaginatedUseCase $getUseCase)
    {
        return view('viviendas::index', [
            'viviendas' => $getUseCase->execute($this->search, $this->estatus, (int)$this->perPage)
        ])
        ->layout('shared::layouts.app')
        ->title('Inventario de Inmuebles');
    }
}