<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $title ?? 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://kit.fontawesome.com/698b0c3ebe.js" crossorigin="anonymous"></script>

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

            Alpine.store('sidebar', {
                isExpanded: window.innerWidth >= 1280,
                isMobileOpen: false,
                isHovered: false,
                isApplicationMenuOpen: false,

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    this.isMobileOpen = false;
                    if (this.isExpanded) this.isApplicationMenuOpen = false;
                },
                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                    if (this.isMobileOpen) this.isApplicationMenuOpen = false;
                },
                toggleApplicationMenu() {
                    this.isApplicationMenuOpen = !this.isApplicationMenuOpen;
                    if (this.isApplicationMenuOpen) this.isMobileOpen = false;
                },
                setMobileOpen(val) {
                    this.isMobileOpen = val;
                    if (val) this.isApplicationMenuOpen = false;
                },
                setHovered(val) {
                    if (window.innerWidth >= 1280 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>

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
    
    @livewireStyles  
</head>

<body 
    x-data="{ loaded: true }" 
    x-init="$store.sidebar.isExpanded = window.innerWidth >= 1280;
    const checkMobile = () => {
        if (window.innerWidth < 1280) {
            $store.sidebar.setMobileOpen(false);
            $store.sidebar.isExpanded = false;
        } else {
            $store.sidebar.isMobileOpen = false;
            $store.sidebar.isExpanded = true;
        }
    };
    window.addEventListener('resize', checkMobile);"
    class="antialiased text-gray-600 dark:text-gray-400"
>
    {{-- Preloader --}}
    <x-shared::common.preloader/>

    <div class="min-h-screen xl:flex">
        @include('shared::layouts.backdrop')
        @include('shared::layouts.sidebar')

        <div class="flex-1 transition-all duration-300 ease-in-out"
            :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">
            
            @include('shared::layouts.app-header')

            <div class="p-4 md:p-6">
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </div>
        </div>
    </div>

    @include('shared::partials.alerts')
    
    @livewireScripts 
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sortable engine global
            const lists = document.querySelectorAll('.sortable-list');
            lists.forEach(list => {
                new Sortable(list, {
                    animation: 150,
                    handle: '.sortable-item',
                    ghostClass: 'bg-purple-50',
                    onEnd: function() {
                        const items = list.querySelectorAll('.sortable-item');
                        items.forEach((item, index) => {
                            const newOrder = index + 1;
                            if(item.querySelector('.input-orden')) item.querySelector('.input-orden').value = newOrder;
                            if(item.querySelector('.badge-orden')) item.querySelector('.badge-orden').textContent = '#' + newOrder;
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>