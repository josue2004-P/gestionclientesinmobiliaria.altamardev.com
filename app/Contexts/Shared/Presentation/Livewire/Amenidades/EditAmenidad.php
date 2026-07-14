<?php

namespace App\Contexts\Shared\Presentation\Livewire\Amenidades;

use Livewire\Component;
use App\Contexts\Shared\Infrastructure\LaravelModels\AmenidadEloquentModel;
use App\Contexts\Shared\Application\UseCases\Amenidades\UpdateAmenidadUseCase;

class EditAmenidad extends Component
{
    public $amenidadId;
    public $nombre;

    public function mount($id) {
        $model = AmenidadEloquentModel::findOrFail($id);
        $this->amenidadId = $model->id;
        $this->nombre = $model->nombre;
    }

    public function save(UpdateAmenidadUseCase $useCase) {
        $this->validate(['nombre' => 'required|string|max:100']);
        $useCase->execute($this->amenidadId, ['nombre' => $this->nombre]);
        session()->flash('success', 'Amenidad actualizada correctamente.');
        return redirect()->route('amenidades.index');
    }

    public function render() { return view('shared::amenidades.edit')->layout('shared::layouts.app'); }
}