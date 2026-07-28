<?php

namespace App\Contexts\Shared\Presentation\Livewire\TiposCredito;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Shared\Application\UseCases\TiposCredito\GetTiposCreditoPaginatedUseCase;
use App\Contexts\Shared\Application\UseCases\TiposCredito\DeleteTipoCreditoUseCase;

class IndexTiposCredito extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 7;

    public function mount()
    {
        if (!checkPermiso('tipos_credito.is_read')) {
            abort(403, 'Acceso denegado.');
        }
    }

    public function updatedSearch() { $this->resetPage(); }
    public function updatedPerPage() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar tipo de crédito?',
            'text'  => 'Esta acción removerá permanentemente este catálogo financiero.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-tipo-credito',
        ]);
    }

    #[On('delete-tipo-credito')]
    public function deleteTipoCredito($id, DeleteTipoCreditoUseCase $useCase)
    {
        if (!checkPermiso('tipos_credito.is_update')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'No tienes permisos para modificar catálogos.']);
            return;
        }

        $useCase->execute((int)$id);
        $this->dispatch('swal-init', ['icon' => 'success', 'title' => 'Eliminado', 'text' => 'El tipo de crédito ha sido eliminado correctamente.']);
    }

    public function render(GetTiposCreditoPaginatedUseCase $getUseCase)
    {
        return view('shared::tipos-credito.index', [
            'creditos' => $getUseCase->execute($this->search, (int)$this->perPage)
        ])
        ->layout('shared::layouts.app') 
        ->title('Tipos de Crédito');
    }
}