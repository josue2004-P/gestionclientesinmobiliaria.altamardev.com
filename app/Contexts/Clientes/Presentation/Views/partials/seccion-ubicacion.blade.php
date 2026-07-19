<div class="pt-6 border-t border-gray-100 dark:border-gray-900">
    <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">
        <i class="fa-solid fa-map-location-dot mr-2"></i>Ubicación y Domicilio Principal
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Estado --}}
        <div wire:key="geo-cliente-estado-block">
            <x-shared::form.input-label for="selectedEstado" :value="__('Estado / Entidad')"/>
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
        <div wire:key="geo-cliente-municipio-block-{{ $selectedEstado }}">
            <x-shared::form.input-label for="selectedMunicipio" :value="__('Municipio / Alcaldía')"/>
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
        <div wire:key="geo-cliente-ciudad-block-{{ $selectedMunicipio }}">
            <x-shared::form.input-label for="selectedCiudad" :value="__('Ciudad / Localidad')"/>
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

        {{-- Calle y Número --}}
        <div class="md:col-span-2">
            <x-shared::form.input-label for="calle_numero" :value="__('Calle y Número')"/>
            <div class="mt-1.5">
                <x-shared::form.text-input id="calle_numero" type="text" wire:model="calle_numero" placeholder="ej: Av. Principal #123" class="w-full font-medium" />
            </div>
            <x-shared::form.input-error :messages="$errors->get('calle_numero')" class="mt-2" />
        </div>

        {{-- Asentamiento Buscable Dinámico --}}
        <div wire:key="geo-cliente-asentamiento-block-{{ $selectedCiudad }}">
            <x-shared::form.input-label for="asentamiento_id" :value="__('Asentamiento / Zona')" />
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
    </div>

<div class="mt-6 pt-6 border-t border-dashed border-gray-150 dark:border-gray-900">
    <x-shared::form.multi-select-tags 
        id="zonas_ids"
        wire:model="zonas_ids"
        label="Zonas geográficas de interés / Preferencias de compra"
        placeholder="Escriba para buscar y agregar asentamientos..."
        :messages="$errors->get('zonas_ids')"
        {{-- 🟢 Usamos la nueva propiedad computada unificada conectada al GetAllAsentamientosUseCase --}}
        :options="collect($this->todosLosAsentamientos)->map(fn($a) => [
            'id' => $a->getId(),
            'label' => $a->getNombreAsentamiento() . ' (C.P. ' . $a->getCodigoPostal() . ')'
        ])->toArray()"
    />
</div>
</div>