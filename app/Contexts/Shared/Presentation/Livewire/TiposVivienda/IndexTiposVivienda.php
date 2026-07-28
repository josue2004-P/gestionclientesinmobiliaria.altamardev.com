<?php

namespace App\Contexts\Shared\Presentation\Livewire\TiposVivienda;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Shared\Application\UseCases\TiposVivienda\GetTiposViviendaPaginatedUseCase;
use App\Contexts\Shared\Application\UseCases\TiposVivienda\DeleteTipoViviendaUseCase;

class IndexTiposVivienda extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 7;

    public function mount() {
        if (!checkPermiso('tipos_vivienda.is_read')) abort(403, 'Acceso denegado.');
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id) {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar tipo de vivienda?',
            'text'  => 'Esta acción removerá definitivamente este modelo de la lista.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-tipo-vivienda',
        ]);
    }

    #[On('delete-tipo-vivienda')]
    public function deleteTipoVivienda($id, DeleteTipoViviendaUseCase $useCase) {
        if (!checkPermiso('tipos_vivienda.is_update')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'No tienes permisos.']);
            return;
        }
        $useCase->execute((int)$id);
        $this->dispatch('swal-init', ['icon' => 'success', 'title' => 'Eliminado', 'text' => 'Modelo removido correctamente.']);
    }

    public function render(GetTiposViviendaPaginatedUseCase $getUseCase) {
        return view('shared::tipos-vivienda.index', [
            'viviendas' => $getUseCase->execute($this->search, (int)$this->perPage)
        ])->layout('shared::layouts.app')->title('Tipos de Vivienda');
    }
}