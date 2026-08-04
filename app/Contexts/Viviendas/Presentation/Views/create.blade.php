<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    <x-shared::common.header 
        title="Nueva Ficha de Inmueble" 
        icon="fa-house-medical-flag"
        desc="Carga de una nueva vivienda al inventario transaccional del sistema."
        :breadcrumb="[
            ['label' => 'Inventario', 'url' => route('viviendas.index')],
            ['label' => 'Nueva Ficha', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Estructura Física y Financiera de la Propiedad" 
                desc="Los datos ingresados se utilizarán de manera reactiva para las cotizaciones automáticas y expedientes fiscales." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @include('viviendas::partials.datos-generales')
                    @include('viviendas::partials.ubicacion-geografica')
                    @include('viviendas::partials.amenidades-creditos')
                    @include('viviendas::partials.contactos')
                    @include('viviendas::partials.expediente-archivos')
                </div>
                
                <x-slot:footer>
                    <div class="flex items-center justify-between w-full">
                        {{-- Botón Cancelar  --}}
                        <x-shared::form.link 
                            :href="route('viviendas.index')" 
                            danger
                        >
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </x-shared::form.link>

                        {{-- Botón Guardar / Acción con soporte Livewire --}}
                        <x-shared::form.button-form 
                            type="submit" 
                            variant="primary" 
                            size="md"
                            wire:loading.attr="disabled"
                            wire:target="save"
                        >
                            <i class="fa-solid fa-floppy-disk text-sm" wire:loading.remove wire:target="save"></i>
                            <i class="fa-solid fa-circle-notch animate-spin text-sm" wire:loading wire:target="save"></i>
                            <span class="" wire:loading.remove wire:target="save">Generar Ficha Técnica</span>
                            <span class="" wire:loading wire:target="save">Procesando...</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>