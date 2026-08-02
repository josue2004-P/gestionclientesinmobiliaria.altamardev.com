<?php

namespace App\Contexts\Shared\Presentation\Livewire\TiposVivienda;

use Livewire\Component;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoViviendaEloquentModel;
use App\Contexts\Shared\Application\UseCases\TiposVivienda\UpdateTipoViviendaUseCase;

class EditTipoVivienda extends Component
{
    public $tipoViviendaId;
    public $nombre;
    public $descripcion;

    public function mount($id) {
        $model = TipoViviendaEloquentModel::findOrFail($id);
        $this->tipoViviendaId = $model->id;
        $this->nombre = $model->nombre;
        $this->descripcion = $model->descripcion;
    }

    public function save(UpdateTipoViviendaUseCase $useCase) {
        $this->validate(['nombre' => 'required|string|max:100', 'descripcion' => 'nullable|string|max:255']);
        $useCase->execute($this->tipoViviendaId, ['nombre' => $this->nombre, 'descripcion' => $this->descripcion]);
        session()->flash('success', 'Tipo de vivienda actualizado.');
        return redirect()->route('tipos-vivienda.index');
    }

    public function render() { return view('shared::tipos-vivienda.edit')
        ->title('Editar Tipo De Vivienda')
        ->layout('shared::layouts.app'); }
}