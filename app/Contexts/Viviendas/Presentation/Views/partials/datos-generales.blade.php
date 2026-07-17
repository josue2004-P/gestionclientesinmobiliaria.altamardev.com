{{-- Fraccionamiento --}}
<div>
    <x-shared::form.input-label for="fraccionamiento" :value="__('Fraccionamiento / Proyecto')" class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.text-input id="fraccionamiento" type="text" wire:model="fraccionamiento" placeholder="ej: Residencial del Bosque" class="w-full font-bold" />
    </div>
    <x-shared::form.input-error :messages="$errors->get('fraccionamiento')" class="mt-2" />
</div>

{{-- Tipo Vivienda --}}
<div>
    <x-shared::form.input-label for="tipo_vivienda_id" :value="__('Modelo / Tipo de Vivienda')" required class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.searchable-select id="tipo_vivienda_id" wire:model="tipo_vivienda_id" placeholder="Seleccionar Modelo...">
            <option value="">-- SELECCIONAR --</option>
            @foreach($tiposVivienda as $tipo)
                <option value="{{ $tipo->getId() }}">{{ $tipo->getNombre() }}</option>
            @endforeach
        </x-shared::form.searchable-select>
    </div>
    <x-shared::form.input-error :messages="$errors->get('tipo_vivienda_id')" class="mt-2" />
</div>

{{-- Estatus Operativo --}}
<div>
    <x-shared::form.input-label for="estatus_vivienda" :value="__('Estatus Operativo')" required class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.input-select id="estatus_vivienda" wire:model="estatus_vivienda" :messages="$errors->get('estatus_vivienda')" class="uppercase tracking-wide font-bold">
            <option value="Disponible">Disponible</option>
            <option value="Apartada">Apartada</option>
            <option value="Vendida">Vendida</option>
            <option value="Rentada">Rentada</option>
            <option value="Mantenimiento">Mantenimiento</option>
            <option value="Suspendida">Suspendida</option>
        </x-shared::form.input-select>
    </div>
    <x-shared::form.input-error :messages="$errors->get('estatus_vivienda')" class="mt-2" />
</div>