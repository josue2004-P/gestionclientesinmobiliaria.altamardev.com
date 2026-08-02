<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Arquitectura de Accesos" 
        icon="fa-shield-halved"
        :desc="'Definiendo capacidades para el perfil: ' . $nombre"
        :breadcrumb="[
            ['label' => 'Perfiles', 'url' => route('perfiles.index')],
            ['label' => 'Matriz de Accesos', 'url' => null]
        ]"
    />

    <div class="text-left">
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- Columna Izquierda: Identidad del Rol (4 Columnas) --}}
                <div class="lg:col-span-4 space-y-6">
                    <x-shared::common.component-card 
                        title="Identidad del Rol" 
                        desc="Información administrativa y nombre clave del perfil."
                        class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
                    >
                        <div class="space-y-5">
                            <div>
                                <x-shared::form.input-label for="nombre" :value="__('Nombre Clave')" required  />
                                <div class="mt-1.5">
                                    <x-shared::form.text-input 
                                        type="text" 
                                        wire:model="nombre" 
                                        id="nombre" 
                                        />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                            </div>
                            <div>
                                <x-shared::form.input-label for="descripcion" :value="__('Descripción Funcional')"  />
                                <div class="mt-1.5">
                                    <x-shared::form.text-input type="text" wire:model="descripcion" id="descripcion" class="w-full " />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                            </div>
                        </div>
                        
                        <x-slot:footer>
                            <div class="flex items-center justify-between">
                                {{-- Enlace Cancelar (Variante danger) --}}
                                <x-shared::form.link 
                                    :href="route('perfiles.index')" 
                                    danger
                                >
                                    <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                                </x-shared::form.link>
                                
                                {{-- Botón Guardar Configuración (En tamaño md) --}}
                                <x-shared::form.button-form 
                                    size="md"
                                    type="submit" 
                                    wire:loading.attr="disabled"
                                >
                                    <i class="fa-solid fa-shield-check" wire:loading.remove></i>
                                    <i class="fa-solid fa-circle-notch animate-spin" wire:loading></i> 
                                    <span>Guardar Configuración</span>
                                </x-shared::form.button-form>
                            </div>
                        </x-slot:footer>
                    </x-shared::common.component-card>
                </div>

                {{-- Columna Derecha: Matriz de Permisos (8 Columnas) --}}
                <div class="lg:col-span-8">
                    <x-shared::common.component-card 
                        title="Matriz de Permisos" 
                        desc="Concede acciones específicas para cada módulo del sistema de manera atómica."
                        class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
                    >
                        @include('security::perfiles.partials.matriz-permisos')
                    </x-shared::common.component-card>
                </div>

            </div>
        </form>
    </div>
</div>