<?php

namespace App\Contexts\Public\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;

use App\Contexts\Public\Presentation\Livewire\WelcomePage;
use App\Contexts\Public\Presentation\Livewire\CatalogoPage;
use App\Contexts\Public\Presentation\Livewire\Components\HeroSection;
use App\Contexts\Public\Presentation\Livewire\Components\ServiciosSection;
use App\Contexts\Public\Presentation\Livewire\Components\NosotrosSection;
use App\Contexts\Public\Presentation\Livewire\Components\ProcesoSection;
use App\Contexts\Public\Presentation\Livewire\Components\ContactForm;
use App\Contexts\Public\Presentation\Livewire\Components\WhatsappButton;

class PublicServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Contexts\Public\Domain\Repositories\ContactMessageRepositoryInterface::class,
            \App\Contexts\Public\Infrastructure\Repositories\EloquentContactMessageRepository::class
        );
    }

    public function boot(): void
    {
        View::addNamespace('public', __DIR__ . '/../Presentation/Views');

        Livewire::component('public.welcome-page', WelcomePage::class);
        Livewire::component('public.catalogo-page', CatalogoPage::class);
        Livewire::component('public.components.hero', HeroSection::class);
        Livewire::component('public.components.servicios', ServiciosSection::class);
        Livewire::component('public.components.nosotros', NosotrosSection::class);
        Livewire::component('public.components.proceso', ProcesoSection::class);
        Livewire::component('public.components.contacto', ContactForm::class);
        Livewire::component('public.components.whatsapp-button', WhatsappButton::class);
    }
}