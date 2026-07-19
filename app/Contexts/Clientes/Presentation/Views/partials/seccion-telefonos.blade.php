<div class="md:col-span-3 pt-6 mt-4 border-t border-dashed border-gray-200 dark:border-gray-800" wire:key="cliente-telefonos-modulo-{{ $clienteId }}">
    <div class="flex items-center justify-between mb-4">
        <div>
            <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Directorio de Contacto (1:N)</span>
            <p class="text-xs text-gray-400 dark:text-gray-550 font-medium">Asigne los números telefónicos principales y alternos para el seguimiento comercial.</p>
        </div>
        <button type="button" wire:click="addTelefono" class="inline-flex items-center justify-center px-3 h-9 text-xs font-bold uppercase border border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 rounded-none transition-colors">
            <i class="fa-solid fa-plus mr-2 text-indigo-600"></i> Añadir Teléfono
        </button>
    </div>

    <div class="space-y-4">
        @foreach($telefonos as $index => $item)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/10 relative rounded-none" 
                wire:key="telefono-row-{{ $index }}-{{ $item['id'] ?? 'new' }}">
                
                <input type="hidden" wire:model="telefonos.{{ $index }}.id">

                <div class="md:col-span-6">
                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Número de Teléfono</label>
                    <x-shared::form.text-input 
                        type="text" 
                        wire:model="telefonos.{{ $index }}.telefono" 
                        placeholder="10 dígitos (ej: 3312345678)" 
                        class="w-full text-xs font-mono font-bold" 
                    />
                    <x-shared::form.input-error :messages="$errors->get('telefonos.' . $index . '.telefono')" class="mt-1" />
                </div>

                <div class="md:col-span-4">
                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Tipo de Línea</label>
                    <x-shared::form.input-select 
                        id="tipo_telefono_{{ $index }}" 
                        wire:model="telefonos.{{ $index }}.tipo_telefono"
                        :messages="$errors->get('telefonos.' . $index . '.tipo_telefono')"
                    >
                        <option value="Celular">📱 Celular</option>
                        <option value="Casa">🏠 Casa / Residencial</option>
                        <option value="Trabajo">💼 Oficina / Trabajo</option>
                    </x-shared::form.input-select>
                </div>

                <div class="md:col-span-2 flex items-end justify-center pb-0.5">
                    <button type="button" wire:click="removeTelefono({{ $index }})" class="h-11 w-full border border-red-200 dark:border-red-900/30 bg-red-50/50 hover:bg-red-100 text-red-650 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/50 transition-colors flex items-center justify-center rounded-none shadow-xs">
                        <i class="fa-solid fa-trash-can text-xs mr-2"></i> Eliminar
                    </button>
                </div>
            </div>
        @endforeach

        @if(count($telefonos) === 0)
            <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/10 text-xs font-medium text-gray-400 dark:text-gray-550" wire:key="telefonos-vacio-{{ $clienteId }}">
                <i class="fa-solid fa-phone-slash text-lg block mb-1 text-gray-300 dark:text-gray-700"></i> 
                El expediente comercial no contiene números telefónicos vinculados. Registre al menos uno.
            </div>
        @endif
    </div>
    
    <x-shared::form.input-error :messages="$errors->get('telefonos')" class="mt-2" />
</div>