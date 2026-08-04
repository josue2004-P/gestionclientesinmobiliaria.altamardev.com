<?php

namespace App\Contexts\Viviendas\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use App\Contexts\Viviendas\Presentation\Livewire\IndexViviendas;
use App\Contexts\Viviendas\Presentation\Livewire\CreateVivienda;
use App\Contexts\Viviendas\Presentation\Livewire\EditVivienda;
use App\Contexts\Viviendas\Presentation\Livewire\ViviendaDocumentosSection;
use App\Contexts\Viviendas\Presentation\Livewire\ViviendaFotosSection;

class ViviendasServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        View::addNamespace('viviendas', __DIR__ . '/../Presentation/Views');

        Livewire::component('viviendas::index-viviendas', IndexViviendas::class);
        Livewire::component('viviendas::create-vivienda', CreateVivienda::class);
        Livewire::component('viviendas::edit-vivienda', EditVivienda::class);
        Livewire::component('viviendas::vivienda-documentos-section', ViviendaDocumentosSection::class);
        Livewire::component('viviendas::vivienda-fotos-section', ViviendaFotosSection::class);
        $this->app->bind(
            \App\Contexts\Viviendas\Domain\Repositories\ViviendaRepositoryInterface::class,
            \App\Contexts\Viviendas\Infrastructure\Repositories\EloquentViviendaRepository::class
        );
    }
}