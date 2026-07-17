{{-- Estado --}}
<div wire:key="geo-shared-estado-block">
    <x-shared::form.input-label for="selectedEstado" :value="__('Estado / Entidad')" class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.input-select id="selectedEstado" wire:model.live="selectedEstado">
            <option value="">-- SELECCIONAR ESTADO --</option>
            @foreach($this->estados as $edo)
                <option value="{{ $edo }}">{{ $edo }}</option>
            @endforeach
        </x-shared::form.input-select>
    </div>
    <x-shared::form.input-error :messages="$errors->get('selectedEstado')" class="mt-2" />
</div>

{{-- Municipio --}}
<div wire:key="geo-shared-municipio-block-{{ $selectedEstado }}">
    <x-shared::form.input-label for="selectedMunicipio" :value="__('Municipio / Alcaldía')" class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.input-select id="selectedMunicipio" wire:model.live="selectedMunicipio" :disabled="empty($selectedEstado)">
            <option value="">-- SELECCIONAR MUNICIPIO --</option>
            @foreach($this->municipios as $mun) 
                <option value="{{ $mun }}">{{ $mun }}</option>
            @endforeach
        </x-shared::form.input-select>
    </div>
    <x-shared::form.input-error :messages="$errors->get('selectedMunicipio')" class="mt-2" />
</div>

{{-- Ciudad --}}
<div wire:key="geo-shared-ciudad-block-{{ $selectedMunicipio }}">
    <x-shared::form.input-label for="selectedCiudad" :value="__('Ciudad / Localidad')" class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.input-select id="selectedCiudad" wire:model.live="selectedCiudad" :disabled="empty($selectedMunicipio)">
            <option value="">-- SELECCIONAR CIUDAD --</option>
            @foreach($this->ciudades as $ciu) 
                <option value="{{ $ciu }}">{{ $ciu }}</option>
            @endforeach
        </x-shared::form.input-select>
    </div>
    <x-shared::form.input-error :messages="$errors->get('selectedCiudad')" class="mt-2" />
</div>

{{-- Asentamiento --}}
<div wire:key="geo-shared-asentamiento-block-{{ $selectedCiudad }}" class="md:col-span-1">
    <x-shared::form.input-label for="asentamiento_id" :value="__('Ubicación Postal / Asentamiento')" required class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.searchable-select id="asentamiento_id" wire:model="asentamiento_id" liveSearch="searchAsentamiento" placeholder="Buscar por C.P. o Colonia...">
            @if(count($this->asentamientos) === 0)
                <option value="">-- NO SE ENCONTRARON RESULTADOS --</option>
            @else
                <option value="">-- SELECCIONAR --</option>
                @foreach($this->asentamientos as $as) 
                    <option value="{{ $as->getId() }}">CP {{ $as->getCodigoPostal() }} - {{ $as->getNombreAsentamiento() }}</option>
                @endforeach
            @endif
        </x-shared::form.searchable-select>
    </div>
    <x-shared::form.input-error :messages="$errors->get('asentamiento_id')" class="mt-2" />
</div>

{{-- Precio Lista --}}
<div>
    <x-shared::form.input-label for="precio_lista" :value="__('Precio de Lista ($)')" required class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.text-input id="precio_lista" type="number" step="0.01" wire:model="precio_lista" placeholder="0.00" class="w-full font-mono font-bold" />
    </div>
    <x-shared::form.input-error :messages="$errors->get('precio_lista')" class="mt-2" />
</div>

{{-- Recámaras --}}
<div>
    <x-shared::form.input-label for="recamaras" :value="__('Número de Recámaras')" required class="text-gray-700 dark:text-gray-300"/>
    <div class="mt-1.5">
        <x-shared::form.text-input id="recamaras" type="number" wire:model="recamaras" class="w-full font-medium" />
    </div>
    <x-shared::form.input-error :messages="$errors->get('recamaras')" class="mt-2" />
</div>

{{-- Dirección Detallada Full-Width --}}
<div class="md:col-span-3">
    <x-shared::form.input-label for="direccion" :value="__('Dirección Completa (Calle, Número, Interno)')" required/>
    <div class="mt-1.5">
        <x-shared::form.textarea-input id="direccion" wire:model="direccion" placeholder="Ingresa la calle, número exterior y número de lote exacto..." :messages="$errors->get('direccion')" class="w-full text-sm font-medium h-24 rounded-none" />
    </div>
</div>