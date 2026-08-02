<div class="flex flex-col items-center justify-center p-4 rounded-2xl border border-dashed border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200 shadow-xs">
    <span class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-3 tracking-wide transition-colors">
        Foto de Perfil
    </span>
    
    <div class="relative group">
        @if ($foto || $existingFoto)
            <div class="flex flex-col items-center gap-3">
                <img src="{{ $foto ? $foto->temporaryUrl() : route('security.usuarios.asset', ['directory' => 'fotos', 'filename' => basename($existingFoto)]) }}" 
                     class="h-20 w-20 rounded-2xl object-cover border border-gray-200 dark:border-gray-800 shadow-sm" />
                
                <button type="button" wire:click="removeFoto" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-900/30 text-[10px] font-bold uppercase tracking-wider hover:bg-red-600 hover:text-white dark:hover:bg-red-600 transition-all duration-150">
                    <i class="fa-solid fa-trash-can text-[9px]"></i>
                    Quitar Foto
                </button>
            </div>
        @else
            <div class="h-20 w-20 rounded-2xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 dark:text-gray-500 border border-gray-200 dark:border-gray-800 transition-colors">
                <i class="fa-solid fa-camera text-xl opacity-80"></i>
            </div>
            <label class="absolute inset-0 rounded-2xl bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-[10px] cursor-pointer transition-opacity duration-150">
                <input type="file" wire:model.live="foto" class="hidden" accept="image/*" />
                <span class="font-bold">Subir</span>
            </label>
        @endif
    </div>

    <div wire:loading wire:target="foto" class="mt-2 text-[9px] text-indigo-600 dark:text-indigo-400 animate-pulse font-extrabold tracking-wider uppercase">
        Procesando...
    </div>

    <x-shared::form.input-error :messages="$errors->get('foto')" class="mt-2 text-center" />
</div>