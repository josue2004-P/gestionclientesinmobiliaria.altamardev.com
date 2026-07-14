<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100">
    <x-shared::common.header title="Nueva Amenidad" icon="fa-swimming-pool" desc="Agrega una característica o servicio adicional para las viviendas." :breadcrumb="[['label' => 'Amenidades', 'url' => route('amenidades.index')], ['label' => 'Nueva', 'url' => null]]" />
    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card title="Detalles de la Amenidad" desc="Escriba el nombre del servicio o característica." class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-shared::form.input-label for="nombre" :value="__('Nombre')" required />
                        <div class="mt-1.5"><x-shared::form.text-input id="nombre" type="text" wire:model="nombre" placeholder="ej: Alberca, Gimnasio, Seguridad 24/7" class="w-full font-bold" /></div>
                        <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                </div>
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('amenidades.index') }}" class="text-xs font-bold uppercase text-gray-500 hover:text-red-550"><i class="fa-solid fa-xmark mr-2"></i>Cancelar</a>
                        <x-shared::form.button-primary type="submit" class="px-5 h-11 text-xs"><i class="fa-solid fa-floppy-disk mr-2"></i>Registrar</x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>