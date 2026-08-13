<div class="md:col-span-3 ">
    {{-- Encabezado de la Sección --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
        <div>
            <span class="block text-sm font-extrabold uppercase tracking-tight text-gray-900 dark:text-white">
                Contactos Relacionados Propietario / Llaves
            </span>
            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5">
                Asigne números telefónicos de administradores, dueños anteriores o agentes con acceso al inmueble.
            </p>
        </div>

        {{-- Botón Agregar Contacto --}}
        <x-shared::form.button-form
            type="button"
            variant="secondary"
            wire:click="addContacto"
            class="shrink-0"
        >
            <i class="fa-solid fa-plus text-indigo-600 dark:text-indigo-400"></i>
            <span>Añadir Contacto</span>
        </x-shared::form.button-form>
    </div>

    {{-- Lista Dinámica de Contactos --}}
    <div class="space-y-4">
        @foreach($contactos as $index => $contacto)
            <div 
                wire:key="contacto-row-{{ $index }}"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/40 dark:bg-gray-900/20 relative shadow-2xs transition-all"
            >
                <input type="hidden" wire:model="contactos.{{ $index }}.id">
                
                {{-- Nombre Completo --}}
                <div class="md:col-span-3">
                    <x-shared::form.input-label for="contacto_nombre_{{ $index }}" :value="__('Nombre Completo')" required />
                    <div class="mt-1">
                        <x-shared::form.text-input 
                            id="contacto_nombre_{{ $index }}"
                            type="text" 
                            wire:model="contactos.{{ $index }}.nombre" 
                            placeholder="ej: Juan Pérez" 
                            :messages="$errors->get('contactos.' . $index . '.nombre')"
                        />
                    </div>
                </div>
                
                {{-- Relación / Vínculo --}}
                <div class="md:col-span-2">
                    <x-shared::form.input-label for="contacto_relacion_{{ $index }}" :value="__('Relación / Vínculo')" />
                    <div class="mt-1">
                        <x-shared::form.text-input 
                            id="contacto_relacion_{{ $index }}"
                            type="text" 
                            wire:model="contactos.{{ $index }}.relacion" 
                            placeholder="ej: Propietario" 
                            :messages="$errors->get('contactos.' . $index . '.relacion')"
                        />
                    </div>
                </div>
                
                {{-- Teléfono --}}
                <div class="md:col-span-2">
                    <x-shared::form.input-label for="contacto_telefono_{{ $index }}" :value="__('Teléfono')" />
                    <div class="mt-1">
                        <x-shared::form.text-input 
                            id="contacto_telefono_{{ $index }}"
                            type="text" 
                            wire:model="contactos.{{ $index }}.telefono" 
                            placeholder="10 dígitos" 
                            :messages="$errors->get('contactos.' . $index . '.telefono')"
                        />
                    </div>
                </div>
                
                {{-- Correo Electrónico --}}
                <div class="md:col-span-2">
                    <x-shared::form.input-label for="contacto_correo_{{ $index }}" :value="__('Correo Electrónico')" />
                    <div class="mt-1">
                        <x-shared::form.text-input 
                            id="contacto_correo_{{ $index }}"
                            type="email" 
                            wire:model="contactos.{{ $index }}.correo" 
                            placeholder="ejemplo@mail.com" 
                            :messages="$errors->get('contactos.' . $index . '.correo')"
                        />
                    </div>
                </div>
                
                {{-- Notas Cortas --}}
                <div class="md:col-span-2">
                    <x-shared::form.input-label for="contacto_notes_{{ $index }}" :value="__('Notas Cortas')" />
                    <div class="mt-1">
                        <x-shared::form.text-input 
                            id="contacto_notes_{{ $index }}"
                            type="text" 
                            wire:model="contactos.{{ $index }}.notes" 
                            placeholder="Horarios, etc." 
                            :messages="$errors->get('contactos.' . $index . '.notes')"
                        />
                    </div>
                </div>

                {{-- Botón Eliminar Fila --}}
                <div class="md:col-span-1 flex items-end justify-center">
                    <x-shared::form.button-form
                        type="button"
                        variant="danger"
                        wire:click="removeContacto({{ $index }})"
                        class="w-full h-11 justify-center"
                        title="Eliminar contacto"
                    >
                        <i class="fa-solid fa-trash-can text-sm"></i>
                    </x-shared::form.button-form>
                </div>
            </div>
        @endforeach
    </div>
</div>