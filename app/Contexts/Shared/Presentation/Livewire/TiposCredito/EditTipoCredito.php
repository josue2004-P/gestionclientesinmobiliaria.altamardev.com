<?php

namespace App\Contexts\Shared\Presentation\Livewire\TiposCredito;

use Livewire\Component;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoCreditoEloquentModel;
use App\Contexts\Shared\Application\UseCases\TiposCredito\UpdateTipoCreditoUseCase;

class EditTipoCredito extends Component
{
    public $tipoCreditoId;
    public $nombre;
    public $descripcion;
    public $aplica_vivienda;
    public $aplica_cliente;

    public function mount($id)
    {
        if (!checkPermiso('tipos_credito.is_update')) {
            abort(403, 'Acceso denegado.');
        }

        $model = TipoCreditoEloquentModel::findOrFail($id);
        $this->tipoCreditoId = $model->id;
        $this->nombre = $model->nombre;
        $this->descripcion = $model->descripcion;
        $this->aplica_vivienda = (bool)$model->aplica_vivienda;
        $this->aplica_cliente = (bool)$model->aplica_cliente;
    }

    public function save(UpdateTipoCreditoUseCase $useCase)
    {
        $this->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'aplica_vivienda' => 'required|boolean',
            'aplica_cliente' => 'required|boolean',
        ]);

        $useCase->execute($this->tipoCreditoId, [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'aplica_vivienda' => $this->aplica_vivienda,
            'aplica_cliente' => $this->aplica_cliente,
        ]);

        session()->flash('success', 'Tipo de crédito actualizado correctamente.');
        return redirect()->route('tipos-credito.index');
    }

    public function render()
    {
        return view('shared::tipos-credito.edit')
        ->title('Editar Tipo De Credito')
        ->layout('shared::layouts.app');
    }
}