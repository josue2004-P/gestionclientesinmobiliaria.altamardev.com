<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100">
    <x-shared::common.header title="Modificar Tipo de Vivienda" icon="fa-house-chimney" desc="Actualice los detalles estructurales del modelo." :breadcrumb="[['label' => 'Tipos de Vivienda', 'url' => route('tipos-vivienda.index')], ['label' => 'Modificar', 'url' => null]]" />
    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card title="Actualizar Datos" desc="Afectará a las propiedades asignadas bajo este modelo." class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
                <div class="grid grid-cols-1 gap-6">
                     {{-- Nombre del Tipo de Vivienda --}}
                    <div>
                        <x-shared::form.input-label for="nombre" :value="__('Nombre')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                id="nombre" 
                                type="text" 
                                wire:model="nombre" 
                                placeholder="Ej. Casa Habitación, Departamento, Terreno" 
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <x-shared::form.input-label for="descripcion" :value="__('Descripción')" />
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                id="descripcion" 
                                type="text" 
                                wire:model="descripcion" 
                                placeholder="Breve descripción de las características o uso..." 
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                </div>
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        {{-- Botón Cancelar (Enlace con variante Danger) --}}
                        <x-shared::form.link 
                            :href="route('tipos-vivienda.index')" 
                            danger
                        >
                            <i class="fa-solid fa-xmark"></i>
                            <span>Cancelar</span>
                        </x-shared::form.link>
                        
                        {{-- Botón Actualizar (Primary con Spinner de Carga) --}}
                        <x-shared::form.button-form 
                            size="md"
                            type="submit" 
                            wire:loading.attr="disabled"
                        >
                            <i class="fa-solid fa-circle-check" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin" wire:loading></i> 
                            <span>Actualizar</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>