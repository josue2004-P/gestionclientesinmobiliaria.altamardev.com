{{-- Bloque de Estado con Contraste Premium Adaptado --}}
<div class="p-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40 transition-all duration-200 shadow-xs">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        
        {{-- Icono y Texto --}}
        <div class="flex items-center gap-3.5">
            <div class="h-9 w-9 shrink-0 rounded-lg bg-white dark:bg-gray-950 shadow-xs flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-gray-200 dark:border-gray-800 transition-colors">
                <i class="fa-solid fa-user-shield text-sm"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-900 dark:text-white transition-colors">
                    Estado de la Cuenta
                </h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 transition-colors">
                    ¿Habilitar el acceso inmediato al sistema tras el registro?
                </p>
            </div>
        </div>

        {{-- Switch de Activo/Inactivo --}}
        <label class="relative inline-flex items-center cursor-pointer select-none">
            <input type="checkbox" wire:model.live="is_activo" class="sr-only peer">
            
            <div class="w-11 h-6 bg-gray-200 dark:bg-gray-800 rounded-full border border-transparent dark:border-gray-700 peer peer-checked:bg-indigo-600 dark:peer-checked:bg-indigo-500 transition-all duration-200
                after:content-[''] after:absolute after:top-[3px] after:left-[3px] after:bg-white after:border-gray-300 dark:after:border-transparent after:border after:rounded-full after:h-4.5 after:w-4.5 after:transition-all peer-checked:after:translate-x-5 shadow-xs">
            </div>
            
            <span class="ml-3 text-[10px] font-extrabold uppercase tracking-widest transition-colors min-w-[70px] {{ $is_activo ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-400 dark:text-gray-500' }}">
                {{ $is_activo ? 'Habilitada' : 'Deshabilitada' }}
            </span>
        </label>
    </div>
</div>