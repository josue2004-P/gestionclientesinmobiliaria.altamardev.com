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
                            <td class="px-6 py-4 whitespace-nowrap ">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-md bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 dark:text-gray-500 mr-4 border border-gray-200 dark:border-gray-800 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-500 group-hover:border-transparent transition-all duration-300 shadow-xs">
                                        <i class="fa-solid fa-code text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400 tracking-tight transition-colors">
                                            {{ $permiso['nombre'] }}
                                        </div>
                                        <div class="text-[12px] font-bold text-gray-400 dark:text-gray-500  mt-0.5 transition-colors">
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
                            <td class="px-6 py-4 text-center whitespace-nowrap z-30 ">
                                <div x-data="{ 
                                    dropdownOpen: false, 
                                    position: { top: 0, left: 0 },
                                    toggle(e) {
                                        this.dropdownOpen = !this.dropdownOpen;
                                        if (this.dropdownOpen) {
                                            let rect = e.currentTarget.getBoundingClientRect();
                                            this.position.top = rect.bottom + window.scrollY + 8;
                                            this.position.left = rect.right - 208 + window.scrollX;
                                        }
                                    }
                                }" 
                                class="inline-block text-left">
                                    
                                    <button 
                                        @click="toggle($event)" 
                                        class="p-2.5 rounded-md text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all border border-transparent hover:border-indigo-100 dark:hover:border-indigo-500/20 shadow-xs"
                                    >
                                        <i class="fa-solid fa-ellipsis-vertical text-base"></i>
                                    </button>

                                    <template x-teleport="body">
                                        <div 
                                            x-show="dropdownOpen" 
                                            @click.away="dropdownOpen = false"
                                            x-cloak
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            :style="`position: absolute; top: ${position.top}px; left: ${position.left}px;`"
                                            class="z-[200] w-52 rounded-md border border-gray-200 bg-white/95 dark:border-gray-800 dark:bg-gray-955 shadow-xl dark:shadow-2xl p-1.5 backdrop-blur-md"
                                        >
                                            <div class="px-3 py-2 text-[12px] font-bold text-gray-400 dark:text-gray-500   border-b border-gray-100 dark:border-gray-855 mb-1.5 text-left transition-colors">
                                                Configuración 
                                            </div>
                                            <div class="space-y-0.5 text-left">
                                                <a href="{{ route('permisos.edit', $permiso['id']) }}" class="flex items-center px-3 py-2.5 text-sm font-semibold   text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-md transition-colors group/item">
                                                    <i class="fa-solid fa-key-skeleton mr-3 text-sm text-gray-400 dark:text-gray-500 group-hover/item:text-indigo-500 dark:group-hover/item:text-indigo-400 transition-colors"></i>Editar Llave
                                                </a>
                                                
                                                <div class="my-1 border-t border-gray-100 dark:border-gray-855"></div>
                                                
                                                <button 
                                                    wire:click="confirmDelete({{ $permiso['id'] }})" 
                                                    class="flex w-full items-center px-3 py-2.5 text-sm font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-md transition-colors group/del"
                                                >
                                                    <i class="fa-solid fa-trash-can mr-3 text-sm text-red-400 dark:text-red-500 transition-colors"></i>Eliminar Registro
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
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