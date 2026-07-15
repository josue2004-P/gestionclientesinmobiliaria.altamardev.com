<?php

namespace App\Contexts\Viviendas\Presentation\Livewire;

use Livewire\Component;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaUseCase;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaContactosUseCase;
use App\Contexts\Shared\Infrastructure\LaravelModels\AsentamientoEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoViviendaEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\TipoCreditoEloquentModel;
use App\Contexts\Shared\Infrastructure\LaravelModels\AmenidadEloquentModel;

class CreateVivienda extends Component
{
    public $asentamientos = [];
    public $tiposVivienda = [];
    public $creditosDisponibles = [];
    public $amenidadesDisponibles = [];

    public $fraccionamiento = '';
    public $asentamiento_id = '';
    public $tipo_vivienda_id = '';
    public $precio_lista = '';
    public $recamaras = 0;
    public $direccion = '';
    public $llaves = false;
    public $estatus_vivienda = 'Disponible';
    public $creditos_ids = [];
    public $amenidades_ids = [];

    public array $contactos = [];

    protected array $rules = [
        'fraccionamiento'  => 'nullable|string|max:255',
        'asentamiento_id'  => 'required|exists:asentamientos,id',
        'tipo_vivienda_id' => 'required|exists:tipos_vivienda,id',
        'precio_lista'     => 'required|numeric|min:0',
        'recamaras'        => 'required|integer|min:0',
        'direccion'        => 'required|string',
        'llaves'           => 'required|boolean',
        'estatus_vivienda' => 'required|in:Disponible,Apartada,Vendida,Rentada,Mantenimiento,Suspendida',
        'creditos_ids'     => 'nullable|array',
        'amenidades_ids'   => 'nullable|array',
    ];

    public function mount()
    {
        if (!checkPermiso('viviendas.is_create')) abort(403);
        
        $this->asentamientos = AsentamientoEloquentModel::select('id', 'codigo_postal', 'nombre_asentamiento')->get();
        $this->tiposVivienda = TipoViviendaEloquentModel::select('id', 'nombre')->get();
        $this->creditosDisponibles = TipoCreditoEloquentModel::where('aplica_vivienda', true)->select('id', 'nombre')->get();
        $this->amenidadesDisponibles = AmenidadEloquentModel::select('id', 'nombre')->get();

        $this->addContacto();
    }

    public function addContacto()
    {
        $this->contactos[] = [
            'id'       => null, 
            'nombre'   => '', 
            'relacion' => '', 
            'telefono' => '', 
            'correo'   => '', 
            'notes'    => ''
        ];
    }

    public function removeContacto($index)
    {
        unset($this->contactos[$index]);
        $this->contactos = array_values($this->contactos);
    }

    public function save(SaveViviendaUseCase $useCase, SaveViviendaContactosUseCase $contactosUseCase)
    {
        $this->validate();

        $viviendaId = $useCase->execute([
            'fraccionamiento'  => $this->fraccionamiento,
            'asentamiento_id'  => $this->asentamiento_id,
            'tipo_vivienda_id' => $this->tipo_vivienda_id,
            'precio_lista'     => $this->precio_lista,
            'recamaras'        => $this->recamaras,
            'direccion'        => $this->direccion,
            'llaves'           => (bool)$this->llaves,
            'estatus_vivienda' => $this->estatus_vivienda,
            'creditos_ids'     => $this->creditos_ids,
            'amenidades_ids'   => $this->amenidades_ids,
        ]);

        $contactosUseCase->execute($viviendaId, $this->contactos);

        session()->flash('success', 'Ficha técnica de la propiedad generada correctamente.');
        return redirect()->route('viviendas.index');
    }

    public function render()
    {
        return view('viviendas::create')
            ->layout('shared::layouts.app')
            ->title('Registrar Inmueble');
    }
}