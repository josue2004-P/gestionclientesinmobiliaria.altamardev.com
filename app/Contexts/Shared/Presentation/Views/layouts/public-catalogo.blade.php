<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $title ?? 'Catálogo de Inmuebles — EstateLab')</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome Font Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Script Inline para evitar Flash de Tema Oscuro/Claro -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Store Alpine.js para tema oscuro/claro -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                    this.theme = savedTheme || systemTheme;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const body = document.body;
                    if (this.theme === 'dark') {
                        html.classList.add('dark');
                        body.classList.add('dark', 'bg-gray-900');
                    } else {
                        html.classList.remove('dark');
                        body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });
        });
    </script>

    @livewireStyles
</head>

<body class="antialiased text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col selection:bg-indigo-600 selection:text-white">

    <!-- HEADER PÚBLICO SLIM -->
    <header class="sticky top-0 z-50 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md border-b border-gray-200/80 dark:border-gray-700/80 h-20 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between gap-4">
            
            <!-- BRAND / LOGO -->
            <div class="flex items-center gap-3">
                <span class="text-xl font-black tracking-tight text-gray-900 dark:text-white">
                    ESTATELAB<span class="text-indigo-600 dark:text-indigo-400">.</span>
                </span>
                <span class="hidden sm:inline-block text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/50 px-2.5 py-1 rounded-lg border border-indigo-100 dark:border-indigo-900/50">
                    Catálogo de Inmuebles
                </span>
            </div>

            <!-- CONTROLES DERECHOS (TEMA + CONTACTO WHATSAPP) -->
            <div class="flex items-center gap-3">
                <!-- Toggle Dark / Light -->
                <button @click="$store.theme.toggle()" 
                        type="button"
                        class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 flex items-center justify-center transition"
                        title="Cambiar tema">
                    <i x-show="$store.theme.theme === 'light'" class="fa-solid fa-moon text-sm"></i>
                    <i x-show="$store.theme.theme === 'dark'" class="fa-solid fa-sun text-sm text-amber-400"></i>
                </button>

                <!-- CTA WhatsApp Directo -->
                <a href="https://wa.me/521223456789?text=Hola,%20me%20gustaría%20recibir%20asesoría%20sobre%20las%20propiedades%20del%20catálogo" 
                   target="_blank" 
                   class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-4 py-2.5 rounded-xl text-xs uppercase tracking-wider transition shadow-sm flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span class="hidden sm:inline">Contactar Asesor</span>
                    <span class="sm:hidden">Contacto</span>
                </a>
            </div>

        </div>
    </header>

    <!-- CONTENIDO PRINCIPAL DE LA PÁGINA -->
    <main class="flex-1 py-8">
        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset
    </main>

    <!-- BOTÓN FLOTANTE GENERAL DE WHATSAPP -->
    <a href="https://wa.me/521223456789?text=Hola,%20estoy%20viendo%20su%20catálogo%20de%20propiedades" 
       target="_blank" 
       class="fixed bottom-6 right-6 z-50 bg-emerald-500 hover:bg-emerald-600 text-white w-12 h-12 sm:w-14 sm:h-14 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition duration-300">
        <i class="fa-brands fa-whatsapp text-xl sm:text-2xl"></i>
    </a>

    <!-- FOOTER PÚBLICO -->
    <footer class="mt-auto bg-white dark:bg-gray-800 border-t border-gray-200/80 dark:border-gray-700/80 py-6 transition-colors duration-200 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            
            <div class="flex items-center gap-2.5 text-gray-500 dark:text-gray-400">
                <span class="font-black text-gray-900 dark:text-white">
                    ESTATELAB<span class="text-indigo-600 dark:text-indigo-400">.</span>
                </span>
                <span class="text-gray-300 dark:text-gray-600">|</span>
                <p>© {{ date('Y') }} Todos los derechos reservados.</p>
            </div>

            <div class="flex items-center gap-5 text-gray-500 dark:text-gray-400 font-medium">
                <a href="https://wa.me/521223456789" target="_blank" class="hover:text-emerald-500 dark:hover:text-emerald-400 transition flex items-center gap-1.5">
                    <i class="fa-brands fa-whatsapp text-sm text-emerald-500"></i>
                    <span>Atención y Soporte</span>
                </a>
                <span class="text-gray-300 dark:text-gray-600">•</span>
                <span class="text-gray-400 dark:text-gray-500">Catálogo Digital</span>
            </div>

        </div>
    </footer>

    @livewireScripts
    @stack('scripts')

</body>
</html>