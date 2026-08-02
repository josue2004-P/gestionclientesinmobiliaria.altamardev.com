<x-shared::common.component-card 
    title="Perfiles de Seguridad" 
    desc="Define los módulos y acciones permitidas para este usuario en el ecosistema."
    class="border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
>
    <div class="max-h-[620px] overflow-y-auto custom-scrollbar pr-1 space-y-3 py-1">
        @foreach($perfilesCatalogo as $perfil)
            <label 
                class="relative flex items-center p-4 cursor-pointer rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/40 hover:border-indigo-500/50 dark:hover:border-indigo-500/50 transition-all group shadow-xs select-none" 
                wire:key="perfil-item-{{ $perfil->id }}"
            >
                <div class="flex items-center h-5">
                    <input 
                        type="checkbox" 
                        wire:model.live="selectedPerfiles" 
                        value="{{ $perfil->id }}" 
                        class="h-5 w-5 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-4 focus:ring-indigo-500/10 dark:bg-gray-950 transition-colors"
                    >
                </div>
                <div class="ml-4 pr-6">
                    <span class="block font-bold text-xs text-gray-800 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        {{ $perfil->nombre }}
                    </span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400 font-semibold transition-colors uppercase tracking-tight mt-0.5">
                        {{ $perfil->descripcion ?: 'Acceso estándar al módulo' }}
                    </span>
                </div>
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-40 transition-opacity">
                    <i class="fa-solid fa-shield-halved text-indigo-600 dark:text-indigo-400 text-xs"></i>
                </div>
            </label>
        @endforeach
    </div>
</x-shared::common.component-card>