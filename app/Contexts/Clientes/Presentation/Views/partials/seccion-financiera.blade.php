<div class="pt-6 border-t border-gray-100 dark:border-gray-900">
    <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">
        <i class="fa-solid fa-credit-card mr-2"></i>Identificaciones y Capacidad Financiera
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <x-shared::form.input-label for="curp" :value="__('CURP')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="curp" type="text" wire:model="curp" placeholder="18 Caracteres" class="w-full font-mono uppercase font-bold tracking-wide" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('curp')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="rfc" :value="__('RFC')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="rfc" type="text" wire:model="rfc" placeholder="13 Homoclave" class="w-full font-mono uppercase font-bold tracking-wide" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('rfc')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="nss" :value="__('NSS (Seguro Social)')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="nss" type="text" wire:model="nss" placeholder="11 dígitos" class="w-full font-mono font-bold tracking-wide" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('nss')" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
        <div class="md:col-span-2">
            <x-shared::form.input-label for="correo_infonavit" :value="__('Correo Cuenta Infonavit')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="correo_infonavit" type="email" wire:model="correo_infonavit" placeholder="usuario@ejemplo.com" class="w-full font-medium" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('correo_infonavit')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="contrasena_infonavit" :value="__('Contraseña Infonavit')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="contrasena_infonavit" type="password" wire:model="contrasena_infonavit" placeholder="••••••••" class="w-full font-medium" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('contrasena_infonavit')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="precalificacion" :value="__('Monto Precalificación ($)')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="precalificacion" type="number" step="0.01" wire:model="precalificacion" placeholder="0.00" class="w-full font-mono font-bold" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('precalificacion')" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div>
            <x-shared::form.input-label for="avaluo_solicitado" :value="__('¿Avalúo Solicitado?')"/>
            <div class="mt-1.5">
                <x-shared::form.input-select id="avaluo_solicitado" wire:model="avaluo_solicitado" :messages="$errors->get('avaluo_solicitado')">
                    <option value="No">No</option>
                    <option value="Sí">Sí</option>
                </x-shared::form.input-select>
            </div>
            <x-shared::form.input-error :messages="$errors->get('avaluo_solicitado')" class="mt-2" />
        </div>

        <div>
            <x-shared::form.input-label for="tipo_credito_id" :value="__('Tipo de Crédito Tentativo')"/>
            <div class="mt-1.5">
                <x-shared::form.searchable-select wire:model="tipo_credito_id" placeholder="-- BUSCAR O SELECCIONAR CRÉDITO --" :messages="$errors->get('tipo_credito_id')">
                    <option value="">-- No Asignado --</option>
                    @foreach($this->tiposCredito as $tipo)
                        <option value="{{ $tipo->getId() }}">{{ $tipo->getNombre() }}</option>
                    @endforeach
                </x-shared::form.searchable-select>
            </div>
            <x-shared::form.input-error :messages="$errors->get('tipo_credito_id')" class="mt-2" />
        </div>

    </div>
</div>