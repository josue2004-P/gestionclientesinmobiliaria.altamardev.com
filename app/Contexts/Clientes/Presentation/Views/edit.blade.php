<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Modificar Expediente de Cliente" 
        icon="fa-user-pen"
        desc="Edita los datos generales, capacidad de compra o información de localización del comprador."
        :breadcrumb="[
            ['label' => 'Clientes', 'url' => route('clientes.index')],
            ['label' => 'Editar Cliente', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit.prevent="save">
            <x-shared::common.component-card 
                title="Actualizar Datos del Comprador" 
                desc="Edite los campos necesarios. Los cambios se verán reflejados inmediatamente en las bitácoras comerciales." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="space-y-8">
                    
                    @include('clientes::partials.seccion-personales', ['clienteId' => $clienteId])

                    @include('clientes::partials.seccion-telefonos')

                    @include('clientes::partials.seccion-referencias')

                    @include('clientes::partials.seccion-documentos')

                    @include('clientes::partials.seccion-financiera')

                    @include('clientes::partials.seccion-ubicacion')

                </div>

                <x-slot:footer>
                    <div class="flex items-center justify-between w-full">
                        {{-- Botón Cancelar --}}
                        <x-shared::form.link 
                            :href="route('clientes.index')" 
                            danger
                        >
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </x-shared::form.link>

                         <x-shared::form.button-form 
                            type="submit" 
                            wire:loading.attr="disabled"
                            startIcon='<i class="fa-solid fa-floppy-disk" wire:loading.remove></i>'
                        >
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i>
                            <span>Actualizar Cliente</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>