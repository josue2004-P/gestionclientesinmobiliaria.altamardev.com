<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Nueva Llave de Acceso" 
        icon="fa-key"
        desc="Define las constantes de seguridad para los módulos del sistema."
        :breadcrumb="[
            ['label' => 'Permisos', 'url' => route('permisos.index')],
            ['label' => 'Nuevo Permiso', 'url' => null]
        ]"
    />

    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Definición de Permiso" 
                desc="Estas llaves son utilizadas por el Middleware para restringir accesos." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Identificador (Clave) --}}
                    <div class="col-span-1">
                        <x-shared::form.input-label for="nombre" :value="__('Identificador (Clave)')" required />
                        <div class="mt-1.5 relative group">
                            <x-shared::form.text-input 
                                id="nombre" 
                                type="text" 
                                wire:model="nombre" 
                                placeholder="ej: reportes.ver, usuarios.crear" 
                                class="lowercase "
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                    
                    {{-- Descripción del Alcance --}}
                    <div class="col-span-1">
                        <x-shared::form.input-label for="descripcion" :value="__('Descripción del Alcance')" />
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                id="descripcion" 
                                type="text" 
                                wire:model="descripcion" 
                                placeholder="Ej. Permite ver el reporte financiero" 
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    {{-- Nota de Seguridad --}}
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-start gap-4 p-5 rounded-2xl bg-amber-50 dark:bg-amber-900/10 border border-amber-100 dark:border-amber-900/20 transition-colors duration-200">
                            <div class="mt-0.5 flex-shrink-0 h-8 w-8 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-500">
                                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-black text-amber-900 dark:text-amber-400 uppercase tracking-widest">Nota de Seguridad</h4>
                                <p class="mt-1 text-xs text-amber-700 dark:text-amber-500/80 leading-relaxed font-medium italic">
                                    Una vez creado el permiso, este aparecerá automáticamente en la <span class="font-bold">Matriz de Perfiles</span>. Evite renombrar permisos existentes, ya que esto podría invalidar los accesos de los usuarios actuales.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Footer con alineación y contraste perfecto --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <x-shared::form.link 
                            :href="route('permisos.index')" 
                            danger
                        >
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </x-shared::form.link>
                        
                        <x-shared::form.button-form 
                            size="md"
                            type="submit" 
                            wire:loading.attr="disabled"
                        >
                            <i class="fa-solid fa-key-skeleton" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin" wire:loading></i> 
                            <span>Crear Llave de Acceso</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>