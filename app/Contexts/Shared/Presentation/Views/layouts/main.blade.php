<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Gestión Inmobiliaria' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:100,300,400,500,600,700,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        
        .tech-border { border-color: rgba(15, 23, 42, 0.08); }

        .nav-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        }

        /* Estilización para inputs globales */
        input, textarea, select { border-radius: 0 !important; }
    </style>

    @livewireStyles
</head>
<body class="bg-white font-sans text-slate-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

    <x-shared::common.preloader/>

    {{-- HEADER CONTENEDOR --}}
    <header class="fixed top-0 left-0 w-full z-50 nav-glass">
        <div class="container mx-auto px-6 lg:px-20 h-20 flex items-center justify-between">
            
            {{-- Identidad / Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <i class="fas fa-home text-indigo-600 text-xl transition-transform group-hover:scale-110"></i>
                <span class="font-black text-slate-900 tracking-widest text-xs uppercase">Gestión <span class="text-slate-400 font-light lowercase italic font-serif text-sm">Inmobiliaria</span></span>
            </a>

            {{-- Navegación Principal --}}
            <nav class="hidden md:flex items-center gap-10">
                <a href="{{ url('/') }}#nosotros" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">Nosotros</a>
                <a href="{{ url('/') }}#servicios" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">Servicios</a>
                <a href="{{ url('/') }}#proceso" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">Proceso</a>
                <a href="{{ url('/') }}#contacto" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-slate-900 transition-colors">Contacto</a>
            </nav>

            {{-- Acceso Portal Clientes --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="px-6 py-2.5 border border-slate-900 text-slate-900 text-[9px] font-black uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-key text-[8px]"></i>
                    Portal
                </a>
            </div>
        </div>
    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-grow">
        @if(isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>

    {{-- FOOTER CONTENEDOR --}}
    <footer class="bg-[#0a0f1d] text-white border-t border-white/5 py-12 mt-auto">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                {{-- Copyright / Firma --}}
                <div class="space-y-2 text-center md:text-left">
                    <p class="text-[10px] font-mono text-slate-500 uppercase tracking-widest">
                        &copy; {{ date('Y') }} Gestión Inmobiliaria. Todos los derechos reservados.
                    </p>
                </div>

                {{-- Enlaces / Redes sutiles --}}
                <div class="flex items-center gap-8 text-[9px] font-black uppercase tracking-widest text-slate-400">
                    <a href="#nosotros" class="hover:text-white transition-colors">Legado</a>
                    <span class="text-white/10">•</span>
                    <a href="#contacto" class="hover:text-white transition-colors">Soporte</a>
                    <span class="text-white/10">•</span>
                    <a href="#" class="hover:text-white transition-colors">Aviso de Privacidad</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    @livewireScripts
</body>
</html>