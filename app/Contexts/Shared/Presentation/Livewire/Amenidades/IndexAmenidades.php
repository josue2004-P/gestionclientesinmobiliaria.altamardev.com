<?php

namespace App\Contexts\Shared\Presentation\Livewire\Amenidades;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Shared\Application\UseCases\Amenidades\GetAmenidadesPaginatedUseCase;
use App\Contexts\Shared\Application\UseCases\Amenidades\DeleteAmenidadUseCase;

class IndexAmenidades extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 10;

    public function mount() {
        if (!checkPermiso('amenidades.is_read')) abort(403, 'Acceso denegado.');
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id) {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar amenidad?',
            'text'  => 'Esta acción removerá definitivamente la característica.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-amenidad',
        ]);
    }

    #[On('delete-amenidad')]
    public function deleteAmenidad($id, DeleteAmenidadUseCase $useCase) {
        if (!checkPermiso('amenidades.is_update')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'Sin permisos.']);
            return;
        }
        $useCase->execute((int)$id);
        $this->dispatch('swal-init', ['icon' => 'success', 'title' => 'Eliminado', 'text' => 'Amenidad removida correctamente.']);
    }

    public function render(GetAmenidadesPaginatedUseCase $getUseCase) {
        return view('shared::amenidades.index', [
            'amenidades' => $getUseCase->execute($this->search, (int)$this->perPage)
        ])->layout('shared::layouts.app')->title('Amenidades');
    }
}