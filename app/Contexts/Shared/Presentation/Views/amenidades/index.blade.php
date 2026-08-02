<div>
    <x-shared::common.header 
        title="Catálogo de Amenidades" 
        icon="fa-swimming-pool"
        desc="Catálogo y administración de amenidades y servicios para los desarrollos"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Amenidades', 'url' => null]
        ]"
    />

    <x-shared::form.table-filters 
        title="Control de Amenidades" 
        :search="$search" 
        :perPage="$perPage" 
        :createRoute="route('amenidades.create')"
    >
        <x-slot:filters>
            {{-- Espacio libre para filtros rápidos --}}
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Amenidad / Instalación</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($amenidades as $amenidad)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="amenidad-{{ $amenidad->id }}">
                            <td class="px-6 py-2">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">{{ $amenidad->nombre }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5">{{ $amenidad->descripcion ?? 'Sin descripción' }}</div>
                            </td>
                            {{-- Acciones --}}
                            <x-shared::form.dropdown-actions title="Opciones">
                                
                                {{-- Opción Editar --}}
                                <x-shared::form.dropdown-item 
                                    :href="route('amenidades.edit', $amenidad->id)" 
                                    icon="fa-solid fa-pen-to-square"
                                >
                                    Modificar Amenidad
                                </x-shared::form.dropdown-item>

                                <div class="my-1 border-t border-gray-100 dark:border-gray-800"></div>

                                {{-- Opción Eliminar (Livewire) --}}
                                <x-shared::form.dropdown-item 
                                    wire:click="confirmDelete({{ $amenidad->id }})" 
                                    icon="fa-solid fa-trash-can" 
                                    variant="danger"
                                >
                                    Eliminar Amenidad
                                </x-shared::form.dropdown-item>

                            </x-shared::form.dropdown-actions>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 transition-colors shadow-xs">
                                        <i class="fa-solid fa-umbrella-beach text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight transition-colors">Sin Amenidades</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs mx-auto mt-1 transition-colors">
                                        No hay amenidades registradas o que coincidan con la búsqueda actual.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($amenidades->hasPages()) 
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800">
                {{ $amenidades->links() }}
            </div> 
        @endif
    </x-shared::form.table-filters>
</div>