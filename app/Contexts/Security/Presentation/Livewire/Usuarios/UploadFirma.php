<?php

namespace App\Contexts\Security\Presentation\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFirma extends Component
{
    use WithFileUploads;

    public $firma;
    public $existingFirma;

    public function mount($existingFirma = null)
    {
        $this->existingFirma = $existingFirma;
    }

    public function updatedFirma()
    {
        $this->validate([
            'firma' => 'image|max:1024|mimes:png,jpg,jpeg',
        ]);

        $path = $this->firma->store('usuarios/firmas', 'local');
        $this->dispatch('firmaUploaded', $path);
    }

    public function removeFirma()
    {
        $this->firma = null;
        $this->existingFirma = null;
        $this->resetErrorBag('firma'); 
        $this->dispatch('firmaUploaded', null);
    }

    public function render()
    {
        return view('security::usuarios.partials.upload-firma');
    }
}