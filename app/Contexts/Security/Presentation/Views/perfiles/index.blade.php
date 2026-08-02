<div>

    <x-shared::common.header 
        title="Catálogo de Perfiles" 
        icon="fa-users-gear"
        desc="Catálogo de perfiles y roles asignados a los usuarios"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Catálogo de Perfiles', 'url' => null]
        ]"
    />

    <x-shared::form.table-filters 
        title="Jerarquía de Accesos"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('perfiles.create')"
    >
        <x-slot:filters>
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border-t  border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Perfil del Sistema</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Alcance / Descripción</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Usuarios</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($perfiles as $perfil)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="perfil-{{ $perfil->id }}">
                            
                            {{-- Perfil del Sistema --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    {{-- Contenedor del Ícono --}}
                                    <div class="h-10 w-10 shrink-0 rounded-lg bg-gray-100/80 dark:bg-gray-800/60 flex items-center justify-center text-gray-500 dark:text-gray-400 mr-3.5 border border-gray-200 dark:border-gray-700/60 group-hover:bg-indigo-600 dark:group-hover:bg-indigo-500 group-hover:text-white dark:group-hover:text-white group-hover:border-transparent transition-all duration-200 shadow-xs">
                                        <i class="fa-solid fa-shield-halved text-xs"></i>
                                    </div>

                                    {{-- Textos --}}
                                    <div>
                                        <div class="text-sm font-bold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $perfil->nombre }}
                                        </div>
                                        <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 mt-0.5 transition-colors">
                                            Rol de Seguridad
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Alcance / Descripción --}}
                            <td class="px-6 py-4 border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="text-sm text-gray-600 dark:text-gray-400 max-w-xs truncate font-medium transition-colors">
                                    {{ $perfil->descripcion ?: 'Sin descripción funcional definida' }}
                                </div>
                            </td>
                            
                            {{-- Usuarios --}}
                            <td class="px-6 py-4 text-center border-l border-r border-gray-150 dark:border-gray-850">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-50 text-gray-600 dark:bg-gray-900 dark:text-gray-400 transition-colors">
                                    <i class="fa-solid fa-users text-[10px] mr-1.5 text-gray-400 dark:text-gray-500"></i>
                                    {{ $perfil->usuarios_count ?? 0 }}
                                </span>
                            </td>
                            
                            {{-- Acciones (Dropdown con Teleport para Perfiles) --}}
                            <x-shared::form.dropdown-actions title="Infraestructura">
                                
                                {{-- Opción Configurar Matriz (Enlace) --}}
                                <x-shared::form.dropdown-item 
                                    :href="route('perfiles.edit', $perfil->id)" 
                                    icon="fa-solid fa-gears"
                                >
                                    Configurar Matriz
                                </x-shared::form.dropdown-item>

                                <div class="my-1 border-t border-gray-100 dark:border-gray-800"></div>

                                {{-- Opción Eliminar Perfil (Acción Livewire) --}}
                                <x-shared::form.dropdown-item 
                                    wire:click="confirmDelete({{ $perfil->id }})" 
                                    icon="fa-solid fa-trash-can" 
                                    variant="danger"
                                >
                                    Eliminar Perfil
                                </x-shared::form.dropdown-item>

                            </x-shared::form.dropdown-actions>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 transition-colors shadow-xs">
                                        <i class="fa-solid fa-shield-slash text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight transition-colors">Sin Perfiles de Acceso</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs mx-auto mt-1 transition-colors">
                                        No hay roles registrados o que coincidan con los criterios de búsqueda actuales.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if($perfiles->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $perfiles->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>