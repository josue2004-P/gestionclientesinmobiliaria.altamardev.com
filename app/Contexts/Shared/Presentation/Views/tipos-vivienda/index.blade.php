<div>
    <x-shared::common.header 
        title="Catálogo de Tipos de Viviendas" 
        icon="fa-house-chimney"
        desc="Catálogo y configuración de los tipos de viviendas, prototipos y desarrollos"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Tipos de Viviendas', 'url' => null]
        ]"
    />
    <x-shared::form.table-filters title="Tipos de Vivienda" :search="$search" :perPage="$perPage" :createRoute="route('tipos-vivienda.create')">
             <x-slot:filters>
            {{-- Espacio libre para filtros rápidos --}}
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Modelo / Estructura</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($viviendas as $vivienda)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="vivienda-{{ $vivienda->id }}">
                            <td class="px-6 py-2">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">{{ $vivienda->nombre }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5">{{ $vivienda->descripcion ?? 'Sin descripción' }}</div>
                            </td>
                            <x-shared::form.dropdown-actions title="Opciones">
                                
                                {{-- Opción Editar --}}
                                <x-shared::form.dropdown-item 
                                    :href="route('tipos-vivienda.edit', $vivienda->id)" 
                                    icon="fa-solid fa-pen-to-square"
                                >
                                    Editar Tipo de Vivienda
                                </x-shared::form.dropdown-item>

                                <div class="my-1 border-t border-gray-100 dark:border-gray-800"></div>

                                {{-- Opción Eliminar (Livewire) --}}
                                <x-shared::form.dropdown-item 
                                    wire:click="confirmDelete({{ $vivienda->id }})" 
                                    icon="fa-solid fa-trash-can" 
                                    variant="danger"
                                >
                                    Eliminar Tipo de Vivienda
                                </x-shared::form.dropdown-item>

                            </x-shared::form.dropdown-actions>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center"><h3 class="text-base font-extrabold text-gray-900 dark:text-white">Sin Registros</h3></div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($viviendas->hasPages()) <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800">{{ $viviendas->links() }}</div> @endif
    </x-shared::form.table-filters>
</div>