<?php

namespace App\Contexts\Shared\Presentation\Livewire\Amenidades;

use Livewire\Component;
use App\Contexts\Shared\Application\UseCases\Amenidades\CreateAmenidadUseCase;

class CreateAmenidad extends Component
{
    public $nombre = '';

    protected array $rules = ['nombre' => 'required|string|max:100'];

    public function save(CreateAmenidadUseCase $useCase) {
        $this->validate();
        $useCase->execute(['nombre' => $this->nombre]);
        session()->flash('success', 'Amenidad registrada exitosamente.');
        return redirect()->route('amenidades.index');
    }

    public function render() { return view('shared::amenidades.create')->layout('shared::layouts.app'); }
}