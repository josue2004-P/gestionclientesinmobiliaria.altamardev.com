<?php

namespace App\Contexts\Security\Presentation\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFoto extends Component
{
    use WithFileUploads;

    public $foto;
    public $existingFoto;

    public function mount($existingFoto = null)
    {
        $this->existingFoto = $existingFoto;
    }
    
    public function updatedFoto()
    {
        $this->validate([
            'foto' => 'image|max:2048|mimes:jpeg,png,jpg,webp',
        ]);

        $path = $this->foto->store('usuarios/fotos', 'local');
        $this->dispatch('fotoUploaded', $path);
    }

    public function removeFoto()
    {
        $this->foto = null;
        $this->existingFoto = null;
        $this->resetErrorBag('foto'); 
        $this->dispatch('fotoUploaded', null);
    }

    public function render()
    {
        return view('security::usuarios.partials.upload-foto');
    }
}