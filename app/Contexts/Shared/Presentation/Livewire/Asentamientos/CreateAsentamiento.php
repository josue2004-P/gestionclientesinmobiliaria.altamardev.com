<?php

namespace App\Contexts\Shared\Presentation\Livewire\Asentamientos;

use Livewire\Component;
use App\Contexts\Shared\Application\UseCases\Asentamientos\CreateAsentamientoUseCase;

class CreateAsentamiento extends Component
{
    public $codigo_postal = '';
    public $estado = '';
    public $municipio = '';
    public $ciudad = '';
    public $tipo_asentamiento = '';
    public $nombre_asentamiento = '';

    protected array $rules = [
        'codigo_postal' => 'required|string|max:10',
        'estado' => 'required|string|max:100',
        'municipio' => 'required|string|max:100',
        'ciudad' => 'nullable|string|max:100',
        'tipo_asentamiento' => 'required|string|max:50',
        'nombre_asentamiento' => 'required|string|max:150',
    ];

    public function save(CreateAsentamientoUseCase $useCase)
    {
        $this->validate();

        $useCase->execute([
            'codigo_postal' => $this->codigo_postal,
            'estado' => $this->estado,
            'municipio' => $this->municipio,
            'ciudad' => $this->ciudad,
            'tipo_asentamiento' => $this->tipo_asentamiento,
            'nombre_asentamiento' => $this->nombre_asentamiento,
        ]);

        session()->flash('success', 'Asentamiento registrado exitosamente.');
        return redirect()->route('asentamientos.index');
    }

    public function render()
    {
        return view('shared::asentamientos.create')
        ->title('Crear Asentamiento')
        ->layout('shared::layouts.app');
    }
}