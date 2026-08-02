<?php

namespace App\Contexts\Shared\Presentation\Livewire\Asentamientos;

use Livewire\Component;
use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;

class EditAsentamiento extends Component
{
    public $asentamientoId;
    public $codigo_postal;
    public $estado;
    public $municipio;
    public $ciudad;
    public $tipo_asentamiento;
    public $nombre_asentamiento;

    public function mount($id)
    {
        $model = AsentamientoEloquentModel::findOrFail($id);
        $this->asentamientoId = $model->id;
        $this->codigo_postal = $model->codigo_postal;
        $this->estado = $model->estado;
        $this->municipio = $model->municipio;
        $this->ciudad = $model->ciudad;
        $this->tipo_asentamiento = $model->tipo_asentamiento;
        $this->nombre_asentamiento = $model->nombre_asentamiento;
    }

    public function save()
    {
        $this->validate([
            'codigo_postal' => 'required|string|max:10',
            'estado' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'tipo_asentamiento' => 'required|string|max:50',
            'nombre_asentamiento' => 'required|string|max:150',
        ]);

        $model = AsentamientoEloquentModel::findOrFail($this->asentamientoId);
        $model->update([
            'codigo_postal' => $this->codigo_postal,
            'estado' => $this->estado,
            'municipio' => $this->municipio,
            'ciudad' => $this->ciudad,
            'tipo_asentamiento' => $this->tipo_asentamiento,
            'nombre_asentamiento' => $this->nombre_asentamiento,
        ]);

        session()->flash('success', 'Asentamiento actualizado correctamente.');
        return redirect()->route('asentamientos.index');
    }

    public function render()
    {
        return view('shared::asentamientos.edit')
        ->title('Editar Asentamiento')
        ->layout('shared::layouts.app');
    }
}