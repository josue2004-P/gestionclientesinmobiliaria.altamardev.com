@props([
    'placeholder' => '-- SELECCIONAR --',
    'messages' => [],
    'disabled' => false,
    'liveSearch' => null 
])

<div 
    x-data="{
        open: false,
        disabled: false, 
        search: '',
        value: @entangle($attributes->wire('model')),
        options: [],
        
        init() {
            this.disabled = $el.hasAttribute('disabled') || {{ $disabled ? 'true' : 'false' }};
            
            // 📥 Carga inicial de opciones
            this.parseOptions();

            // ⚡ Observador del Slot: Si Livewire cambia las opciones del select, Alpine las recarga al vuelo
            const slotObserver = new MutationObserver(() => {
                this.parseOptions();
            });
            slotObserver.observe(this.$refs.selectSlot, { childList: true, subtree: true });

            // 🛠️ Observador del estado disabled
            const disabledObserver = new MutationObserver(() => {
                this.disabled = $el.hasAttribute('disabled');
            });
            disabledObserver.observe($el, { attributes: true, attributeFilter: ['disabled'] });
        },

        parseOptions() {
            this.options = Array.from(this.$refs.selectSlot.options)
                .map(opt => ({
                    value: opt.value,
                    label: opt.text
                }));
        },

        toggle() {
            if (this.disabled) return; 
            this.open = !this.open;
            if (this.open) {
                this.$nextTick(() => this.$refs.searchInput?.focus());
            }
        },

        get selectedLabel() {
            const selected = this.options.find(opt => opt.value == this.value && opt.value !== '');
            return selected ? selected.label : '{{ $placeholder }}';
        },

        get filteredOptions() {
            return this.options.filter(opt => 
                opt.label.toLowerCase().includes(this.search.toLowerCase())
            );
        },

        select(val) {
            this.value = val;
            this.open = false;
            
            if (!{{ $liveSearch ? 'true' : 'false' }}) {
                this.search = '';
            }
        }
    }"
    @click.outside="open = false"
    {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'relative w-full']) }}
    :class="disabled ? 'opacity-60 cursor-not-allowed' : ''"
>
    {{-- SELECT OCULTO QUE ESCUCHA A LIVEWIRE --}}
    <select x-ref="selectSlot" class="hidden">
        {{ $slot }}
    </select>

    {{-- Gatillo del Dropdown (Clases EXACTAS del text-input) --}}
    <div 
        @click="toggle()"
        :class="disabled ? 'pointer-events-none' : 'cursor-pointer'"
        class="dark:bg-dark-900 shadow-theme-xs flex h-11 w-full items-center justify-between rounded-md border px-4 py-2.5 pr-10 text-sm bg-transparent transition-colors duration-200 select-none {{ 
            $messages 
                ? 'border-red-300 text-error-600 focus:ring-3 focus:ring-red-500/10' 
                : 'border-gray-300 text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:focus:border-brand-800' 
        }}"
    >
        <span 
            x-text="selectedLabel" 
            :class="value ? 'text-gray-800 dark:text-white/90 font-medium' : 'text-gray-400 dark:text-white/30'" 
            class="truncate pr-2"
        ></span>

        {{-- Contenedor de iconos a la derecha (Misma estructura que text-input) --}}
        <div class="absolute top-1/2 right-4 z-10 -translate-y-1/2 pointer-events-none flex items-center gap-2">
            @if($messages)
                <svg class="h-4 w-4 text-red-500 dark:text-red-400 shrink-0" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 7.99992 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"/>
                </svg>
            @endif

            <i class="fa-solid fa-chevron-down text-sm text-gray-500 dark:text-gray-400 transition-transform duration-200 shrink-0" :class="open ? 'rotate-180' : ''"></i>
        </div>
    </div>

    {{-- Panel Desplegable Flotante --}}
    <div 
        x-show="open" 
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1 scale-98"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-1 scale-98"
        class="absolute z-[9999] mt-1.5 w-full bg-white dark:bg-gray-900 shadow-2xl rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden backdrop-blur-md"
        >
        {{-- Buscador Interno --}}
        <div class="p-2 border-b border-gray-100 dark:border-gray-800/80 bg-gray-50/50 dark:bg-gray-950/40">
            <div class="relative flex items-center">
                <i class="fa-solid fa-magnifying-glass absolute left-3 text-sm text-gray-400 dark:text-gray-500"></i>
                <input 
                    x-ref="searchInput"
                    x-model="search"
                    @if($liveSearch) wire:model.live.debounce.350ms="{{ $liveSearch }}" @endif
                    type="text"
                    class="h-9 w-full rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 pl-8 pr-3 text-sm focus:border-brand-300 focus:ring-2 focus:ring-brand-500/10 dark:focus:border-brand-800 focus:outline-none dark:text-white placeholder:text-gray-400 dark:placeholder:text-white/30 transition-colors"
                    placeholder="BUSCAR..."
                    @click.stop
                >
            </div>
        </div>

        {{-- Lista de Opciones --}}
        <ul class="max-h-56 overflow-y-auto p-1.5 space-y-0.5 scrollbar-thin scrollbar-thumb-gray-200 dark:scrollbar-thumb-gray-800">
            <template x-for="opt in filteredOptions" :key="opt.value">
                <li 
                    @click="select(opt.value)"
                    class="group relative px-3 py-2 text-sm rounded-lg cursor-pointer transition-all duration-150 flex items-center justify-between"
                    :class="{
                        {{-- Seleccionada --}}
                        'bg-brand-50/70 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 font-semibold': value == opt.value && opt.value !== '',
                        {{-- Sin asignar / Vacía --}}
                        'text-gray-400 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800/60 italic': opt.value === '',
                        {{-- Normales con Hover --}}
                        'text-gray-700 dark:text-gray-200 hover:bg-brand-50/50 dark:hover:bg-gray-800 hover:text-brand-600 dark:hover:text-brand-300 font-normal hover:translate-x-0.5': value != opt.value && opt.value !== ''
                    }"
                >
                    <span x-text="opt.label" class="truncate pr-2"></span>
                    
                    {{-- Indicador Check para la opción activa --}}
                    <template x-if="value == opt.value && opt.value !== ''">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-brand-100 dark:bg-brand-500/20 text-brand-600 dark:text-brand-400 shrink-0 ml-2">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </span>
                    </template>
                </li>
            </template>

            {{-- Sin resultados --}}
            <li x-show="filteredOptions.length === 0" class="px-4 py-4 text-sm text-gray-400 dark:text-gray-500 italic text-center flex flex-col items-center justify-center gap-1">
                <i class="fa-solid fa-inbox text-base text-gray-300 dark:text-gray-600"></i>
                <span>Sin resultados encontrados...</span>
            </li>
        </ul>
    </div>
</div>