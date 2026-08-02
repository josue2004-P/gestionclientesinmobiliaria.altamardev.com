<div class="flex flex-col items-center justify-center p-4 rounded-2xl border border-dashed border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200 shadow-xs">
    <span class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-3 tracking-wide transition-colors">
        Firma Digital
    </span>
    
    <div class="relative group">
        @if ($firma || $existingFirma)
            <div class="flex flex-col items-center gap-3">
                <img src="{{ $firma ? $firma->temporaryUrl() : route('security.usuarios.asset', ['directory' => 'firmas', 'filename' => basename($existingFirma)]) }}" 
                     class="h-16 w-36 rounded-xl object-contain bg-white border border-gray-200 dark:border-gray-800 shadow-sm p-1.5" />
                
                <button type="button" wire:click="removeFirma" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-900/30 text-[10px] font-bold uppercase tracking-wider hover:bg-red-600 hover:text-white dark:hover:bg-red-600 transition-all duration-150">
                    <i class="fa-solid fa-trash-can text-[9px]"></i>
                    Quitar Firma
                </button>
            </div>
        @else
            <div class="h-16 w-36 rounded-xl bg-gray-50 dark:bg-gray-900 flex items-center justify-center text-gray-400 dark:text-gray-500 border border-gray-200 dark:border-gray-800 transition-colors duration-200">
                <i class="fa-solid fa-signature text-xl opacity-85"></i>
            </div>
            <label class="absolute inset-0 rounded-xl bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-[10px] cursor-pointer transition-opacity duration-150">
                <input type="file" wire:model.live="firma" class="hidden" accept="image/*" />
                <span class="font-bold tracking-wide">Subir</span>
            </label>
        @endif
    </div>

    <div wire:loading wire:target="firma" class="mt-2 text-[9px] text-indigo-600 dark:text-indigo-400 animate-pulse font-extrabold tracking-wider uppercase">
        Procesando...
    </div>

    <x-shared::form.input-error :messages="$errors->get('firma')" class="mt-2 text-center" />
</div>