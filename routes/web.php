<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Contexts\Dashboard\Presentation\Livewire\DashboardPage;

use App\Contexts\Public\Presentation\Livewire\WelcomePage;
use App\Contexts\Public\Presentation\Livewire\ContactPage;

use App\Contexts\Security\Presentation\Livewire\Permisos\IndexPermisos;
use App\Contexts\Security\Presentation\Livewire\Permisos\CreatePermiso;
use App\Contexts\Security\Presentation\Livewire\Permisos\EditPermiso;

use App\Contexts\Security\Presentation\Livewire\Perfiles\IndexPerfiles;
use App\Contexts\Security\Presentation\Livewire\Perfiles\CreatePerfil;
use App\Contexts\Security\Presentation\Livewire\Perfiles\EditPerfil;

use App\Contexts\Security\Presentation\Livewire\Usuarios\IndexUsuarios;
use App\Contexts\Security\Presentation\Livewire\Usuarios\CreateUsuario;
use App\Contexts\Security\Presentation\Livewire\Usuarios\EditUsuario;
use App\Contexts\Security\Infrastructure\Controllers\DownloadUsuarioDigitalAssetController;

use App\Contexts\Security\Presentation\Livewire\Profile\EditProfilePage;

// --- IMPORTACIONES MÓDULO 4: ASENTAMIENTOS ---
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\IndexAsentamientos;
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\CreateAsentamiento;
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\EditAsentamiento;

// --- IMPORTACIONES MÓDULO 4: TIPO DE CREDITOS ---
use App\Contexts\Shared\Presentation\Livewire\TiposCredito\IndexTiposCredito;
use App\Contexts\Shared\Presentation\Livewire\TiposCredito\CreateTipoCredito;
use App\Contexts\Shared\Presentation\Livewire\TiposCredito\EditTipoCredito;

// --- IMPORTACIONES MÓDULO 4: TIPO DE VIVIENDAS ---
use App\Contexts\Shared\Presentation\Livewire\TiposVivienda\IndexTiposVivienda;
use App\Contexts\Shared\Presentation\Livewire\TiposVivienda\CreateTipoVivienda;
use App\Contexts\Shared\Presentation\Livewire\TiposVivienda\EditTipoVivienda;

// --- IMPORTACIONES MÓDULO 4: AMENIDADES ---
use App\Contexts\Shared\Presentation\Livewire\Amenidades\IndexAmenidades;
use App\Contexts\Shared\Presentation\Livewire\Amenidades\CreateAmenidad;
use App\Contexts\Shared\Presentation\Livewire\Amenidades\EditAmenidad;

// --- IMPORTACIONES MÓDULO 5: VIVIENDAS ---
use App\Contexts\Viviendas\Presentation\Livewire\IndexViviendas;
use App\Contexts\Viviendas\Presentation\Livewire\CreateVivienda;
use App\Contexts\Viviendas\Presentation\Livewire\EditVivienda;
use App\Contexts\Viviendas\Presentation\Controllers\ViviendaDocumentoController;
use App\Contexts\Viviendas\Presentation\Controllers\ViviendaFotoController;

// --- IMPORTACIONES MÓDULO 6: CLIENTES ---
use App\Contexts\Clientes\Presentation\Livewire\IndexClientes;
use App\Contexts\Clientes\Presentation\Livewire\CreateCliente;
use App\Contexts\Clientes\Presentation\Livewire\EditCliente;
use App\Contexts\Clientes\Presentation\Http\Controllers\VerClienteDocumentoController;

Route::get('/', WelcomePage::class)->name('home');
Route::get('/contacto', ContactPage::class)->name('contactar');

Route::middleware(['auth'])->group(function () {

    // --- MÓDULO PERMISOS ---
    Route::get('permisos', IndexPermisos::class)->name('permisos.index');
    Route::get('permisos/crear', CreatePermiso::class)->name('permisos.create');
    Route::get('permisos/{id}/editar', EditPermiso::class)->name('permisos.edit');

    // MODULO PERFILES
    Route::get('perfiles', IndexPerfiles::class)->name('perfiles.index');
    Route::get('perfiles/crear', CreatePerfil::class)->name('perfiles.create');
    Route::get('perfiles/{id}/editar', EditPerfil::class)->name('perfiles.edit');

    // MODULO USUARIOS
    Route::get('usuarios', IndexUsuarios::class)->name('usuarios.index');
    Route::get('usuarios/crear', CreateUsuario::class)->name('usuarios.create');
    Route::get('usuarios/{id}/editar', EditUsuario::class)->name('usuarios.edit');

    Route::get('usuarios/assets/{directory}/{filename}', DownloadUsuarioDigitalAssetController::class)
        ->name('security.usuarios.asset');

    // --- MÓDULO 4: CATÁLOGO DE ASENTAMIENTOS ---
    Route::get('asentamientos', IndexAsentamientos::class)->name('asentamientos.index');
    Route::get('asentamientos/crear', CreateAsentamiento::class)->name('asentamientos.create');
    Route::get('asentamientos/{id}/editar', EditAsentamiento::class)->name('asentamientos.edit');

    // --- MÓDULO 4: CATÁLOGO DE TIPO DE CREDITOS ---
    Route::get('tipos-credito', IndexTiposCredito::class)->name('tipos-credito.index');
    Route::get('tipos-credito/crear', CreateTipoCredito::class)->name('tipos-credito.create');
    Route::get('tipos-credito/{id}/editar', EditTipoCredito::class)->name('tipos-credito.edit');

    // --- MÓDULO 4: CATÁLOGO DE TIPO DE VIVIENDAS ---
    Route::get('tipos-vivienda', IndexTiposVivienda::class)->name('tipos-vivienda.index');
    Route::get('tipos-vivienda/crear', CreateTipoVivienda::class)->name('tipos-vivienda.create');
    Route::get('tipos-vivienda/{id}/editar', EditTipoVivienda::class)->name('tipos-vivienda.edit');

    // --- MÓDULO 4: CATÁLOGO DE AMENIDADES ---
    Route::get('amenidades', IndexAmenidades::class)->name('amenidades.index');
    Route::get('amenidades/crear', CreateAmenidad::class)->name('amenidades.create');
    Route::get('amenidades/{id}/editar', EditAmenidad::class)->name('amenidades.edit');

    // --- MÓDULO 5: CATÁLOGO DE VIVIENDAS ---

    Route::get('viviendas', IndexViviendas::class)->name('viviendas.index');
    Route::get('viviendas/crear', CreateVivienda::class)->name('viviendas.create');
    Route::get('viviendas/{id}/editar', EditVivienda::class)->name('viviendas.edit');
    Route::get('/viviendas/documentos/{id}/descargar', [ViviendaDocumentoController::class, 'download'])
        ->name('viviendas.documentos.download');

    Route::get('/viviendas/fotos/{id}/ver', [ViviendaFotoController::class, 'show'])
        ->name('viviendas.fotos.show');

    // --- MÓDULO 6: COMERCIAL DE COMPRADORES (CLIENTES) ---
    Route::get('clientes', IndexClientes::class)->name('clientes.index');
    Route::get('clientes/crear', CreateCliente::class)->name('clientes.create');
    Route::get('clientes/{id}/editar', EditCliente::class)->name('clientes.edit');
    Route::get('/clientes/expediente/ver-documento', VerClienteDocumentoController::class)
        ->name('clientes.documentos.ver');
});

Route::get('/dashboard', DashboardPage::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', EditProfilePage::class)->name('profile.edit');
});

require __DIR__.'/auth.php';
