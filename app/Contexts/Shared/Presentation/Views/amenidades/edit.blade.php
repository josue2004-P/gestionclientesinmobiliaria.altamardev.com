<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100">
    <x-shared::common.header title="Modificar Amenidad" icon="fa-swimming-pool" desc="Actualice los datos generales del catálogo." :breadcrumb="[['label' => 'Amenidades', 'url' => route('amenidades.index')], ['label' => 'Modificar', 'url' => null]]" />
    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card title="Actualizar Amenidad" desc="Los cambios se verán reflejados en todas las viviendas vinculadas." class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-shared::form.input-label for="nombre" :value="__('Nombre')" required />
                        <div class="mt-1.5"><x-shared::form.text-input id="nombre" type="text" wire:model="nombre" /></div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                </div>
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        {{-- Enlace Cancelar con variante Danger --}}
                        <x-shared::form.link 
                            :href="route('amenidades.index')" 
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