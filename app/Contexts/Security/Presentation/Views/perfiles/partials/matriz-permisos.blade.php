<div class="space-y-3">
    @foreach($permisosCatalogo as $permiso)
        <div 
            class="rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40 hover:border-indigo-500/50 dark:hover:border-indigo-500/50 transition-all duration-200 shadow-xs" 
            wire:key="matriz-permiso-{{ $permiso['id'] }}"
        >
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4">
                
                {{-- Identificación del Módulo --}}
                <div class="flex items-center gap-3.5">
                    <div class="h-9 w-9 shrink-0 rounded-lg bg-white dark:bg-gray-950 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-gray-200 dark:border-gray-800 shadow-xs">
                        <i class="fa-solid fa-cube text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold uppercase text-xs text-gray-900 dark:text-white tracking-wide">
                            {{ $permiso['nombre'] }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium italic mt-0.5">
                            {{ $permiso['descripcion'] ?: 'Sin descripción' }}
                        </p>
                    </div>
                </div>

                {{-- Checkboxes de Permisos (CRUD) --}}
                <div class="flex flex-wrap items-center gap-2">
                    @foreach([
                        'is_read'   => ['Leer', 'text-emerald-600 dark:text-emerald-400', 'hover:border-emerald-500/50 dark:hover:border-emerald-500/30', 'focus:ring-emerald-500/10'], 
                        'is_create' => ['Crear', 'text-blue-600 dark:text-blue-400', 'hover:border-blue-500/50 dark:hover:border-blue-500/30', 'focus:ring-blue-500/10'], 
                        'is_update' => ['Editar', 'text-amber-600 dark:text-amber-400', 'hover:border-amber-500/50 dark:hover:border-amber-500/30', 'focus:ring-amber-500/10'], 
                        'is_delete' => ['Eliminar', 'text-red-600 dark:text-red-400', 'hover:border-red-500/50 dark:hover:border-red-500/30', 'focus:ring-red-500/10']
                    ] as $key => $estilo)
                        <label class="flex items-center px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 cursor-pointer {{ $estilo[2] }} transition-all group shadow-xs select-none">
                            <input 
                                type="checkbox" 
                                wire:model="matriz.{{ $permiso['id'] }}.{{ $key }}" 
                                class="h-4 w-4 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-4 dark:bg-gray-900 transition-all {{ $estilo[3] }}"
                            >
                            <span class="ml-2 text-xs font-semibold text-gray-600 dark:text-gray-400 group-hover:{{ $estilo[1] }} transition-colors">
                                {{ $estilo[0] }}
                            </span>
                        </label>
                    @endforeach
                </div>

            </div>
        </div>
    @endforeach
</div>