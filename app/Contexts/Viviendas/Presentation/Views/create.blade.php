<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    <x-shared::common.header 
        title="Ficha de Inmueble" 
        icon="fa-house-medical-flag"
        desc="Carga y actualización del inventario transaccional del sistema."
        :breadcrumb="[
            ['label' => 'Inventario', 'url' => route('viviendas.index')],
            ['label' => 'Ficha Técnica', 'url' => null]
        ]"
    />

    {{-- Envolvente Alpine con persistencia local --}}
    <div 
        class="max-w-5xl text-left" 
        wire:ignore.self
        x-data="{ 
            tab: localStorage.getItem('vivienda_active_tab') || 'general',
            setTab(val) {
                this.tab = val;
                localStorage.setItem('vivienda_active_tab', val);
            }
        }"
    >
        <form wire:submit="save">

            {{-- Navegación de Tabs Responsiva (MóvilScroll + Desktop) --}}
            <div class="border-b border-gray-200 dark:border-gray-800 mb-6">
                <nav class="-mb-px flex space-x-2 sm:space-x-4 overflow-x-auto no-scrollbar py-1" aria-label="Tabs">
                    
                    {{-- Tab 1: Ficha del Inmueble --}}
                    <button
                        type="button"
                        @click="setTab('general')"
                        :class="tab === 'general' 
                            ? 'border-indigo-600 dark:border-indigo-500 text-indigo-600 dark:text-indigo-400 font-bold bg-indigo-50/70 dark:bg-indigo-950/40' 
                            : 'border-transparent text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100/60 dark:hover:bg-gray-900/50 font-medium'"
                        class="whitespace-nowrap pb-2.5 pt-2 px-3.5 border-b-2 rounded-t-lg text-xs sm:text-sm flex items-center gap-2 transition-all cursor-pointer shrink-0"
                    >
                        <i class="fa-solid fa-house text-xs sm:text-sm"></i>
                        <span>Ficha del Inmueble</span>
                    </button>

                    {{-- Tab 2: Contactos --}}
                    <button
                        type="button"
                        @click="setTab('contactos')"
                        :class="tab === 'contactos' 
                            ? 'border-indigo-600 dark:border-indigo-500 text-indigo-600 dark:text-indigo-400 font-bold bg-indigo-50/70 dark:bg-indigo-950/40' 
                            : 'border-transparent text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100/60 dark:hover:bg-gray-900/50 font-medium'"
                        class="whitespace-nowrap pb-2.5 pt-2 px-3.5 border-b-2 rounded-t-lg text-xs sm:text-sm flex items-center gap-2 transition-all cursor-pointer shrink-0"
                    >
                        <i class="fa-solid fa-address-book text-xs sm:text-sm"></i>
                        <span>Contactos</span>
                        <span 
                            class="px-2 py-0.5 text-[10px] font-semibold rounded-full border transition-colors"
                            :class="tab === 'contactos'
                                ? 'bg-indigo-100 dark:bg-indigo-900/60 text-indigo-700 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800'
                                : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700'"
                        >
                            {{ count($contactos) }}
                        </span>
                    </button>

                    {{-- Tab 3: Expediente Digital y Galería --}}
                    <button
                        type="button"
                        @click="setTab('expediente_fotos')"
                        :class="tab === 'expediente_fotos' 
                            ? 'border-indigo-600 dark:border-indigo-500 text-indigo-600 dark:text-indigo-400 font-bold bg-indigo-50/70 dark:bg-indigo-950/40' 
                            : 'border-transparent text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100/60 dark:hover:bg-gray-900/50 font-medium'"
                        class="whitespace-nowrap pb-2.5 pt-2 px-3.5 border-b-2 rounded-t-lg text-xs sm:text-sm flex items-center gap-2 transition-all cursor-pointer shrink-0"
                    >
                        <i class="fa-solid fa-folder-open text-xs sm:text-sm"></i>
                        <span>Expediente y Fotos</span>
                        <span 
                            class="px-2 py-0.5 text-[10px] font-semibold rounded-full border transition-colors"
                            :class="tab === 'expediente_fotos'
                                ? 'bg-indigo-100 dark:bg-indigo-900/60 text-indigo-700 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800'
                                : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700'"
                        >
                            {{ count($documentos) + count($fotos) }}
                        </span>
                    </button>

                </nav>
            </div>

            {{-- Tarjeta Principal --}}
            <x-shared::common.component-card 
                title="Estructura Física y Financiera de la Propiedad" 
                desc="Los datos ingresados se utilizarán de manera reactiva para las cotizaciones automáticas y expedientes fiscales." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="mt-2">
                    
                    {{-- TAB 1: INFORMACIÓN GENERAL --}}
                    <div x-show="tab === 'general'" x-cloak class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @include('viviendas::partials.datos-generales')
                            @include('viviendas::partials.ubicacion-geografica')
                        </div>
                        @include('viviendas::partials.amenidades-creditos')
                    </div>

                    {{-- TAB 2: CONTACTOS RELACIONADOS --}}
                    <div x-show="tab === 'contactos'" x-cloak>
                        @include('viviendas::partials.contactos')
                    </div>

                    {{-- TAB 3: EXPEDIENTE Y FOTOS --}}
                    <div x-show="tab === 'expediente_fotos'" x-cloak class="space-y-8">
                        <div>
                            @livewire('viviendas::vivienda-documentos-section', ['documentos' => $documentos])
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-800"></div>

                        <div>
                            @livewire('viviendas::vivienda-fotos-section', ['fotos' => $fotos])
                        </div>
                    </div>

                </div>

                {{-- Footer con Botones de Acción --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between w-full">
                        <x-shared::form.link :href="route('viviendas.index')" danger>
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </x-shared::form.link>

                        <x-shared::form.button-form 
                            type="submit" 
                            variant="primary" 
                            size="md"
                            wire:loading.attr="disabled"
                            wire:target="save"
                        >
                            <i class="fa-solid fa-floppy-disk text-sm" wire:loading.remove wire:target="save"></i>
                            <i class="fa-solid fa-circle-notch animate-spin text-sm" wire:loading wire:target="save"></i>
                            <span wire:loading.remove wire:target="save">Guardar Cambios</span>
                            <span wire:loading wire:target="save">Procesando...</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>

        </form>
    </div>
</div>