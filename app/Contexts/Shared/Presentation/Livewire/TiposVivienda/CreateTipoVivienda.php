<?php

namespace App\Contexts\Shared\Presentation\Livewire\TiposVivienda;

use Livewire\Component;
use App\Contexts\Shared\Application\UseCases\TiposVivienda\CreateTipoViviendaUseCase;

class CreateTipoVivienda extends Component
{
    public $nombre = '';
    public $descripcion = '';

    protected array $rules = [
        'nombre' => 'required|string|max:100',
        'descripcion' => 'nullable|string|max:255',
    ];

    public function save(CreateTipoViviendaUseCase $useCase) {
        $this->validate();
        $useCase->execute(['nombre' => $this->nombre, 'descripcion' => $this->descripcion]);
        session()->flash('success', 'Tipo de vivienda registrado.');
        return redirect()->route('tipos-vivienda.index');
    }

    public function render() { return view('shared::tipos-vivienda.create')
        ->title('Crear Tipo De Vivienda')
        ->layout('shared::layouts.app'); }
}