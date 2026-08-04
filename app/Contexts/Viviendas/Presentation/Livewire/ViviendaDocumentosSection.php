<?php

namespace App\Contexts\Viviendas\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ViviendaDocumentosSection extends Component
{
    use WithFileUploads;

    public array $documentos = [];
    public $temporalFile = null; 
    public $temporalTipo = '';

    public array $tiposDisponibles = [
        'Escrituras'      => 'Escrituras Públicas',
        'Predial'         => 'Boleta de Impuesto Predial',
        'Identificacion' => 'Identificación Oficial Propietario',
        'Plano'          => 'Plano Arquitectónico / Poligonal',
        'Contrato'       => 'Contrato de Exclusividad',
    ];

    public function mount(array $documentos = [])
    {
        $this->documentos = $documentos;
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

        $this->dispatch('vivienda-documentos-updated', documentos: $this->documentos);

        $this->reset(['temporalFile', 'temporalTipo']);
    }

    public function removeDocumento($index)
    {
        if (empty($this->documentos[$index]['id']) && !empty($this->documentos[$index]['url'])) {
            Storage::disk('local')->delete($this->documentos[$index]['url']);
        }

        unset($this->documentos[$index]);
        $this->documentos = array_values($this->documentos);

        $this->dispatch('vivienda-documentos-updated', documentos: $this->documentos);
    }

    public function render()
    {
        return view('viviendas::partials.vivienda-documentos-section');
    }
}