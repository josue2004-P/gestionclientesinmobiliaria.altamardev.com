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

        <div class="overflow-x-auto bg-transparent rounded-none border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Usuario / Personal</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Correo Electrónico</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Roles Asignados</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estado</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($usuarios as $user)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="usuario-{{ $user->id }}">
                            
                            {{-- Usuario / Personal --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    {{-- Foto o Avatar con Iniciales --}}
                                    @if($user->foto)
                                        <img class="h-10 w-10 shrink-0 rounded-lg object-cover mr-3.5 border border-gray-200 dark:border-gray-700/60 shadow-xs" src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}">
                                    @else
                                        <div class="h-10 w-10 shrink-0 rounded-lg bg-gray-100/80 dark:bg-gray-800/60 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-xs mr-3.5 border border-gray-200 dark:border-gray-700/60 group-hover:bg-indigo-600 dark:group-hover:bg-indigo-500 group-hover:text-white dark:group-hover:text-white group-hover:border-transparent transition-all duration-200 shadow-xs">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr($user->apellido_paterno ?? '', 0, 1)) }}
                                        </div>
                                    @endif

                                    {{-- Nombres y Cuenta --}}
                                    <div>
                                        <div class="text-sm font-bold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ trim("{$user->name} {$user->apellido_paterno} {$user->apellido_materno}") }}
                                        </div>
                                        <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 mt-0.5 transition-colors flex items-center gap-1">
                                            <span class="text-indigo-500 font-mono">@</span>{{ $user->usuario }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Correo Electrónico --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm font-medium text-gray-600 dark:text-gray-300 transition-colors">
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
                                            <i class="fa-solid fa-user-shield opacity-40 text-xs"></i> Sin perfiles
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- Estado (Activo / Suspendido) --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($user->is_activo)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-100 dark:border-red-500/20 shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                        Inactivo
                                    </span>
                                @endif
                            </td>

                            {{-- Acciones (Dropdown Component) --}}
                            <x-shared::form.dropdown-actions title="Administración">
                                <x-shared::form.dropdown-item 
                                    :href="route('usuarios.edit', $user->id)" 
                                    icon="fa-solid fa-user-pen"
                                >
                                    Modificar Perfil
                                </x-shared::form.dropdown-item>

                                <div class="my-1 border-t border-gray-100 dark:border-gray-800"></div>

                                <x-shared::form.dropdown-item 
                                    wire:click="confirmDelete({{ $user->id }})" 
                                    icon="fa-solid fa-user-slash" 
                                    variant="danger"
                                >
                                    Dar de Baja
                                </x-shared::form.dropdown-item>
                            </x-shared::form.dropdown-actions>

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
                                        No hay usuarios registrados o que coincidan con la búsqueda actual.
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