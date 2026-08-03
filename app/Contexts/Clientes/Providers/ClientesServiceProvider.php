<?php

namespace App\Contexts\Clientes\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;

use App\Contexts\Clientes\Presentation\Livewire\IndexClientes;
use App\Contexts\Clientes\Presentation\Livewire\CreateCliente;
use App\Contexts\Clientes\Presentation\Livewire\EditCliente;
use App\Contexts\Clientes\Presentation\Livewire\DocumentosManager; 

class ClientesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Contexts\Clientes\Domain\Repositories\ClienteRepositoryInterface::class,
            \App\Contexts\Clientes\Infrastructure\Repositories\EloquentClienteRepository::class
        );
    }

    public function boot(): void
    {
        View::addNamespace('clientes', __DIR__ . '/../Presentation/Views');

        Livewire::component('index-clientes', IndexClientes::class);
        Livewire::component('create-cliente', CreateCliente::class);
        Livewire::component('edit-cliente', EditCliente::class);
        Livewire::component('documentos-manager', DocumentosManager::class); 
    }
}