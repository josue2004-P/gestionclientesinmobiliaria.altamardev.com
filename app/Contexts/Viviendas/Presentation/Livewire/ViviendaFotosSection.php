<?php

namespace App\Contexts\Viviendas\Presentation\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ViviendaFotosSection extends Component
{
    use WithFileUploads;

    public array $fotos = [];
    public $temporalFotoFile = null;

    public function mount(array $fotos = [])
    {
        $this->fotos = $fotos;
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

        $this->dispatch('vivienda-fotos-updated', fotos: $this->fotos);

        $this->reset('temporalFotoFile');
    }

    public function setFotoPrincipal($index)
    {
        foreach ($this->fotos as $key => $foto) {
            $this->fotos[$key]['es_principal'] = ($key === $index);
        }

        $this->dispatch('vivienda-fotos-updated', fotos: $this->fotos);
    }

    public function removeFoto($index)
    {
        if (empty($this->fotos[$index]['id']) && !empty($this->fotos[$index]['url'])) {
            Storage::disk('local')->delete($this->fotos[$index]['url']);
        }

        $fuePrincipal = $this->fotos[$index]['es_principal'] ?? false;
        unset($this->fotos[$index]);
        $this->fotos = array_values($this->fotos);

        if ($fuePrincipal && count($this->fotos) > 0) {
            $this->fotos[0]['es_principal'] = true;
        }

        $this->dispatch('vivienda-fotos-updated', fotos: $this->fotos);
    }

    public function render()
    {
        return view('viviendas::partials.vivienda-fotos-section');
    }
}