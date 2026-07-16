@props([
    'id' => 'multiselect-' . uniqid(),
    'label' => null,
    'placeholder' => 'Buscar y seleccionar...',
    'options' => [], // Debe ser un array de arrays: [['id' => 1, 'label' => 'Texto'], ...]
    'messages' => [], // Manejo de errores de validación
])

<div class="w-full text-left" 
     x-data="{ 
         open: false, 
         search: '', 
         options: {{ json_encode($options) }},
         {{-- Entrelazamos dinámicamente con el wire:model de Livewire --}}
         value: @entangle($attributes->wire('model')),
         
         get filteredOptions() {
             return this.options.filter(opt => 
                 opt.label.toLowerCase().includes(this.search.toLowerCase()) && 
                 !(this.value || []).includes(opt.id)
             );
         },
         removeItem(index) {
             if (this.value) {
                 this.value.splice(index, 1);
             }
         },
         addItem(id) {
             if (!this.value) this.value = [];
             this.value.push(id);
             this.search = '';
         }
     }">
    
    @if($label)
        <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <div class="relative w-full">
        {{-- Caja principal contenedora de Tags e Input buscador --}}
        <div @click="open = !open" 
             @click.away="open = false"
             {{ $attributes->whereDoesntStartWith('wire:model')->merge([
                 'class' => "flex flex-wrap gap-2 min-h-11 w-full items-center rounded-lg border appearance-none px-3 py-1.5 cursor-pointer shadow-theme-xs placeholder:text-gray-400 focus-within:outline-hidden focus-within:ring-3 dark:bg-gray-900 transition-colors " . 
                 ($messages 
                     ? 'border-red-500 focus-within:border-red-500 focus-within:ring-red-500/10 text-red-650' 
                     : 'border-gray-300 dark:border-gray-700 focus-within:border-brand-300 focus-within:ring-brand-500/20 dark:focus-within:border-brand-800'
                 )
             ]) }}>
            
            {{-- Renderizado dinámico de los Tags seleccionados vía Alpine --}}
            <template x-for="(selectedId, index) in value" :key="selectedId">
                <span class="inline-flex items-center gap-1.5 bg-brand-50 text-brand-700 dark:bg-brand-950/40 dark:text-brand-400 px-2.5 py-1 text-xs font-bold border border-brand-100 dark:border-brand-900/40 rounded-md transition-all">
                    <span x-text="options.find(o => o.id == selectedId)?.label || selectedId"></span>
                    <button type="button" @click.stop="removeItem(index)" class="text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fa-solid fa-xmark text-[10px]"></i>
                    </button>
                </span>
            </template>

            {{-- Input de Escritura/Búsqueda integrado --}}
            <input 
                id="{{ $id }}"
                x-model="search"
                type="text"
                class="flex-1 min-w-[140px] text-sm bg-transparent border-none outline-none focus:ring-0 p-0 h-7 text-gray-800 dark:text-white/90"
                :placeholder="(value || []).length === 0 ? '{{ $placeholder }}' : ''"
                @keydown.escape="open = false"
            />
            
            {{-- Indicador visual derecho (Flecha o Cruz de error) --}}
            <span class="absolute right-3 text-gray-400 pointer-events-none">
                @if($messages)
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                @else
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                @endif
            </span>
        </div>

        {{-- Menú Desplegable Flotante --}}
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             x-cloak 
             class="absolute {{ $messages ? 'z-[999]' : 'z-[90]' }} mt-1.5 w-full bg-white dark:bg-gray-950 shadow-xl rounded-lg max-h-52 overflow-y-auto border border-gray-200 dark:border-gray-800 py-1">
            
            <ul class="text-sm font-medium text-gray-700 dark:text-gray-300">
                <template x-for="opt in filteredOptions" :key="opt.id">
                    <li @click.stop="addItem(opt.id)"
                        class="px-4 py-2.5 cursor-pointer hover:bg-brand-50 dark:hover:bg-brand-950/30 hover:text-brand-700 dark:hover:text-brand-400 transition-colors duration-150">
                        <span x-text="opt.label"></span>
                    </li>
                </template>
                
                {{-- Estado vacío si no hay coincidencias --}}
                <template x-if="filteredOptions.length === 0">
                    <li class="px-4 py-3 text-center text-xs text-gray-400 dark:text-gray-500 italic">
                        <i class="fa-solid fa-magnifying-glass mr-1"></i> Sin resultados o ya seleccionados
                    </li>
                </template>
            </ul>
        </div>
    </div>
    
    <x-shared::form.input-error :messages="$messages" class="mt-2" />
</div>