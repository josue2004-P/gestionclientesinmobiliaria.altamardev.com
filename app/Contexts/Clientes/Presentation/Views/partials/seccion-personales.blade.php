<div>
    <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">
        <i class="fa-solid fa-user mr-2"></i>Información Personal
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <x-shared::form.input-label for="nombre" :value="__('Nombre(s)')" required/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="nombre" type="text" wire:model="nombre" placeholder="ej: Juan" class="w-full font-medium" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="apellido_paterno" :value="__('Apellido Paterno')" required/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="apellido_paterno" type="text" wire:model="apellido_paterno" placeholder="ej: Pérez" class="w-full font-medium" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="apellido_materno" :value="__('Apellido Materno')" required/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="apellido_materno" type="text" wire:model="apellido_materno" placeholder="ej: López" class="w-full font-medium" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
        </div>

        {{-- Soporta el wire:ignore dinámico del Edit usando la variable opcional $clienteId --}}
        <div @if(isset($clienteId)) wire:key="cliente-datepicker-{{ $clienteId }}" wire:ignore @endif>
            <x-shared::form.input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')"/>
            <div class="mt-1.5">
                <x-shared::form.date-picker id="fecha_nacimiento" wire:model="fecha_nacimiento" placeholder="Selecciona la fecha" :messages="$errors->get('fecha_nacimiento')" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="estado_civil" :value="__('Estado Civil')"/>
            <div class="mt-1.5">
                <x-shared::form.input-select id="estado_civil" wire:model.live="estado_civil" placeholder="-- SELECCIONAR --" :messages="$errors->get('estado_civil')">
                    <option value="Soltero">Soltero/a</option>
                    <option value="Casado">Casado/a</option>
                    <option value="Divorciado">Divorciado/a</option>
                    <option value="Viudo">Viudo/a</option>
                    <option value="Union_Libre">Unión Libre</option>
                </x-shared::form.input-select>
            </div>
            <x-shared::form.input-error :messages="$errors->get('estado_civil')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="regimen_casamiento" :value="__('Régimen Patrimonial')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="regimen_casamiento" type="text" wire:model="regimen_casamiento" :disabled="$estado_civil !== 'Casado'" placeholder="Bienes Mancomunados, etc." class="w-full font-medium disabled:bg-gray-100 dark:disabled:bg-gray-900 transition-colors" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('regimen_casamiento')" class="mt-2" />
        </div>
    </div>
</div>