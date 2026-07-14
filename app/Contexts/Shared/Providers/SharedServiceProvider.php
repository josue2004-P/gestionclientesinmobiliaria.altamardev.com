<?php

namespace App\Contexts\Shared\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire; 

// ASENTAMIENTOS
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\IndexAsentamientos;
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\CreateAsentamiento;
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\EditAsentamiento;

// TIPO CREDITO
use App\Contexts\Shared\Presentation\Livewire\TiposCredito\IndexTiposCredito;
use App\Contexts\Shared\Presentation\Livewire\TiposCredito\CreateTipoCredito;
use App\Contexts\Shared\Presentation\Livewire\TiposCredito\EditTipoCredito;

// TIPO DE VIVIENDA
use App\Contexts\Shared\Presentation\Livewire\TiposVivienda\IndexTiposVivienda;
use App\Contexts\Shared\Presentation\Livewire\TiposVivienda\CreateTipoVivienda;
use App\Contexts\Shared\Presentation\Livewire\TiposVivienda\EditTipoVivienda;

// AMENIDADES
use App\Contexts\Shared\Presentation\Livewire\Amenidades\IndexAmenidades;
use App\Contexts\Shared\Presentation\Livewire\Amenidades\CreateAmenidad;
use App\Contexts\Shared\Presentation\Livewire\Amenidades\EditAmenidad;

class SharedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        View::addNamespace('shared', __DIR__ . '/../Presentation/Views');

        $this->callAfterResolving(\Illuminate\View\Compilers\BladeCompiler::class, function ($blade) {
            $blade->componentNamespace(__DIR__ . '/../Presentation/Views/components', 'shared');
        });

        // ASENTAMIENTOS
        Livewire::component('shared::asentamientos.index-asentamientos', IndexAsentamientos::class);
        Livewire::component('shared::asentamientos.create-asentamiento', CreateAsentamiento::class);
        Livewire::component('shared::asentamientos.edit-asentamiento', EditAsentamiento::class);

        // TIPO DE CREDITO
        Livewire::component('shared::tipos-credito.index-tipos-credito', IndexTiposCredito::class);
        Livewire::component('shared::tipos-credito.create-tipo-credito', CreateTipoCredito::class);
        Livewire::component('shared::tipos-credito.edit-tipo-credito', EditTipoCredito::class);

        // TIPO DE VIVIENDA
        Livewire::component('shared::tipos-vivienda.index-tipos-vivienda', IndexTiposVivienda::class);
        Livewire::component('shared::tipos-vivienda.create-tipo-vivienda', CreateTipoVivienda::class);
        Livewire::component('shared::tipos-vivienda.edit-tipo-vivienda', EditTipoVivienda::class);

        // AMENIDADES
        Livewire::component('shared::amenidades.index-amenidades', IndexAmenidades::class);
        Livewire::component('shared::amenidades.create-amenidad', CreateAmenidad::class);
        Livewire::component('shared::amenidades.edit-amenidad', EditAmenidad::class);

        $this->app->bind(
            \App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface::class,
            \App\Contexts\Shared\Infrastructure\Repositories\EloquentAsentamientoRepository::class
        );

        $this->app->bind(
            \App\Contexts\Shared\Domain\Repositories\TipoCreditoRepositoryInterface::class,
            \App\Contexts\Shared\Infrastructure\Repositories\EloquentTipoCreditoRepository::class
        );

        $this->app->bind(
            \App\Contexts\Shared\Domain\Repositories\TipoViviendaRepositoryInterface::class,
            \App\Contexts\Shared\Infrastructure\Repositories\EloquentTipoViviendaRepository::class
        );

        $this->app->bind(
            \App\Contexts\Shared\Domain\Repositories\AmenidadRepositoryInterface::class,
            \App\Contexts\Shared\Infrastructure\Repositories\EloquentAmenidadRepository::class
        );
    }
}