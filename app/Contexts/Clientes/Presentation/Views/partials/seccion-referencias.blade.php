<div wire:key="cliente-referencias-modulo-{{ $clienteId ?? 'new' }}">
    {{-- Encabezado estilizado alineado al diseño del sistema --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
            <i class="fa-solid fa-users-rectangle mr-2"></i>Contactos y Referencias de Aval
        </h3>

        <x-shared::form.button-form 
            type="button" 
            wire:click="addReferencia" 
            variant="secondary" 
            size="md"
        >
            <i class="fa-solid fa-plus text-indigo-600 dark:text-indigo-400"></i>
            <span>Añadir Referencia</span>
        </x-shared::form.button-form>
    </div>

    {{-- Lista de Referencias --}}
    <div class="space-y-4">
        @foreach($referencias as $index => $item)
            <div class="border border-gray-100 dark:border-gray-800/60 bg-gray-50/50 dark:bg-gray-900/40 rounded-xl relative transition-all duration-150 hover:z-20 focus-within:z-30" 
                wire:key="referencia-row-{{ $index }}-{{ $item['id'] ?? 'new' }}">
                
                <input type="hidden" wire:model="referencias.{{ $index }}.id">

                {{-- Bloque Superior: Datos Principales --}}
                <div class="p-4 grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                    <div class="hidden md:flex md:col-span-1 items-center justify-center font-mono text-xs font-bold text-gray-400 dark:text-gray-500 pb-3">
                        #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    {{-- Nombre Completo --}}
                    <div class="md:col-span-4">
                        <x-shared::form.input-label :for="'ref_nombre_' . $index" :value="__('Nombre Completo')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                :id="'ref_nombre_' . $index"
                                type="text" 
                                wire:model="referencias.{{ $index }}.nombre" 
                                placeholder="Nombre de la referencia" 
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.nombre')" class="mt-2" />
                    </div>

                    {{-- Teléfono Celular --}}
                    <div class="md:col-span-3">
                        <x-shared::form.input-label :for="'ref_celular_' . $index" :value="__('Teléfono Celular')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                :id="'ref_celular_' . $index"
                                type="text" 
                                wire:model="referencias.{{ $index }}.celular" 
                                placeholder="10 dígitos" 
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.celular')" class="mt-2" />
                    </div>

                    {{-- Vínculo / Relación --}}
                    <div class="md:col-span-3">
                        <x-shared::form.input-label :for="'ref_parentesco_' . $index" :value="__('Vínculo / Relación')" />
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                :id="'ref_parentesco_' . $index"
                                type="text" 
                                wire:model="referencias.{{ $index }}.parentesco" 
                                placeholder="Ej: Familiar, Comercial" 
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.parentesco')" class="mt-2" />
                    </div>

                    {{-- Botón de Eliminar Danger --}}
                    <div class="md:col-span-1 flex justify-end">
                        <x-shared::form.button-form 
                            type="button" 
                            wire:click="removeReferencia({{ $index }})" 
                            variant="danger" 
                            class="h-11 w-full justify-center"
                            title="Remover Referencia"
                        >
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </x-shared::form.button-form>
                    </div>
                </div>

                {{-- Bloque Inferior: Ubicación y Dirección --}}
                <div class="px-4 pb-4 pt-3 border-t border-dashed border-gray-200/60 dark:border-gray-800/60 bg-white/40 dark:bg-gray-900/20 grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-1 hidden md:flex items-center justify-center text-gray-400 dark:text-gray-500">
                        <i class="fa-solid fa-map-location-dot text-sm"></i>
                    </div>

                    {{-- Calle y Número --}}
                    <div class="md:col-span-7">
                        <x-shared::form.input-label :for="'ref_calle_' . $index" :value="__('Calle y Número de Contacto')" />
                        <div class="mt-1.5">
                            <x-shared::form.text-input 
                                :id="'ref_calle_' . $index"
                                type="text" 
                                wire:model="referencias.{{ $index }}.calle_numero" 
                                placeholder="Dirección completa (Calle, Num Ext, Num Int)" 
                            />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.calle_numero')" class="mt-2" />
                    </div>

                    {{-- Ubicación / Asentamiento --}}
                    <div class="md:col-span-4">
                        <x-shared::form.input-label :for="'ref_asentamiento_' . $index" :value="__('Ubicación / Asentamiento')" />
                        <div class="mt-1.5">
                            <x-shared::form.searchable-select 
                                :id="'ref_asentamiento_' . $index"
                                wire:model="referencias.{{ $index }}.asentamiento_id" 
                                placeholder="-- BUSCAR ZONA --"
                            >
                                <option value="">-- Sin asignar --</option>
                                @foreach($this->todosLosAsentamientos as $asentamiento)
                                    <option value="{{ $asentamiento->getId() }}">
                                        {{ $asentamiento->getNombreAsentamiento() }} (C.P. {{ $asentamiento->getCodigoPostal() }})
                                    </option>
                                @endforeach
                            </x-shared::form.searchable-select>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('referencias.' . $index . '.asentamiento_id')" class="mt-2" />
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Estado cuando no hay referencias registradas --}}
        @if(count($referencias) === 0)
            <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/20 rounded-xl text-xs font-medium text-gray-400 dark:text-gray-500" wire:key="referencias-vacio-{{ $clienteId }}">
                <i class="fa-solid fa-users-slash text-xl block mb-2 text-gray-300 dark:text-gray-700"></i> 
                El expediente no contiene referencias asignadas. Registre al menos un contacto.
            </div>
        @endif
    </div>

    <x-shared::form.input-error :messages="$errors->get('referencias')" class="mt-2" />
</div>