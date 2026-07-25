<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Nuevo Perfil de Acceso" 
        icon="fa-shield-halved"
        desc="Establece las bases para la jerarquía de permisos del sistema."
        :breadcrumb="[
            ['label' => 'Perfiles', 'url' => route('perfiles.index')],
            ['label' => 'Nuevo Perfil', 'url' => null]
        ]"
    />

    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Arquitectura del Rol" 
                desc="El nombre debe ser único y descriptivo para facilitar la administración." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Nombre Clave --}}
                    <div class="col-span-1">
                        <x-shared::form.input-label for="nombre" :value="__('Nombre Clave')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5 relative group">
                            <x-shared::form.text-input 
                                id="nombre" 
                                type="text" 
                                wire:model="nombre" 
                                placeholder="ej: administrador, tecnico_lab" 
                                class="lowercase w-full  font-medium text-indigo-600 "
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                    
                    {{-- Descripción Funcional --}}
                    <div class="col-span-1">
                        <x-shared::form.input-label for="descripcion" :value="__('Descripción Funcional')" class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                id="descripcion" 
                                type="text" 
                                wire:model="descripcion" 
                                placeholder="Ej. Acceso total a reportes" 
                                class="w-full font-medium  text-gray-900 "
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                </div>
                
                {{-- Footer con alineación y contraste perfecto --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('perfiles.index') }}" class="inline-flex items-center text-sm font-semibold  text-gray-500 hover:text-red-550 dark:text-gray-400 dark:hover:text-red-400 transition-colors duration-150">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        
                        <x-shared::ui.button 
                            type="submit" 
                            size="sm"
                            wire:loading.attr="disabled">
                            <i class="fa-solid fa-shield-check mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Registrar Perfil</span>
                        </x-shared::ui.button>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>