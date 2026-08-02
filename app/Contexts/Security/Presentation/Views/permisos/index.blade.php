<div>
    <x-shared::common.header 
        title="Catálogo de Permisos" 
        icon="fa-shield-halved"
        desc="Catalogo de permisos que se asginan al perfil"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Catálogo de Permisos', 'url' => null]
        ]"
    />
    <x-shared::form.table-filters 
        title="Diccionario de Seguridad"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('permisos.create')"
    >
        <x-slot:filters>
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border-t  border-gray-200 dark:border-gray-800 transition-colors duration-200 ">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Identificador</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Alcance / Descripción</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($permisos as $permiso)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="permiso-{{ $permiso['id'] }}">
                            
                           {{-- Nombre / Clave estilo Código --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    {{-- Contenedor del Ícono --}}
                                    <div class="h-10 w-10 shrink-0 rounded-lg bg-gray-100/80 dark:bg-gray-800/60 flex items-center justify-center text-gray-500 dark:text-gray-400 mr-3.5 border border-gray-200 dark:border-gray-700/60 group-hover:bg-indigo-600 dark:group-hover:bg-indigo-500 group-hover:text-white dark:group-hover:text-white group-hover:border-transparent transition-all duration-200 shadow-xs">
                                        <i class="fa-solid fa-code text-xs"></i>
                                    </div>

                                    {{-- Textos --}}
                                    <div>
                                        <div class="text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400 tracking-tight transition-colors">
                                            {{ $permiso['nombre'] }}
                                        </div>
                                        <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 mt-0.5 transition-colors">
                                            Llave de Sistema
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Descripción --}}
                            <td class="px-6 py-4 ">
                                <div class="text-sm text-gray-600 dark:text-gray-400  font-medium transition-colors">
                                    {{ $permiso['descripcion'] ?: 'Sin descripción técnica' }}
                                </div>
                            </td>

                            {{-- Acciones (Dropdown con Teleport) --}}
                            <x-shared::form.dropdown-actions title="Configuración">
                                    
                                {{-- Enlace de Editar --}}
                                <x-shared::form.dropdown-item 
                                    :href="route('permisos.edit', $permiso['id'])" 
                                    icon="fa-solid fa-key-skeleton"
                                >
                                    Editar Llave
                                </x-shared::form.dropdown-item>

                                <div class="my-1 border-t border-gray-100 dark:border-gray-800"></div>

                                {{-- Botón de Eliminar --}}
                                <x-shared::form.dropdown-item 
                                    wire:click="confirmDelete({{ $permiso['id'] }})" 
                                    icon="fa-solid fa-trash-can" 
                                    variant="danger"
                                >
                                    Eliminar Registro
                                </x-shared::form.dropdown-item>

                            </x-shared::form.dropdown-actions>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 transition-colors shadow-xs">
                                        <i class="fa-solid fa-key text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight transition-colors">Diccionario Vacío</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs mx-auto mt-1 transition-colors">
                                        No hay llaves de seguridad registradas en el sistema.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if($permisos->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $permisos->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>