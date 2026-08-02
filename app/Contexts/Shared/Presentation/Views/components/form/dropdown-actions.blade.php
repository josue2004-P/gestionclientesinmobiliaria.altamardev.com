@props([
    'title' => 'Acciones',
])

<td {{ $attributes->merge(['class' => 'px-6 py-4 text-center whitespace-nowrap z-30']) }}>
    <div 
        x-data="{ 
            dropdownOpen: false, 
            position: { top: 0, left: 0 },
            toggle(e) {
                this.dropdownOpen = !this.dropdownOpen;
                if (this.dropdownOpen) {
                    let rect = e.currentTarget.getBoundingClientRect();
                    this.position.top = rect.bottom + window.scrollY + 8;
                    this.position.left = rect.right - 208 + window.scrollX;
                }
            }
        }" 
        class="inline-block text-left"
    >
        {{-- Botón Trigger (Acción) --}}
        <button 
            @click="toggle($event)" 
            type="button"
            class="p-2.5 rounded-md text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all border border-transparent hover:border-indigo-100 dark:hover:border-indigo-500/20 shadow-xs"
        >
            <i class="fa-solid fa-ellipsis-vertical text-base"></i>
        </button>

        {{-- Menú desplegable con Teleport --}}
        <template x-teleport="body">
            <div 
                x-show="dropdownOpen" 
                @click.away="dropdownOpen = false"
                x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :style="`position: absolute; top: ${position.top}px; left: ${position.left}px;`"
                class="z-[200] w-52 rounded-md border border-gray-200 dark:border-gray-800 bg-white/95 dark:bg-gray-900/95 text-gray-700 dark:text-gray-200 shadow-xl dark:shadow-2xl p-1.5 backdrop-blur-md transition-colors"
            >
                @if($title)
                    <div class="px-3 py-2 text-[12px] font-bold text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-800 mb-1.5 text-left transition-colors uppercase tracking-wider">
                        {{ $title }}
                    </div>
                @endif

                <div class="space-y-0.5 text-left">
                    {{ $slot }}
                </div>
            </div>
        </template>
    </div>
</td>