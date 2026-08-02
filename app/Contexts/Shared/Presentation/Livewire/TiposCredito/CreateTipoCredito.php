<?php

namespace App\Contexts\Shared\Presentation\Livewire\TiposCredito;

use Livewire\Component;
use App\Contexts\Shared\Application\UseCases\TiposCredito\CreateTipoCreditoUseCase;

class CreateTipoCredito extends Component
{
    public $nombre = '';
    public $descripcion = '';
    public $aplica_vivienda = true;
    public $aplica_cliente = true;

    protected array $rules = [
        'nombre' => 'required|string|max:100',
        'descripcion' => 'nullable|string|max:255',
        'aplica_vivienda' => 'required|boolean',
        'aplica_cliente' => 'required|boolean',
    ];

    public function mount()
    {
        if (!checkPermiso('tipos_credito.is_create')) {
            abort(403, 'Acceso denegado.');
        }
    }

    public function save(CreateTipoCreditoUseCase $useCase)
    {
        $this->validate();

        $useCase->execute([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'aplica_vivienda' => (bool)$this->aplica_vivienda,
            'aplica_cliente' => (bool)$this->aplica_cliente,
        ]);

        session()->flash('success', 'Tipo de crédito registrado exitosamente.');
        return redirect()->route('tipos-credito.index');
    }

    public function render()
    {
        return view('shared::tipos-credito.create')
        ->title('Crear Tipo De Credito')
        ->layout('shared::layouts.app');
    }
}