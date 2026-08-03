<?php

namespace App\Contexts\Clientes\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Contexts\Clientes\Application\UseCases\SaveClienteDocumentosUseCase;

class DocumentosManager extends Component
{
    use WithFileUploads;

    public ?int $clienteId = null;
    public array $documentos = [];
    
    public $temporalFile = null;
    public string $temporalTipo = '';

    public array $tiposDisponibles = [
        'INE'                  => 'Identificación Oficial (INE / Pasaporte)',
        'CURP'                 => 'Clave Única de Registro de Población (CURP)',
        'RFC'                  => 'Constancia de Situación Fiscal (RFC)',
        'Acta_Nacimiento'      => 'Acta de Nacimiento Certificada',
        'Comprobante_Domicilio' => 'Comprobante de Domicilio Reciente',
        'Estado_Cuenta'        => 'Estado de Cuenta Bancario (CLABE)'
    ];

    public function mount(?int $clienteId = null, array $documentos = [])
    {
        $this->clienteId = $clienteId;
        $this->documentos = $documentos;
    }

    public function updatedTemporalFile()
    {
        $this->resetValidation('temporalFile');
    }

    public function addDocumento()
    {
        $this->validate([
            'temporalFile' => 'required|file|max:10240',
            'temporalTipo' => 'required|string',
        ], [
            'temporalFile.required' => 'Debes seleccionar un archivo para continuar.',
            'temporalFile.file'     => 'El archivo seleccionado no es válido.',
            'temporalFile.max'      => 'El archivo no debe pesar más de 10 MB.',
            'temporalTipo.required' => 'Selecciona la clasificación del documento.',
        ]);

        $path = $this->temporalFile->store('clientes/documentos', 'local');

        $nuevoDoc = [
            'id'              => null,
            'url'             => $path,
            'nombre_original' => $this->temporalFile->getClientOriginalName(),
            'tipo_documento'  => $this->temporalTipo,
            'peso_bytes'      => $this->temporalFile->getSize(),
            'verificado'      => false,
        ];

        $this->documentos[] = $nuevoDoc;

        if ($this->clienteId) {
            app(SaveClienteDocumentosUseCase::class)->execute($this->clienteId, $this->documentos);
            $this->dispatch('swal-toast', ['icon' => 'success', 'title' => 'Documento añadido al expediente.']);
        }

        $this->dispatch('documentos-updated', $this->documentos);

        $this->reset(['temporalFile', 'temporalTipo']);
        $this->resetErrorBag();
    }

    public function removeDocumento($index)
    {
        if (isset($this->documentos[$index]['url'])) {
            Storage::disk('local')->delete($this->documentos[$index]['url']);
        }

        unset($this->documentos[$index]);
        $this->documentos = array_values($this->documentos);

        if ($this->clienteId) {
            app(SaveClienteDocumentosUseCase::class)->execute($this->clienteId, $this->documentos);
            $this->dispatch('swal-toast', ['icon' => 'info', 'title' => 'Documento eliminado.']);
        }

        $this->dispatch('documentos-updated', $this->documentos);
    }

    public function render()
    {
        return view('clientes::partials.documentos-manager');
    }
}