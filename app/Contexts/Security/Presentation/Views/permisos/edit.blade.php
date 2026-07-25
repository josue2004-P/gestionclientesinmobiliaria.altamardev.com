<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Modificar Llave de Acceso" 
        icon="fa-key"
        desc="Asegúrate de que la clave editada coincida con las directivas @can o Middleware en tu código."
        :breadcrumb="[
            ['label' => 'Permisos', 'url' => route('permisos.index')],
            ['label' => 'Editar Permiso', 'url' => null]
        ]"
    />

    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Configuración de la Llave" 
                desc="Editing clave: {{ $nombre }}" 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Identificador (Slug) --}}
                    <div class="col-span-1">
                        <x-shared::form.input-label for="nombre" :value="__('Identificador (Slug)')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5 relative group">
                            <x-shared::form.text-input 
                                id="nombre" 
                                type="text" 
                                wire:model="nombre" 
                                placeholder="ej: ventas.editar" 
                                class="lowercase w-full font-semibold  text-indigo-600 dark:text-indigo-400"
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
                                placeholder="Describe qué acceso otorga esta llave" 
                                class="w-full font-medium bg-white dark:bg-gray-900 text-gray-900 "
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    {{-- Advertencia Crítica --}}
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20 transition-colors duration-200">
                            <div class="mt-0.5 flex-shrink-0 h-8 w-8 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-500">
                                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-red-900 dark:text-red-400 ">Atención Inmediata</h4>
                                <p class="mt-1 text-xs text-red-700 dark:text-red-400/80 leading-relaxed font-medium italic">
                                    Alterar el identificador del permiso puede inhabilitar funciones en vivo si el código fuente del servidor no se actualiza simultáneamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Footer alineado a la izquierda y derecha adecuadamente --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('permisos.index') }}" class="inline-flex items-center text-sm font-semibold  text-gray-500 hover:text-red-555 dark:text-gray-400 dark:hover:text-red-400 transition-colors duration-150">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Descartar
                        </a>
                        
                        <x-shared::ui.button 
                            size="sm"
                            type="submit" 
                            wire:loading.attr="disabled">
                            <i class="fa-solid fa-floppy-disk mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Guardar Cambios</span>
                        </x-shared::ui.button>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>