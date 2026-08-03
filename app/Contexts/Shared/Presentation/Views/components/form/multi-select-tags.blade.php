@props([
    'id' => 'multiselect-' . uniqid(),
    'label' => null,
    'placeholder' => 'Buscar y seleccionar...',
    'options' => [], // Array: [['id' => 1, 'label' => 'Texto'], ...]
    'messages' => [],
])

<div class="w-full text-left" 
     x-data="{ 
         open: false, 
         search: '', 
         options: {{ json_encode($options) }},
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
             this.open = true;
             
             // Mantiene el input enfocado y la lista desplegada de corrido
             this.$nextTick(() => {
                 this.open = true;
                 this.$refs.searchInput.focus();
             });
         },
         removeLastItem() {
             if (this.search === '' && this.value && this.value.length > 0) {
                 this.value.pop();
             }
         }
     }"
     @click.outside="open = false">
    
    @if($label)
        <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <div class="relative w-full">
        {{-- Caja principal contenedora --}}
        <div @click="open = true; $refs.searchInput.focus()" 
             {{ $attributes->whereDoesntStartWith('wire:model')->merge([
                 'class' => "
                     dark:bg-dark-900 shadow-theme-xs
                     focus-within:border-brand-300 focus-within:ring-brand-500/10 dark:focus-within:border-brand-800
                     min-h-11 w-full rounded-md border
                     " . ($messages ? 'border-red-300 text-error-600' : 'border-gray-300 text-gray-800 dark:border-gray-700 dark:bg-gray-900') . "
                     bg-transparent px-4 py-2.5 pr-10 text-sm
                     focus-within:ring-3 focus-within:outline-hidden
                     dark:text-white/90
                     flex flex-wrap items-center gap-2 cursor-text transition-colors duration-200
                 "
             ]) }}>
            
            {{-- Tags seleccionados --}}
            <template x-for="(selectedId, index) in value" :key="selectedId">
                <span class="inline-flex items-center gap-1.5 bg-brand-50/80 text-brand-700 dark:bg-brand-500/10 dark:text-brand-400 px-2.5 py-0.5 text-sm font-semibold border border-brand-100 dark:border-brand-500/20 rounded-md transition-all select-none">
                    <span x-text="options.find(o => o.id == selectedId)?.label || selectedId"></span>
                    <button type="button" @click.stop="removeItem(index)" class="text-gray-400 hover:text-red-500 dark:text-gray-500 dark:hover:text-red-400 transition-colors">
                        <i class="fa-solid fa-xmark text-[10px]"></i>
                    </button>
                </span>
            </template>

            {{-- Input de Búsqueda --}}
            <input 
                id="{{ $id }}"
                x-ref="searchInput"
                x-model="search"
                type="text"
                class="flex-1 min-w-[140px] text-sm bg-transparent border-none outline-none focus:ring-0 p-0 h-6 text-gray-800 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30"
                :placeholder="(value || []).length === 0 ? '{{ $placeholder }}' : ''"
                @focus="open = true"
                @click.stop="open = true"
                @keydown.keydown.backspace="removeLastItem()"
                @keydown.escape="open = false"
            />
            
            {{-- Indicador visual derecho --}}
            <div class="absolute top-1/2 right-4 z-10 -translate-y-1/2 pointer-events-none flex items-center gap-2">
                @if($messages)
                    <svg class="h-4 w-4 text-red-500 dark:text-red-400 shrink-0" viewBox="0 0 16 16" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 7.99992 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"/>
                    </svg>
                @endif
                
                <i class="fa-solid fa-chevron-down text-sm text-gray-500 dark:text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
            </div>
        </div>

        {{-- Menú Desplegable Flotante --}}
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 translate-y-1 scale-98"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-1 scale-98"
             x-cloak 
             class="absolute z-[999] mt-1.5 w-full bg-white dark:bg-gray-900 shadow-xl rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden backdrop-blur-md">
            
            <ul class="max-h-56 overflow-y-auto p-1.5 space-y-0.5 scrollbar-thin scrollbar-thumb-gray-200 dark:scrollbar-thumb-gray-800">
                <template x-for="opt in filteredOptions" :key="opt.id">
                    <li @mousedown.prevent="addItem(opt.id)"
                        class="group relative px-3 py-2 text-sm rounded-lg cursor-pointer transition-all duration-150 flex items-center justify-between text-gray-700 dark:text-gray-200 hover:bg-brand-50/50 dark:hover:bg-gray-800 hover:text-brand-600 dark:hover:text-brand-300 hover:translate-x-0.5">
                        <span x-text="opt.label" class="truncate pr-2"></span>
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-gray-100 dark:bg-gray-800 group-hover:bg-brand-100 dark:group-hover:bg-brand-500/20 text-gray-400 group-hover:text-brand-600 dark:group-hover:text-brand-400 shrink-0 transition-colors">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                        </span>
                    </li>
                </template>
                
                {{-- Estado vacío --}}
                <template x-if="filteredOptions.length === 0">
                    <li class="px-4 py-4 text-center text-sm text-gray-400 dark:text-gray-500 italic flex flex-col items-center justify-center gap-1">
                        <i class="fa-solid fa-inbox text-base text-gray-300 dark:text-gray-600"></i>
                        <span>Sin resultados o ya seleccionados</span>
                    </li>
                </template>
            </ul>
        </div>
    </div>
    
    <x-shared::form.input-error :messages="$messages" class="mt-2" />
</div>