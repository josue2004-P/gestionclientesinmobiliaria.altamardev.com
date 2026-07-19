<div class="md:col-span-3 pt-8 mt-6 border-t border-dashed border-gray-200 dark:border-gray-800" wire:key="cliente-referencias-modulo-{{ $clienteId }}">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        <div>
            <div class="flex items-center gap-2">
                <span class="p-1.5 bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 text-xs font-bold">
                    <i class="fa-solid fa-users-rectangle"></i>
                </span>
                <span class="text-xs font-black uppercase tracking-wider text-gray-900 dark:text-white">Contactos y Referencias de Aval</span>
            </div>
            <p class="text-[11px] text-gray-400 dark:text-gray-550 font-medium mt-1">Especifique el directorio de relaciones familiares o comerciales requeridos para el análisis de riesgo.</p>
        </div>
        
        <button type="button" wire:click="addReferencia" class="inline-flex items-center justify-center px-4 h-9 text-xs font-bold uppercase border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 hover:bg-gray-50 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-300 rounded-none transition-colors shadow-2xs shrink-0">
            <i class="fa-solid fa-plus mr-2 text-indigo-600 dark:text-indigo-400"></i> Añadir Referencia
        </button>
    </div>

    <div class="space-y-4">
        @foreach($referencias as $index => $item)
            <div class="border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-all duration-150 relative rounded-none shadow-2xs" 
                wire:key="referencia-row-{{ $index }}-{{ $item['id'] ?? 'new' }}">
                
                <input type="hidden" wire:model="referencias.{{ $index }}.id">

                <div class="p-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    <div class="hidden md:flex md:col-span-1 items-center justify-center font-mono text-xs font-bold text-gray-300 dark:text-gray-700">
                        #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="md:col-span-4">
                        <label class="block text-[10px] font-black text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1.5">Nombre Completo</label>
                        <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.nombre" placeholder="Nombre de la referencia" class="w-full text-xs font-bold rounded-none" />
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.nombre')" class="mt-1" />
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-black text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1.5">Teléfono Celular</label>
                        <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.celular" placeholder="10 dígitos" class="w-full text-xs font-mono font-bold tracking-wide rounded-none" />
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.celular')" class="mt-1" />
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-black text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1.5">Vínculo / Relación</label>
                        <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.parentesco" placeholder="Ej: Familiar, Comercial" class="w-full text-xs font-medium rounded-none" />
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.parentesco')" class="mt-1" />
                    </div>

                    <div class="md:col-span-1 flex justify-end pt-3 md:pt-5">
                        <button type="button" wire:click="removeReferencia({{ $index }})" class="h-9 w-9 border border-gray-200 hover:border-red-200 dark:border-gray-800 dark:hover:border-red-950/40 bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-600 dark:bg-gray-900 dark:hover:bg-red-950/20 dark:text-gray-550 dark:hover:text-red-400 transition-colors flex items-center justify-center rounded-none shadow-3xs" title="Remover Referencia">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </div>
                </div>

                <div class="px-4 pb-4 pt-3 border-t border-dashed border-gray-150 dark:border-gray-900 bg-gray-50/50 dark:bg-gray-900/20 grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-1 hidden md:flex items-center justify-center text-gray-300 dark:text-gray-700">
                        <i class="fa-solid fa-map-location-dot text-xs"></i>
                    </div>

                    <div class="md:col-span-7">
                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Calle y Número de Contacto</label>
                        <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.calle_numero" placeholder="Dirección completa del contacto (Calle, Num Ext, Num Int)" class="w-full text-xs bg-white dark:bg-gray-950 rounded-none" />
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.calle_numero')" class="mt-1" />
                    </div>

                    <div class="md:col-span-4">
                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Ubicación / Asentamiento</label>
                        <x-shared::form.searchable-select wire:model="referencias.{{ $index }}.asentamiento_id" placeholder="-- BUSCAR ZONA --">
                            <option value="">-- Sin asignar --</option>
                            
                            @foreach($this->asentamientos as $asentamiento)
                                <option value="{{ $asentamiento->getId() }}">
                                    {{ $asentamiento->getNombreAsentamiento() }} (C.P. {{ $asentamiento->getCodigoPostal() }})
                                </option>
                            @endforeach
                            
                        </x-shared::form.searchable-select>
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.asentamiento_id')" class="mt-1" />
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($referencias) === 0)
            <div class="p-8 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/20 dark:bg-gray-950/10 text-xs font-medium text-gray-400 dark:text-gray-550" wire:key="referencias-vacio-{{ $clienteId }}">
                <i class="fa-solid fa-users-slash text-xl block mb-2 text-gray-300 dark:text-gray-700"></i> 
                El expediente no contiene referencias asignadas. Registre al menos un contacto.
            </div>
        @endif
    </div>

    <x-shared::form.input-error :messages="$errors->get('referencias')" class="mt-2" />
</div>