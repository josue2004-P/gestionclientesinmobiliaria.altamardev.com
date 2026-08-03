<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Registrar Nuevo Cliente" 
        icon="fa-user-plus"
        desc="Crea un expediente comercial completo para el seguimiento de compras y validaciones financieras."
        :breadcrumb="[
            ['label' => 'Clientes', 'url' => route('clientes.index')],
            ['label' => 'Nuevo Cliente', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit.prevent="store">
            <x-shared::common.component-card 
                title="Información y Perfil del Comprador" 
                desc="Los datos ingresados se utilizarán de manera reactiva para las precalificaciones automáticas y expedientes transaccionales." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="space-y-8">
                    
                    @include('clientes::partials.seccion-personales', ['clienteId' => null])

                    @include('clientes::partials.seccion-telefonos', ['clienteId' => null])

                    @include('clientes::partials.seccion-referencias', ['clienteId' => null])

                    @include('clientes::partials.seccion-documentos', ['clienteId' => null])

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
                            variant="primary"
                            wire:loading.attr="disabled"
                            wire:target="store"
                            startIcon='<i class="fa-solid fa-floppy-disk" wire:loading.remove wire:target="store"></i>'
                        >
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading wire:target="store"></i>
                            <span>Guardar Cliente</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>