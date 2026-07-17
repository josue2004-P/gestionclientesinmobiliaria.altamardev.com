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

            // ⚡ 1. Observador del Slot: Si Livewire cambia las opciones del select, Alpine las recarga al vuelo
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
                })).filter(opt => opt.value !== '');
        },

        toggle() {
            if (this.disabled) return; 
            this.open = !this.open;
        },

        get selectedLabel() {
            const selected = this.options.find(opt => opt.value == this.value);
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
            
            // Si es búsqueda local limpiamos, si es remota mantenemos el término para evitar parpadeos
            if (!{{ $liveSearch ? 'true' : 'false' }}) {
                this.search = '';
            }
        }
    }"
    {{ $attributes->merge(['class' => 'relative w-full']) }}
    :class="disabled ? 'opacity-60 cursor-not-allowed' : ''"
>
    {{-- SELECT OCULTO QUE ESCUCHA A LIVEWIRE --}}
    <select x-ref="selectSlot" class="hidden">
        {{ $slot }}
    </select>

    {{-- Gatillo del Dropdown --}}
    <div 
        @click="toggle()"
        @click.away="open = false"
        :class="disabled ? 'pointer-events-none' : 'cursor-pointer'"
        class="flex h-[38px] items-center justify-between rounded border px-3 font-sans text-[12px] font-medium transition-all duration-200 dark:bg-[#001f3f]/50 {{ 
            $messages ? 'border-red-500 text-red-600' : 'border-slate-400 text-slate-700 dark:border-slate-700 dark:text-white' 
        }}"
    >
        <span x-text="selectedLabel" :class="value ? '' : 'text-slate-400 dark:text-white/20'"></span>
        <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
    </div>

    {{-- Panel Desplegable --}}
    <div 
        x-show="open" 
        x-cloak
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="absolute z-[999] mt-1 w-full bg-white dark:bg-[#001f3f] shadow-lg max-h-60 rounded border border-slate-300 dark:border-slate-700  flex flex-col"
    >
        {{-- Buscador Único --}}
        <div class="p-2 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#001f3f]">
            <input 
                x-model="search"
                @if($liveSearch) wire:model.live.debounce.350ms="{{ $liveSearch }}" @endif {{-- ⚡ Enlace dinámico al backend --}}
                type="text"
                class="h-8 w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-[#001f3f] px-3 text-[12px] focus:outline-none dark:text-white font-mono uppercase"
                placeholder="BUSCAR..."
                @click.stop
            >
        </div>

        {{-- Lista de Opciones --}}
        <ul class="overflow-y-auto py-1">
            <template x-for="opt in filteredOptions" :key="opt.value">
                <li 
                    @click="select(opt.value)"
                    class="px-4 py-2 text-[12px] cursor-pointer hover:bg-[#001f3f] hover:text-white transition-colors dark:text-slate-200"
                    :class="value == opt.value ? 'bg-slate-100 dark:bg-slate-800 font-bold' : ''"
                >
                    <span x-text="opt.label"></span>
                </li>
            </template>

            <li x-show="filteredOptions.length === 0" class="px-4 py-2 text-[11px] text-slate-400 italic text-center uppercase font-bold">
                Sin resultados...
            </li>
        </ul>
    </div>
</div>