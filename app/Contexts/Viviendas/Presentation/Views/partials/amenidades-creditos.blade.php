<div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-200 dark:border-gray-800">
    
    {{-- Créditos Admitidos --}}
    <div class="space-y-3">
        <div>
            <span class="block text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                Créditos Financieros Permitidos
            </span>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Selecciona los esquemas de financiamiento aceptados para esta propiedad.
            </p>
        </div>

        <div class="space-y-2.5 max-h-60 overflow-y-auto pr-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                @foreach($this->creditosDisponibles as $cr) 
                    @php $crData = $cr->toArray(); @endphp
                    <x-shared::form.checkbox-input
                        value="{{ $crData['id'] }}" 
                        wire:model="creditos_ids"
                        :label="$crData['nombre']"
                    />
                @endforeach
            </div>
        </div>
    </div>

    {{-- Amenidades --}}
    <div class="space-y-3">
        <div>
            <span class="block text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                Amenidades e Infraestructura Interna
            </span>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Equipamiento e instalaciones disponibles dentro de la residencia.
            </p>
        </div>

        <div class="space-y-2.5 max-h-60 overflow-y-auto pr-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                @foreach($this->amenidadesDisponibles as $am) 
                    @php $amData = $am->toArray(); @endphp
                    <x-shared::form.checkbox-input
                        value="{{ $amData['id'] }}" 
                        wire:model="amenidades_ids"
                        :label="$amData['nombre']"
                    />
                @endforeach
            </div>
        </div>
    </div>

</div>

{{-- Llaves en Resguardo Control --}}
<div class="md:col-span-3 pt-6 border-t border-dashed border-gray-200 dark:border-gray-800">
    <x-shared::form.checkbox-input
        id="llaves"
        wire:model="llaves"
        label="¿Llaves en Resguardo Oficina?"
        description="Modifique el estado si las llaves físicas han sido entregadas o retiradas de la sucursal comercial."
        :messages="$errors->get('llaves')"
    />
</div>