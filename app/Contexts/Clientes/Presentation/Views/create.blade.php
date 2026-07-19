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
                    
                    @include('clientes::partials.seccion-personales')
                    @include('clientes::partials.seccion-financiera')
                    @include('clientes::partials.seccion-ubicacion')

                </div>

                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('clientes.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-550 transition-colors">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        <x-shared::form.button-primary type="submit" class="shadow-lg px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-floppy-disk mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Guardar Cliente</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>