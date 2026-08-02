{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    {{-- Header del módulo añadido --}}
    <x-shared::common.header 
        title="Nuevo Tipo de Crédito" 
        icon="fa-credit-card"
        desc="Configura un nuevo esquema de financiamiento aplicable a expedientes y fichas."
        :breadcrumb="[
            ['label' => 'Tipos de Crédito', 'url' => route('tipos-credito.index')],
            ['label' => 'Nuevo Crédito', 'url' => null]
        ]"
    />

    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Registrar Esquema de Crédito" 
                desc="Configure la disponibilidad del tipo de crédito financiero dentro de la plataforma." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 gap-6">
                    {{-- Nombre --}}
                    <div>
                        <x-shared::form.input-label for="nombre" :value="__('Nombre del Crédito')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="nombre" type="text" wire:model="nombre" placeholder="ej: INFONAVIT, Bancario, FOVISSSTE" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <x-shared::form.input-label for="descripcion" :value="__('Descripción o Alcance')" />
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="descripcion" type="text" wire:model="descripcion" placeholder="Opcional: Detalles del tipo de financiamiento"  />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    {{-- Flags de Aplicación --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                        {{-- Aplica para Viviendas --}}
                        <x-shared::form.checkbox-input
                            id="aplica_vivienda"
                            wire:model.live="aplica_vivienda"
                            label="Aplica para Viviendas"
                            description="Determina si este financiamiento puede ligarse a las propiedades."
                            :messages="$errors->get('aplica_vivienda')"
                        />

                        {{-- Aplica para Clientes --}}
                        <x-shared::form.checkbox-input
                            id="aplica_cliente"
                            wire:model.live="aplica_cliente"
                            label="Aplica para Clientes"
                            description="Determina si este financiamiento puede asignarse al perfil de un prospecto."
                            :messages="$errors->get('aplica_cliente')"
                        />
                    </div>
                </div>
                
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        {{-- Botón Cancelar (Enlace con estilo Danger) --}}
                        <x-shared::form.link 
                            :href="route('tipos-credito.index')" 
                            danger
                        >
                            <i class="fa-solid fa-xmark"></i>
                            <span>Cancelar</span>
                        </x-shared::form.link>
                        
                        {{-- Botón Registrar Crédito (Primary) --}}
                        <x-shared::form.button-form 
                            size="md"
                            type="submit" 
                            wire:loading.attr="disabled"
                        >
                            <i class="fa-solid fa-floppy-disk" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin" wire:loading></i> 
                            <span>Registrar Crédito</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>