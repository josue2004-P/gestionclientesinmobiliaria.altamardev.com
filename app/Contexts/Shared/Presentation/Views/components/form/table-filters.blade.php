@props([
    'search' => null,
    'perPage' => null,
    'exportPdf' => null,
    'exportExcel' => null,
    'createRoute' => null,
    'title' => 'Registros'
])

<div class="rounded-md border border-gray-200 bg-white shadow-sm transition-all duration-300 dark:border-gray-800 dark:bg-gray-900/50">
    
    {{-- BARRA SUPERIOR PREMIUM --}}
    <div class="p-6">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center flex-grow">
                @if($search !== null)
                <div class="relative w-full sm:w-80 group">
                    <x-shared::form.text-input 
                        wire:model.live.debounce.400ms="search" 
                        placeholder="Buscar..." 
                        class="pl-12 pr-10" 
                    />

                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-450 group-focus-within:text-indigo-600 dark:text-gray-500 dark:group-focus-within:text-indigo-400 transition-colors pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-base"></i>
                    </div>

                    <div wire:loading wire:target="search" class="absolute right-4 top-1/2 -translate-y-1/2">
                        <div class="h-4 w-4 animate-spin rounded-full border-2 border-indigo-500 border-t-transparent dark:border-indigo-400"></div>
                    </div>
                </div>
                @endif
            </div>

            <div class="flex flex-wrap items-center gap-3">
                
                @if($exportPdf || $exportExcel)
                <div class="flex items-center gap-1 rounded-md bg-gray-100/80 p-1.5 dark:bg-white/[0.03] border border-gray-200 dark:border-gray-800 transition-colors">
                    @if($exportPdf)
                        <a href="{{ $exportPdf }}" target="_blank" 
                           class="flex h-9 w-9 items-center justify-center rounded-md text-gray-500 dark:text-gray-400 transition-all hover:bg-white hover:text-red-600 dark:hover:bg-gray-850 dark:hover:text-red-400 hover:shadow-sm">
                            <i class="fa-solid fa-file-pdf"></i>
                        </a>
                    @endif
                    @if($exportExcel)
                        <a href="{{ $exportExcel }}" 
                           class="flex h-9 w-9 items-center justify-center rounded-md text-gray-500 dark:text-gray-400 transition-all hover:bg-white hover:text-green-650 dark:hover:bg-gray-850 dark:hover:text-green-400 hover:shadow-sm">
                            <i class="fa-solid fa-file-excel"></i>
                        </a>
                    @endif
                </div>
                @endif

                @if($perPage !== null)
                <div class="relative">
                    <select 
                        wire:model.live="perPage" 
                        class=" h-10  border appearance-none rounded-md border-gray-200 bg-white pl-4 pr-10 text-sm font-semibold  text-gray-700 transition-all focus:ring-4 focus:ring-indigo-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:focus:ring-indigo-500/20 focus:outline-none"
                    >
                        <option value="7">7 Filas</option>
                        <option value="25">25 Filas</option>
                        <option value="50">50 Filas</option>
                    </select>
                    <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
                @endif

                @if(isset($filters) && $filters->isNotEmpty())
                <button 
                    @click="$dispatch('toggle-filtros')" 
                    class="group inline-flex h-[46px] items-center rounded-2xl border border-indigo-100 bg-indigo-50/50 px-5 text-sm font-extrabold text-indigo-700 transition-all hover:bg-indigo-100 dark:border-indigo-500/20 dark:bg-indigo-500/5 dark:text-indigo-300 dark:hover:bg-indigo-500/10"
                >
                    <i class="fa-solid fa-sliders mr-2.5 transition-transform group-hover:rotate-12"></i>
                    Filtros Avanzados
                </button>
                @endif

                @if(isset($actions))
                    <div class="flex items-center gap-2">
                        {{ $actions }}
                    </div>
                @endif
                @if($createRoute)
                    <x-shared::ui.button
                        tag="a" 
                        size="sm"
                        href="{{ $createRoute }}" 
                        class="font-bold"
                    >
                        <i class="fa-solid fa-plus mr-2 text-xs"></i>
                        {{ __('Nuevo Registro') }}
                    </x-shared::form.button-primary>
                @endif
            </div>
        </div>
    </div>

    {{-- FILTROS AVANZADOS CON CONTROL DE SELECT2 --}}
    <div 
        x-data="{ show: false }" 
        @toggle-filtros.window="show = !show"
        x-show="show"
        x-cloak
        x-collapse
        class="border-t border-gray-200 bg-gray-50/50 dark:border-gray-800 dark:bg-gray-900/50"
    >
        <div class="px-6 py-6 lg:px-8">
            <div 
                class="grid grid-cols-1 gap-6 sm:grid-cols-12"
                x-init="
                    $watch('show', value => {
                        if(value) {
                            $nextTick(() => {
                                $('.select2-dynamic').each(function () {
                                    const $el = $(this);
                                    if ($el.data('select2')) $el.select2('destroy');
                                    $el.select2({
                                        placeholder: $el.data('placeholder') || 'Seleccionar...',
                                        allowClear: true,
                                        width: '100%',
                                        containerCssClass: 'premium-select2'
                                    }).on('change', function() {
                                        @this.set($el.data('model'), $(this).val());
                                    });
                                });
                            });
                        }
                    });
                    
                    Livewire.on('reinit-select2', () => {
                        $('.select2-dynamic').each(function () {
                            const $el = $(this);
                            $el.select2({
                                placeholder: $el.data('placeholder') || 'Seleccionar...',
                                allowClear: true,
                                width: '100%',
                                containerCssClass: 'premium-select2'
                            }).on('change', function() {
                                @this.set($el.data('model'), $(this).val());
                            });
                        });
                    });
                "
            >
                {{ $filters }}
            </div>
        </div>
    </div>

{{-- ÁREA DE TABLA --}}
    <div class="relative">
        <div wire:loading.delay.longest 
             wire:target="search, perPage, deleteAsentamiento"
             class="absolute inset-0 z-20 flex items-center justify-center bg-white/60 backdrop-blur-[2px] dark:bg-gray-900/60 transition-all">
            <div class="flex flex-col items-center">
                <div class="h-10 w-10 animate-spin rounded-full border-4 border-indigo-600 border-t-transparent shadow-lg shadow-indigo-500/20 dark:border-indigo-400"></div>
                <span class="mt-3 text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 animate-pulse">Sincronizando...</span>
            </div>
        </div>
        
        {{-- CAMBIO AQUÍ: Se reemplaza rounded-b-3xl por rounded-b-md --}}
        <div class="overflow-x-auto rounded-b-md">
            {{ $slot }}
        </div>
    </div>
</div>