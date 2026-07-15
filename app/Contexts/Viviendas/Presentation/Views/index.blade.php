{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div>
    <x-shared::form.table-filters 
        title="Inventario Comercial de Inmuebles"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('viviendas.create')"
    >
        <x-slot:filters>
            {{-- Select personalizado para filtrar por estatus de vivienda --}}
            <div class="w-full sm:w-48 text-left">
                <select wire:model.live="estatus" class="w-full text-xs font-bold uppercase tracking-wide border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-11 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Todos los Estatus --</option>
                    <option value="Disponible">Disponible</option>
                    <option value="Apartada">Apartada</option>
                    <option value="Vendida">Vendida</option>
                    <option value="Rentada">Rentada</option>
                    <option value="Mantenimiento">Mantenimiento</option>
                    <option value="Suspendida">Suspendida</option>
                </select>
            </div>
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Ubicación / Ficha</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Tipo Inmueble</th>
                        <th scope="col" class="px-6 py-4 text-end text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Precio de Lista</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estatus</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($viviendas as $vivienda)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-100 dark:divide-gray-800" wire:key="vivienda-{{ $vivienda->id }}">
                            
                            {{-- Ubicación --}}
                            <td class="px-6 py-4 border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">
                                    {{ $vivienda->fraccionamiento ?? 'Sin Fraccionamiento Específico' }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5 max-w-sm truncate">
                                    {{ $vivienda->direccion }}
                                </div>
                                @if($vivienda->asentamiento)
                                    <div class="text-[10px] font-mono font-black text-indigo-600 dark:text-indigo-400 mt-1 uppercase tracking-wider">
                                        C.P. {{ $vivienda->asentamiento->codigo_postal }} - {{ $vivienda->asentamiento->nombre_asentamiento }}
                                    </div>
                                @endif
                            </td>

                            {{-- Tipo --}}
                            <td class="px-6 py-4 whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850 text-sm font-semibold text-gray-600 dark:text-gray-300">
                                <div>{{ $vivienda->tipoVivienda->nombre ?? 'No asignado' }}</div>
                                <div class="text-[10px] font-bold text-gray-400 mt-0.5"><i class="fa-solid fa-bed mr-1"></i>{{ $vivienda->recamaras }} Rec.</div>
                            </td>

                            {{-- Precio --}}
                            <td class="px-6 py-4 whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850 text-end font-mono text-sm font-bold text-gray-900 dark:text-white">
                                ${{ number_format($vivienda->precio_lista, 2) }}
                            </td>

                            {{-- Estatus --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap border-l border-r border-gray-150 dark:border-gray-850">
                                @php
                                    $color = match($vivienda->estatus_vivienda) {
                                        'Disponible'    => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border-emerald-100 dark:border-emerald-500/20',
                                        'Apartada'      => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border-amber-100 dark:border-amber-500/20',
                                        'Vendida'       => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-700',
                                        'Mantenimiento' => 'bg-cyan-50 text-cyan-700 dark:bg-cyan-500/10 dark:text-cyan-400 border-cyan-100 dark:border-cyan-500/20',
                                        default         => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border-red-100 dark:border-red-500/20',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-none text-xs font-bold border {{ $color }}">
                                    {{ $vivienda->estatus_vivienda }}
                                </span>
                            </td>

                            {{-- Acciones --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap z-30 border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('viviendas.edit', $vivienda->id) }}" class="p-2 rounded-xl text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-pen-to-square text-base"></i>
                                    </a>
                                    
                                    <button type="button" wire:click="confirmDelete({{ $vivienda->id }})" class="p-2 rounded-xl text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-trash-can text-base"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center border-l border-r border-gray-150 dark:border-gray-850">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 shadow-xs">
                                        <i class="fa-solid fa-house-circle-xmark text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight">Sin Inmuebles</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No se encontraron fichas de propiedades cargadas en el inventario.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($viviendas->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $viviendas->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>