<?php

namespace App\Contexts\Clientes\Presentation\Livewire;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Contexts\Clientes\Application\UseCases\GetClienteByIdUseCase;
use App\Contexts\Clientes\Application\UseCases\SaveClienteUseCase;
use App\Contexts\Clientes\Application\UseCases\SaveClienteTelefonosUseCase;
use App\Contexts\Clientes\Application\UseCases\SaveClienteReferenciasUseCase;
use App\Contexts\Clientes\Application\UseCases\SaveClienteDocumentosUseCase;
use App\Contexts\Shared\Application\UseCases\Asentamientos\GetAsentamientosForSelectUseCase;
use App\Contexts\Shared\Application\UseCases\TiposCredito\GetTiposCreditoForSelectUseCase;

class EditCliente extends Component
{
    use WithFileUploads;
    // ID del registro a editar
    public int $clienteId;

    // Campos del formulario vinculados por wire:model
    public string $nombre = '';
    public string $apellido_paterno = '';
    public string $apellido_materno = '';
    public ?string $fecha_nacimiento = null;
    public ?string $rfc = null;
    public ?string $curp = null;
    public ?int $asentamiento_id = null;
    public ?string $calle_numero = null;
    public ?string $nss = null;
    public ?string $correo_infonavit = null;
    public ?string $contrasena_infonavit = null;
    public ?int $tipo_credito_id = null;
    public float $precalificacion = 0.0;
    public string $avaluo_solicitado = 'No';
    public ?string $estado_civil = null;
    public ?string $regimen_casamiento = null;

    public array $zonas_ids = [];
    public array $telefonos = [];
    public array $referencias = [];

    public array $documentos = [];
    public $temporalFile;
    public string $temporalTipo = '';

    // Catálogo interno para desplegar etiquetas limpias
    public array $tiposDisponibles = [
        'INE' => 'Identificación Oficial (INE / Pasaporte)',
        'CURP' => 'Clave Única de Registro de Población (CURP)',
        'RFC' => 'Constancia de Situación Fiscal (RFC)',
        'Acta_Nacimiento' => 'Acta de Nacimiento Certificada',
        'Comprobante_Domicilio' => 'Comprobante de Domicilio Reciente',
        'Estado_Cuenta' => 'Estado de Cuenta Bancario (CLABE)'
    ];

    public function mount(int $id, GetClienteByIdUseCase $getClienteUseCase)
    {
        if (!checkPermiso('clientes.is_update')) {
            abort(403, 'Acceso denegado.');
        }

        $cliente = $getClienteUseCase->execute($id);

        if (!$cliente) {
            abort(404, 'Cliente no encontrado.');
        }

        $this->clienteId = $cliente->getId();
        $this->nombre = $cliente->getNombre();
        $this->apellido_paterno = $cliente->getApellidoPaterno();
        $this->apellido_materno = $cliente->getApellidoMaterno();
        $this->fecha_nacimiento = $cliente->getFechaNacimiento()?->format('Y-m-d'); 
        $this->rfc = $cliente->getRfc();
        $this->curp = $cliente->getCurp();
        $this->asentamiento_id = $cliente->getAsentamientoId();
        $this->calle_numero = $cliente->getCalleNumero();
        $this->nss = $cliente->getNss();
        $this->correo_infonavit = $cliente->getCorreoInfonavit();
        $this->contrasena_infonavit = $cliente->getContrasenaInfonavit();
        $this->tipo_credito_id = $cliente->getTipoCreditoId();
        $this->precalificacion = $cliente->getPrecalificacion();
        $this->avaluo_solicitado = $cliente->getAvalaoSolicitado();
        $this->estado_civil = $cliente->getEstadoCivil();
        $this->regimen_casamiento = $cliente->getRegimenCasamiento();

        $this->zonas_ids = $cliente->getZonasInteres() ?? [];
        $this->telefonos = collect($cliente->getTelefonos())->map(fn($t) =>$t->toArray())->toArray();
        $this->referencias = collect($cliente->getReferencias())->map(fn($r) => $r->toArray())->toArray();
        $this->documentos = collect($cliente->getDocumentos())->map(function($d) {
            return [
                'id'              => $d->getId(),
                'url'             => $d->getUrl(),
                'nombre_original' => $d->getNombreOriginal(),
                'tipo_documento'  => $d->getTipoDocumento(),
                'peso_bytes'      => $d->getPesoBytes(),
                'verificado'      => (bool)$d->isVerificado(),
            ];
        })->toArray();

        if (empty($this->telefonos)) {
            $this->addTelefono();
        }
        if (empty($this->referencias)) {
            $this->addReferencia();
        }
        if (empty($this->documentos)) {
            $this->documentos = [];
        }
    }

