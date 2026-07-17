<div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 dark:border-gray-900">
    {{-- Créditos Admitidos --}}
    <div>
        <span class="block text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">Créditos Financieros Permitidos</span>
        <div class="space-y-2 max-h-40 overflow-y-auto p-3 border border-gray-150 dark:border-gray-900 rounded-none bg-gray-50/50 dark:bg-gray-950/20">
            @foreach($creditosDisponibles as $cr)
                @php $crData = $cr->toArray(); @endphp
                <label class="flex items-center gap-3 text-xs font-medium text-gray-700 dark:text-gray-400 cursor-pointer">
                    <input type="checkbox" value="{{ $crData['id'] }}" wire:model="creditos_ids" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                    <span>{{ $crData['nombre'] }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- Amenidades --}}
    <div>
        <span class="block text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">Amenidades e Infraestructura Interna</span>
        <div class="space-y-2 max-h-40 overflow-y-auto p-3 border border-gray-150 dark:border-gray-900 rounded-none bg-gray-50/50 dark:bg-gray-950/20">
            @foreach($amenidadesDisponibles as $am)
                @php $amData = $am->toArray(); @endphp
                <label class="flex items-center gap-3 text-xs font-medium text-gray-700 dark:text-gray-400 cursor-pointer">
                    <input type="checkbox" value="{{ $amData['id'] }}" wire:model="amenidades_ids" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                    <span>{{ $amData['nombre'] }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>

{{-- Llaves en Resguardo Control --}}
<div class="md:col-span-3 pt-3 flex items-start gap-3">
    <div class="flex h-5 items-center">
        <input id="llaves" type="checkbox" wire:model="llaves" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
    </div>
    <div class="text-xs">
        <label for="llaves" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">¿Llaves en Resguardo Oficina?</label>
        <p class="text-gray-400 dark:text-gray-550 font-medium mt-0.5">Modifique el estado si las llaves físicas han sido entregadas o retiradas de la sucursal comercial.</p>
    </div>
</div>