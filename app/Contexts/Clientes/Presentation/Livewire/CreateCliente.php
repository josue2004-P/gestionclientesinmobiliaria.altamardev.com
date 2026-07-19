<?php

namespace App\Contexts\Clientes\Presentation\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Contexts\Clientes\Application\UseCases\SaveClienteUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetAsentamientosForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueEstadosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueMunicipiosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueCiudadesUseCase;
use App\Contexts\Shared\Application\UseCases\TiposCredito\GetTiposCreditoForSelectUseCase;

class CreateCliente extends Component
{
    public string $searchAsentamiento = '';
    public string $selectedEstado = '';
    public string $selectedMunicipio = '';
    public string $selectedCiudad = '';
    public string $nombre = '';
    public string $apellido_paterno = '';
    public string $apellido_materno = '';
    public ?string $fecha_nacimiento = null;
    public ?string $rfc = null;
    public ?string $curp = null;
    public $asentamiento_id = null;
    public ?string $calle_numero = null;
    public ?string $nss = null;
    public ?string $correo_infonavit = null;
    public ?string $contrasena_infonavit = null;
    public $tipo_credito_id = null;
    public float $precalificacion = 0.0;
    public string $avaluo_solicitado = 'No';
    public ?string $estado_civil = null;
    public ?string $regimen_casamiento = null;

    public array $zonas_ids = [];

    public function mount()
    {
        if (!checkPermiso('clientes.is_update')) {
            abort(403, 'Acceso denegado.');
        }
    }

    #[Computed]
    public function estados()
    {
        return app(GetUniqueEstadosUseCase::class)->execute();
    }

    #[Computed]
    public function municipios()
    {
        return app(GetUniqueMunicipiosUseCase::class)->execute($this->selectedEstado);
    }

    #[Computed]
    public function ciudades()
    {
        return app(GetUniqueCiudadesUseCase::class)->execute($this->selectedEstado, $this->selectedMunicipio);
    }

    #[Computed]
    public function asentamientos()
    {
        return app(GetAsentamientosForSelectUseCase::class)->execute(
            $this->searchAsentamiento, 
            (int)$this->asentamiento_id,
            $this->selectedEstado,
            $this->selectedMunicipio,
            $this->selectedCiudad
        );
    }

    #[Computed]
    public function tiposCredito()
    {
        return app(GetTiposCreditoForSelectUseCase::class)->execute('cliente');
    }

    public function updatedSelectedEstado()
    {
        $this->selectedMunicipio = '';
        $this->selectedCiudad = '';
        $this->asentamiento_id = null;
    }

    public function updatedSelectedMunicipio()
    {
        $this->selectedCiudad = '';
        $this->asentamiento_id = null;
    }

    public function updatedSelectedCiudad()
    {
        $this->asentamiento_id = null;
    }

    protected function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'rfc' => 'nullable|string|max:13|unique:clientes,rfc',
            'curp' => 'nullable|string|max:18|unique:clientes,curp',
            'asentamiento_id' => 'nullable|integer|exists:asentamientos,id',
            'calle_numero' => 'nullable|string|max:255',
            'nss' => 'nullable|string|max:15',
            'correo_infonavit' => 'nullable|email|max:255',
            'contrasena_infonavit' => 'nullable|string|max:255',
            'tipo_credito_id' => 'nullable|integer',
            'precalificacion' => 'numeric|min:0',
            'avaluo_solicitado' => 'required|in:Sí,No',
            'estado_civil' => 'nullable|in:Soltero,Casado,Divorciado,Viudo,Union_Libre',
            'regimen_casamiento' => 'nullable|string|max:100',
            'zonas_ids' => 'nullable|array',
            'zonas_ids.*' => 'integer|exists:asentamientos,id',
        ];
    }

    public function store(SaveClienteUseCase $saveClienteUseCase)
    {
        $validatedData = $this->validate();
        
        $validatedData['asentamiento_id'] = $validatedData['asentamiento_id'] ? (int)$validatedData['asentamiento_id'] : null;
        $validatedData['tipo_credito_id'] = $validatedData['tipo_credito_id'] ? (int)$validatedData['tipo_credito_id'] : null;
        $validatedData['zonas_interes'] = $this->zonas_ids;

        try {
            $saveClienteUseCase->execute($validatedData);

            $this->dispatch('swal-init', [
                'icon' => 'success',
                'title' => '¡Éxito!',
                'text' => 'El cliente ha sido registrado correctamente.'
            ]);

            return redirect()->route('clientes.index');

        } catch (\Exception $e) {
            $this->dispatch('swal-init', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Ocurrió un fallo en el servidor: ' . $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('clientes::create')
            ->layout('shared::layouts.app')
            ->title('Registrar Nuevo Cliente');
    }
}