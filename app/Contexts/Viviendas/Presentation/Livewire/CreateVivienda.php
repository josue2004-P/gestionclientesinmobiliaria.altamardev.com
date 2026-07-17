<?php

namespace App\Contexts\Viviendas\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Contexts\Viviendas\Application\UseCases\SaveViviendaUseCase;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaContactosUseCase;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaDocumentosUseCase;
use App\Contexts\Viviendas\Application\UseCases\SaveViviendaFotosUseCase;

use App\Contexts\Shared\Application\UseCases\Asentamientos\GetAsentamientosForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueEstadosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueMunicipiosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetUniqueCiudadesUseCase;
use App\Contexts\Shared\Application\UseCases\TiposVivienda\GetTiposViviendaForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\TiposCredito\GetTiposCreditoForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\Amenidades\GetAmenidadesForSelectUseCase;

class CreateVivienda extends Component
{
    use WithFileUploads;

    public $searchAsentamiento = '';
    public $selectedEstado = '';
    public $selectedMunicipio = '';
    public $selectedCiudad = '';

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
    public array $documentos = [];
    public $temporalFile; 
    public $temporalTipo = '';

    public array $fotos = [];
    public $temporalFotoFile; 

    public array $tiposDisponibles = [
        'Escrituras' => 'Escrituras Públicas',
        'Predial' => 'Boleta de Impuesto Predial',
        'Identificacion' => 'Identificación Oficial Propietario',
        'Plano' => 'Plano Arquitectónico / Poligonal',
        'Contrato' => 'Contrato de Exclusividad',
    ];

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
    public function tiposVivienda()
    {
        return app(GetTiposViviendaForSelectUseCase::class)->execute();
    }

    #[Computed]
    public function creditosDisponibles()
    {
        return app(GetTiposCreditoForSelectUseCase::class)->execute('vivienda');
    }

    #[Computed]
    public function amenidadesDisponibles()
    {
        return app(GetAmenidadesForSelectUseCase::class)->execute();
    }

    public function mount()
    {
        if (!checkPermiso('viviendas.is_create')) abort(403);
        
        $this->addContacto();
    }

    public function updatedSelectedEstado()
    {
        $this->selectedMunicipio = '';
        $this->selectedCiudad = '';
        $this->asentamiento_id = '';
    }

    public function updatedSelectedMunicipio()
    {
        $this->selectedCiudad = '';
        $this->asentamiento_id = '';
    }

    public function updatedSelectedCiudad()
    {
        $this->asentamiento_id = '';
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

    public function addDocumento()
    {
        $this->validate([
            'temporalFile' => 'required|file|max:10240',
            'temporalTipo' => 'required|string',
        ]);

        $path = $this->temporalFile->store('viviendas/documentos', 'local');

        $this->documentos[] = [
            'id'              => null,
            'url'             => $path,
            'nombre_original' => $this->temporalFile->getClientOriginalName(),
            'tipo_documento'  => $this->temporalTipo,
            'peso_bytes'      => $this->temporalFile->getSize(),
            'verificado'      => false,
        ];

        $this->reset(['temporalFile', 'temporalTipo']);
    }

    public function removeDocumento($index)
    {
        if (isset($this->documentos[$index]['url'])) {
            Storage::disk('local')->delete($this->documentos[$index]['url']);
        }

        unset($this->documentos[$index]);
        $this->documentos = array_values($this->documentos);
    }

    public function addFoto()
    {
        $this->validate([
            'temporalFotoFile' => 'required|image|max:5120',
        ]);

        $path = $this->temporalFotoFile->store('viviendas/fotos', 'local');

        $esPrincipal = count($this->fotos) === 0;

        $this->fotos[] = [
            'id'              => null,
            'url'             => $path,
            'nombre_original' => $this->temporalFotoFile->getClientOriginalName(),
            'orden'           => count($this->fotos),
            'es_principal'    => $esPrincipal,
            'preview'         => $this->temporalFotoFile->temporaryUrl()
        ];

        $this->reset('temporalFotoFile');
    }

    public function setFotoPrincipal($index)
    {
        foreach ($this->fotos as $key => $foto) {
            $this->fotos[$key]['es_principal'] = ($key === $index);
        }
    }

    public function removeFoto($index)
    {
        if (isset($this->fotos[$index]['url'])) {
            Storage::disk('local')->delete($this->fotos[$index]['url']);
        }

        $fuePrincipal = $this->fotos[$index]['es_principal'];
        unset($this->fotos[$index]);
        $this->fotos = array_values($this->fotos);

        if ($fuePrincipal && count($this->fotos) > 0) {
            $this->fotos[0]['es_principal'] = true;
        }
    }

    public function save(
        SaveViviendaUseCase $useCase, 
        SaveViviendaContactosUseCase $contactosUseCase,
        SaveViviendaDocumentosUseCase $documentosUseCase,
        SaveViviendaFotosUseCase $fotosUseCase
    ) {
        $this->validate();

        try {
            DB::beginTransaction();

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
            $documentosUseCase->execute($viviendaId, $this->documentos);
            $fotosUseCase->execute($viviendaId, $this->fotos);

            DB::commit();

            session()->flash('success', 'Ficha técnica de la propiedad generada correctamente.');
            return redirect()->route('viviendas.index');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('fraccionamiento', 'Error en el proceso de guardado: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('viviendas::create')
            ->layout('shared::layouts.app')
            ->title('Registrar Inmueble');
    }
}