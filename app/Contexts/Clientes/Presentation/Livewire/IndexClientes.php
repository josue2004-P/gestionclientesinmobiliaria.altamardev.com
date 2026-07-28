<?php

namespace App\Contexts\Clientes\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Contexts\Clientes\Application\UseCases\GetClientesPaginatedUseCase; 
use App\Contexts\Clientes\Application\UseCases\DeleteClienteUseCase;

class IndexClientes extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $perPage = 7;

    public function mount()
    {
        if (!checkPermiso('clientes.is_read')) {
            abort(403, 'Acceso denegado.');
        }
    }

    public function updatedSearch() 
    { 
        $this->resetPage(); 
    }

    public function updatedPerPage() 
    { 
        $this->resetPage(); 
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal-confirm', [
            'title' => '¿Eliminar cliente?',
            'text'  => 'Esta acción eliminará de forma permanente al cliente y todo su expediente.',
            'icon'  => 'warning',
            'id'    => $id,
            'function' => 'delete-cliente',
        ]);
    }

    #[On('delete-cliente')]
    public function deleteCliente($id, DeleteClienteUseCase $useCase)
    {
        if (!checkPermiso('clientes.is_update')) {
            $this->dispatch('swal-init', ['icon' => 'error', 'title' => 'Acceso Denegado', 'text' => 'Sin permisos.']);
            return;
        }

        $useCase->execute((int)$id);
        $this->dispatch('swal-init', ['icon' => 'success', 'title' => 'Eliminado', 'text' => 'El cliente ha sido removido correctamente.']);
    }

    public function render(GetClientesPaginatedUseCase $useCase)
    {
        return view('clientes::index', [
            'clientes' => $useCase->execute(
                search: $this->search, 
                perPage: (int) $this->perPage
            )
        ])
        ->layout('shared::layouts.app')
        ->title('Control de Clientes');
    }
}