    protected function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'rfc' => 'nullable|string|max:13|unique:clientes,rfc,' . $this->clienteId,
            'curp' => 'nullable|string|max:18|unique:clientes,curp,' . $this->clienteId,
            'asentamiento_id' => 'nullable|integer',
            'calle_numero' => 'nullable|string|max:255',
            'nss' => 'nullable|string|max:15',
            'correo_infonavit' => 'nullable|email|max:255',
            'contrasena_infonavit' => 'nullable|string|max:255',
            'tipo_credito_id' => 'nullable|integer',
            'precalificacion' => 'numeric|min:0',
            'avaluo_solicitado' => 'required|in:Sí,No',
            'estado_civil' => 'nullable|in:Soltero,Casado,Divorciado,Viudo,Union_Libre',
            'regimen_casamiento' => 'nullable|string|max:100',

            'zonas_ids'                 => 'nullable|array',
            'zonas_ids.*'               => 'integer|exists:asentamientos,id',
            'telefonos'                 => 'required|array|min:1',
            'telefonos.*.id'            => 'nullable|integer',
            'telefonos.*.telefono'      => 'required|string|min:8|max:20',
            'telefonos.*.tipo_telefono' => 'required|string|max:50',
            'referencias' => 'nullable|array',
            'referencias.*.id' => 'nullable|integer',
            'referencias.*.nombre' => 'required|string|max:255',
            'referencias.*.celular' => 'nullable|string|max:20',
            'referencias.*.parentesco' => 'nullable|string|max:100',
        ];
    }

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

    public function addDocumento()
    {
        $this->validate([
            'temporalFile' => 'required|file|max:10240', // 10MB Máx
            'temporalTipo' => 'required|string',
        ]);

        $path = $this->temporalFile->store('clientes/documentos', 'local');

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

    public function save(
        SaveClienteUseCase $useCase, 
        SaveClienteTelefonosUseCase $telefonosUseCase,
        SaveClienteReferenciasUseCase $referenciasUseCase,
        SaveClienteDocumentosUseCase $documentosUseCase 
    ) {
        $this->validate();

        $idGenerado = $useCase->execute([
            'id'                   => $this->clienteId,
            'nombre'               => $this->nombre,
            'apellido_paterno'     => $this->apellido_paterno,
            'apellido_materno'     => $this->apellido_materno,
            'fecha_nacimiento'     => $this->fecha_nacimiento,
            'rfc'                  => $this->rfc,
            'curp'                 => $this->curp,
            'asentamiento_id'      => $this->asentamiento_id,
            'calle_numero'         => $this->calle_numero,
            'nss'                  => $this->nss,
            'correo_infonavit'     => $this->correo_infonavit,
            'contrasena_infonavit' => $this->contrasena_infonavit,
            'tipo_credito_id'      => $this->tipo_credito_id,
            'precalificacion'      => $this->precalificacion,
            'avaluo_solicitado'    => $this->avaluo_solicitado,
            'estado_civil'         => $this->estado_civil,
            'regimen_casamiento'   => $this->regimen_casamiento,
            'zonas_ids'            => $this->zonas_ids,
        ]);

        $telefonosUseCase->execute($idGenerado, $this->telefonos);
        $referenciasUseCase->execute($idGenerado, $this->referencias);
        $documentosUseCase->execute($idGenerado, $this->documentos);

        session()->flash('success', 'Expediente del cliente actualizado correctamente.');
        return redirect()->route('clientes.index');
    }

    public function render(
        GetAsentamientosForSelectUseCase $getAsentamientosUseCase,
        GetTiposCreditoForSelectUseCase $getTiposCreditoUseCase
    ) {
        return view('clientes::edit', [
            'asentamientos' => $getAsentamientosUseCase->execute(),
            'tiposCredito'  => $getTiposCreditoUseCase->execute('cliente') 
        ])
        ->layout('shared::layouts.app')
        ->title('Editar Expediente de Cliente');
    }
}