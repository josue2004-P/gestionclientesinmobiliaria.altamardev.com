<?php

namespace App\Contexts\Public\Presentation\Livewire\Components;

use Livewire\Component;
use App\Contexts\Public\Application\UseCases\Contact\SubmitContactMessageUseCase;

class ContactForm extends Component
{
    public string $nombre = '';
    public string $email = '';
    public string $mensaje = '';

    /**
     * Procesa el formulario de contacto usando el Caso de Uso puro de aplicación.
     */
    public function submitContact(SubmitContactMessageUseCase $useCase)
    {
        $validated = $this->validate([
            'nombre'  => 'required|string|max:100',
            'email'   => 'required|email',
            'mensaje' => 'required|string|max:1000',
        ]);

        // Invocamos la lógica del dominio pasando primitivos
        $useCase->execute($validated);

        // Limpiamos los campos reactivos tras el éxito
        $this->reset(['nombre', 'email', 'mensaje']);

        session()->flash('success', 'Mensaje enviado correctamente.');
    }

    public function render()
    {
        return view('livewire.public.components.contacto');
    }
}