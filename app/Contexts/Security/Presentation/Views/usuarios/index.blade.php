<div>
    <x-shared::common.header 
        title="Catálogo de Usuarios" 
        icon="fa-users"
        desc="Catálogo de usuarios registrados y administración de sus accesos"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Catálogo de Usuarios', 'url' => null]
        ]"
    />
    <x-shared::form.table-filters 
        title="Control de Usuarios"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('usuarios.create')"
    >
        <x-slot:filters>
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Personal</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Credencial Digital</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Roles Asignados</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estado</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($usuarios as $user)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-20 dark:divide-gray-800" wire:key="usuario-{{ $user->id }}">
                            
                            <td class="px-6 py-4 whitespace-nowrap ">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-md bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 dark:text-gray-500 mr-4 border border-gray-200 dark:border-gray-800 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-500 group-hover:border-transparent transition-all duration-300 shadow-xs">
                                        <i class="fa-solid fa-user-gear text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-900 dark:text-whitetransition-colors group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-[12px] font-semibold text-gray-400 dark:text-gray-500  mt-0.5 transition-colors">
                                            Operador de Plataforma
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Credencial Digital --}}
                            <td class="px-6 py-4 whitespace-nowrap ">
                                <div class="flex items-center gap-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 transition-colors">
                                    <i class="fa-regular fa-envelope text-xs text-gray-400 dark:text-gray-500"></i>
                                    <span class="lowercase">{{ $user->email }}</span>
                                </div>
                            </td>

                            {{-- Roles Asignados --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5 max-w-xs">
                                    @forelse($user->perfiles as $perfil)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20 shadow-xs">
                                            {{ $perfil->nombre }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 dark:text-gray-500 italic flex items-center gap-1.5 font-medium transition-colors">
                                            <i class="fa-solid fa-user-shield opacity-40 text-[11px]"></i> Sin perfiles activos
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- Estado --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap ">
                                @if($user->is_activo)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-100 dark:border-red-500/20 shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                        Suspendido
                                    </span>
                                @endif
                            </td>

                            {{-- Acciones (Dropdown con Teleport) --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap z-30">
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
                                            class="z-[200] w-52 rounded-md border border-gray-200 bg-white/95 dark:border-gray-800 dark:bg-gray-950 shadow-xl dark:shadow-2xl p-1.5 backdrop-blur-md"
                                        >
                                            <div class="px-3 py-2 text-[12px] font-bold text-gray-400 dark:text-gray-500  border-b border-gray-100 dark:border-gray-850 mb-1.5 text-left transition-colors">
                                                Administración
                                            </div>
                                            <div class="space-y-0.5 text-left">
                                                <a href="{{ route('usuarios.edit', $user->id) }}" class="flex items-center px-3 py-2.5 text-sm font-semibold  text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-md transition-colors group/item">
                                                    <i class="fa-solid fa-user-pen mr-3 text-sm text-gray-400 dark:text-gray-500 group-hover/item:text-indigo-500 dark:group-hover/item:text-indigo-400 transition-colors"></i>Modificar Perfil
                                                </a>
                                                
                                                <div class="my-1 border-t border-gray-100 dark:border-gray-850"></div>
                                                
                                                <button 
                                                    wire:click="confirmDelete({{ $user->id }})" 
                                                    class="flex w-full items-center px-3 py-2.5 text-sm font-semibold  text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-md transition-colors group/del"
                                                >
                                                    <i class="fa-solid fa-user-slash mr-3 text-sm text-red-400 group-hover/del:text-red-500 transition-colors"></i>Dar de Baja
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 transition-colors shadow-xs">
                                        <i class="fa-solid fa-users-slash text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight transition-colors">Sin Usuarios</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs mx-auto mt-1 transition-colors">
                                        No hay operadores registrados o que coincidan con la búsqueda actual.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if($usuarios->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $usuarios->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>  