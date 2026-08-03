<div wire:key="cliente-telefonos-modulo-{{ $clienteId }}">
    {{-- Encabezado estilizado igual a Información Personal --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
            <i class="fa-solid fa-phone mr-2"></i>Directorio de Contacto 
        </h3>

        <x-shared::form.button-form 
            type="button" 
            wire:click="addTelefono" 
            variant="secondary" 
            size="md"
        >
            <i class="fa-solid fa-plus text-indigo-600 dark:text-indigo-400"></i>
            <span>Añadir Teléfono</span>
        </x-shared::form.button-form>
    </div>

    {{-- Lista de Filas de Teléfonos --}}
    <div class="space-y-4">
        @foreach($telefonos as $index => $item)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 p-4 rounded-xl border border-gray-100 dark:border-gray-800/60 bg-gray-50/50 dark:bg-gray-900/40 relative" 
                wire:key="telefono-row-{{ $index }}-{{ $item['id'] ?? 'new' }}">
                
                <input type="hidden" wire:model="telefonos.{{ $index }}.id">

                {{-- Campo: Número de Teléfono --}}
                <div class="md:col-span-6">
                    <x-shared::form.input-label :for="'telefono_' . $index" :value="__('Número de Teléfono')" required />
                    <div class="mt-1.5">
                        <x-shared::form.text-input 
                            :id="'telefono_' . $index"
                            type="text" 
                            wire:model="telefonos.{{ $index }}.telefono" 
                            placeholder="10 dígitos (ej: 3312345678)" 
                        />
                    </div>
                    <x-shared::form.input-error :messages="$errors->get('telefonos.' . $index . '.telefono')" class="mt-2" />
                </div>

                {{-- Campo: Tipo de Línea --}}
                <div class="md:col-span-4">
                    <x-shared::form.input-label :for="'tipo_telefono_' . $index" :value="__('Tipo de Línea')" required />
                    <div class="mt-1.5">
                        <x-shared::form.input-select 
                            :id="'tipo_telefono_' . $index" 
                            wire:model="telefonos.{{ $index }}.tipo_telefono"
                            :messages="$errors->get('telefonos.' . $index . '.tipo_telefono')"
                        >
                            <option value="Celular" data-icon="fa-solid fa-mobile-screen-button">Celular</option>
                            <option value="Casa" data-icon="fa-solid fa-house">Casa / Residencial</option>
                            <option value="Trabajo" data-icon="fa-solid fa-briefcase">Oficina / Trabajo</option>
                        </x-shared::form.input-select>
                    </div>
                    <x-shared::form.input-error :messages="$errors->get('telefonos.' . $index . '.tipo_telefono')" class="mt-2" />
                </div>

                {{-- Acciones: Botón de Eliminar Danger --}}
                <div class="md:col-span-2 flex flex-col justify-end">
                    <div class="mt-1.5">
                        <x-shared::form.button-form 
                            type="button" 
                            wire:click="removeTelefono({{ $index }})" 
                            variant="danger" 
                            class="w-full h-11"
                        >
                            <i class="fa-solid fa-trash-can text-xs"></i>
                            <span>Eliminar</span>
                        </x-shared::form.button-form>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Estado cuando no hay números registrados --}}
        @if(count($telefonos) === 0)
            <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/20 rounded-xl text-xs font-medium text-gray-400 dark:text-gray-500" wire:key="telefonos-vacio-{{ $clienteId }}">
                <i class="fa-solid fa-phone-slash text-xl block mb-2 text-gray-300 dark:text-gray-700"></i> 
                El expediente comercial no contiene números telefónicos vinculados. Registre al menos uno.
            </div>
        @endif
    </div>
    
    <x-shared::form.input-error :messages="$errors->get('telefonos')" class="mt-2" />
</div>