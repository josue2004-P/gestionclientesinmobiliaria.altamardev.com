<?php

namespace App\Contexts\Clientes\Presentation\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;

// Use Cases
use App\Contexts\Clientes\Application\UseCases\SaveClienteUseCase;
use App\Contexts\Clientes\Application\UseCases\SaveClienteTelefonosUseCase;
use App\Contexts\Clientes\Application\UseCases\SaveClienteReferenciasUseCase;
use App\Contexts\Clientes\Application\UseCases\SaveClienteDocumentosUseCase;

// Shared Use Cases
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetAsentamientosForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueEstadosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueMunicipiosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueCiudadesUseCase;
use App\Contexts\Shared\Application\UseCases\TiposCredito\GetTiposCreditoForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetAllAsentamientosUseCase; 

use App\Contexts\Clientes\Presentation\Http\Requests\SaveClienteRequest;

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
    public ?float $precalificacion = 0.0;
    public string $avaluo_solicitado = 'No';
    public ?string $estado_civil = null;
    public ?string $regimen_casamiento = null;

    public array $zonas_ids = [];
    public array $telefonos = [];
    public array $referencias = [];
    public array $documentos = [];

    protected $listeners = [
        'documentos-updated' => 'onDocumentosUpdated'
    ];

    public function onDocumentosUpdated(array $documentos): void
    {
        $this->documentos = $documentos;
    }

    public function mount()
    {
        if (!checkPermiso('clientes.is_update')) {
            abort(403, 'Acceso denegado.');
        }

        // Inicializar al menos una fila vacía para Teléfono y Referencia
        if (empty($this->telefonos)) {
            $this->addTelefono();
        }
        if (empty($this->referencias)) {
            $this->addReferencia();
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
            search: $this->searchAsentamiento, 
            selectedId: $this->asentamiento_id ? (int)$this->asentamiento_id : null,
            estado: $this->selectedEstado,
            municipio: $this->selectedMunicipio,
            ciudad: $this->selectedCiudad
        );
    }

    #[Computed]
    public function todosLosAsentamientos()
    {
        return app(GetAllAsentamientosUseCase::class)->execute();
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

    // MÉTODOS PARA TELÉFONOS
    public function addTelefono(): void
    {
        $this->telefonos[] = [
            'id' => null,
            'telefono' => '',
            'tipo_telefono' => 'Celular'
        ];
    }

    public function removeTelefono(int $index): void
    {
        unset($this->telefonos[$index]);
        $this->telefonos = array_values($this->telefonos);
    }

    // MÉTODOS PARA REFERENCIAS
    public function addReferencia(): void
    {
        $this->referencias[] = [
            'id' => null,
            'nombre' => '',
            'celular' => '',
            'parentesco' => '',
            'asentamiento_id' => null,
            'calle_numero' => ''
        ];
    }

    public function removeReferencia(int $index): void
    {
        unset($this->referencias[$index]);
        $this->referencias = array_values($this->referencias);
    }


    
    public function store(
        SaveClienteUseCase $saveClienteUseCase,
        SaveClienteTelefonosUseCase $telefonosUseCase,
        SaveClienteReferenciasUseCase $referenciasUseCase,
        SaveClienteDocumentosUseCase $documentosUseCase
    ) {
        $request = new SaveClienteRequest();

        $validatedData = $this->validate(
            $request->rules(),
            $request->messages(),
            $request->attributes()
        );
        
        try {
            // 1. Guardar cliente base
            $clienteId = $saveClienteUseCase->execute([
                'nombre'               => $this->nombre,
                'apellido_paterno'     => $this->apellido_paterno,
                'apellido_materno'     => $this->apellido_materno,
                'fecha_nacimiento'     => $this->fecha_nacimiento,
                'rfc'                  => $this->rfc,
                'curp'                 => $this->curp,
                'asentamiento_id'      => $this->asentamiento_id ? (int)$this->asentamiento_id : null,
                'calle_numero'         => $this->calle_numero,
                'nss'                  => $this->nss,
                'correo_infonavit'     => $this->correo_infonavit,
                'contrasena_infonavit' => $this->contrasena_infonavit,
                'tipo_credito_id'      => $this->tipo_credito_id ? (int)$this->tipo_credito_id : null,
                'precalificacion'      => $this->precalificacion ?? 0.0,
                'avaluo_solicitado'    => $this->avaluo_solicitado,
                'estado_civil'         => $this->estado_civil,
                'regimen_casamiento'   => $this->regimen_casamiento,
                'zonas_ids'            => $this->zonas_ids,
            ]);

            // 2. Guardar Relaciones con el ID del cliente generado
            $telefonosUseCase->execute($clienteId, $this->telefonos);
            $referenciasUseCase->execute($clienteId, $this->referencias);
            $documentosUseCase->execute($clienteId, $this->documentos);

            $this->dispatch('swal-init', [
                'icon' => 'success',
                'title' => '¡Éxito!',
                'text' => 'El cliente y su expediente se han registrado correctamente.'
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