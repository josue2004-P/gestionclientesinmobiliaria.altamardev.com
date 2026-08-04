<div>
    {{-- Header de la Sección --}}
    <x-shared::common.header 
        title="Inventario Comercial de Inmuebles" 
        icon="fa-house-chimney-window"
        desc="Catálogo integral de propiedades, fichas de inventario, estatus comercial y contactos directos"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Inventario de Inmuebles', 'url' => null]
        ]"
    />

    <x-shared::form.table-filters 
        title="Inventario Comercial de Inmuebles"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('viviendas.create')"
    >
        <x-slot:filters>
            {{-- Select para filtrar por estatus de vivienda --}}
            <div class="w-full sm:w-56 text-left">
                <select 
                    wire:model.live="estatus" 
                    class="w-full text-xs font-bold uppercase tracking-wide border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-md h-10 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 dark:text-gray-300"
                >
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

        <div class="border-t border-gray-200 dark:border-gray-800">

            {{-- ================================================= --}}
            {{-- 1. VISTA MÓVIL: CARDS (< 768px)                   --}}
            {{-- ================================================= --}}
            <div class="md:hidden p-4 space-y-4 bg-gray-50/50 dark:bg-gray-950/20">
                @forelse($viviendas as $vivienda)
                    @php
                        $fotoPrincipal = $vivienda->fotos->firstWhere('es_principal', true) ?? $vivienda->fotos->first();
                        $imagenUrl = $fotoPrincipal ? asset('storage/' . $fotoPrincipal->url) : null;

                        $colorEstatus = match($vivienda->estatus_vivienda) {
                            'Disponible'    => 'bg-emerald-500 text-white shadow-emerald-500/20',
                            'Apartada'      => 'bg-amber-500 text-white shadow-amber-500/20',
                            'Vendida'       => 'bg-gray-700 text-white shadow-gray-700/20',
                            'Rentada'       => 'bg-indigo-600 text-white shadow-indigo-600/20',
                            'Mantenimiento' => 'bg-cyan-600 text-white shadow-cyan-600/20',
                            default         => 'bg-red-500 text-white shadow-red-500/20',
                        };
                    @endphp

                    <div wire:key="vivienda-card-{{ $vivienda->id }}" class="rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-gray-900 overflow-hidden space-y-3">
                        
                        {{-- Cabecera con Imagen / Fallback --}}
                        <div class="relative h-36 w-full bg-gray-100 dark:bg-gray-950 overflow-hidden">
                            @if($imagenUrl)
                                <img src="{{ $imagenUrl }}" alt="{{ $vivienda->fraccionamiento }}" class="h-full w-full object-cover" />
                            @else
                                <div class="flex h-full w-full items-center justify-center text-gray-300 dark:text-gray-700">
                                    <i class="fa-solid fa-house-chimney text-3xl"></i>
                                </div>
                            @endif

                            {{-- Badge Estatus --}}
                            <div class="absolute top-2.5 left-2.5 z-10">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $colorEstatus }}">
                                    {{ $vivienda->estatus_vivienda }}
                                </span>
                            </div>

                            @if($vivienda->llaves)
                                <div class="absolute top-2.5 right-2.5 z-10">
                                    <span class="bg-black/60 backdrop-blur-md text-amber-400 px-2 py-0.5 rounded-md text-[10px] font-bold border border-amber-400/30">
                                        <i class="fa-solid fa-key"></i> Llaves
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Información principal --}}
                        <div class="px-4 space-y-2">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h3 class="text-sm font-black text-gray-900 dark:text-white uppercase truncate">
                                        {{ $vivienda->fraccionamiento ?? 'Desarrollo Independiente' }}
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate uppercase mt-0.5">
                                        <i class="fa-solid fa-location-dot text-indigo-500 text-[10px] mr-1"></i>{{ $vivienda->direccion }}
                                    </p>
                                </div>
                            </div>

                            @if($vivienda->asentamiento)
                                <div class="text-[10px] font-mono font-bold text-indigo-600 dark:text-indigo-400 uppercase">
                                    C.P. {{ $vivienda->asentamiento->codigo_postal }} - {{ $vivienda->asentamiento->nombre_asentamiento }}
                                </div>
                            @endif

                            {{-- Precio de Lista --}}
                            <div class="flex items-center justify-between bg-emerald-50 dark:bg-emerald-500/10 p-2 rounded-xl border border-emerald-100 dark:border-emerald-500/20">
                                <span class="text-[10px] font-bold uppercase text-emerald-700 dark:text-emerald-400">Precio Lista</span>
                                <span class="font-mono text-sm font-black text-emerald-800 dark:text-emerald-300">
                                    ${{ number_format($vivienda->precio_lista, 2) }} MXN
                                </span>
                            </div>

                            {{-- Specs --}}
                            <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-300 py-1 border-t border-gray-100 dark:border-gray-800">
                                <span><i class="fa-solid fa-building text-indigo-500 mr-1"></i>{{ $vivienda->tipoVivienda->nombre ?? 'N/A' }}</span>
                                <span><i class="fa-solid fa-bed text-indigo-500 mr-1"></i>{{ $vivienda->recamaras }} Rec.</span>
                            </div>

                            {{-- Contactos --}}
                            <div class="space-y-1 pt-1">
                                <span class="text-[10px] font-black uppercase text-gray-400 block">Contactos</span>
                                @forelse($vivienda->contactos->take(2) as $contacto)
                                    <div class="flex items-center justify-between text-xs bg-gray-50 dark:bg-gray-950 p-1.5 rounded-lg border border-gray-100 dark:border-gray-800">
                                        <span class="font-bold text-gray-800 dark:text-gray-200 truncate uppercase">{{ $contacto->nombre }}</span>
                                        @if($contacto->telefono)
                                            <a href="tel:{{ $contacto->telefono }}" class="font-mono text-indigo-600 dark:text-indigo-400 font-bold text-[11px]">
                                                <i class="fa-solid fa-phone text-[9px] mr-0.5"></i>{{ $contacto->telefono }}
                                            </a>
                                        @endif
                                    </div>
                                @empty
                                    <span class="text-xs text-gray-400 italic">Sin contactos</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="p-3 bg-gray-50 dark:bg-gray-950/60 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between gap-2">
                            <a href="{{ route('viviendas.edit', $vivienda->id) }}" class="flex-1 text-center py-1.5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-xs font-bold text-gray-700 dark:text-gray-200">
                                <i class="fa-solid fa-pen-to-square mr-1 text-gray-400"></i> Editar Ficha
                            </a>
                            <button type="button" wire:click="confirmDelete({{ $vivienda->id }})" class="h-8 w-8 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-red-500 flex items-center justify-center">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-xs text-gray-500">Sin inmuebles encontrados.</div>
                @endforelse
            </div>

            {{-- ================================================= --}}
            {{-- 2. VISTA ESCRITORIO: TABLA (>= 768px)             --}}
            {{-- ================================================= --}}
            <div class="hidden md:block overflow-x-auto bg-transparent rounded-none transition-colors duration-200">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                            <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Inmueble / Ubicación</th>
                            <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estructura & Equipamiento</th>
                            <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Contactos Asignados</th>
                            <th scope="col" class="px-6 py-4 text-end text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Precio de Lista</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estatus</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                        @forelse($viviendas as $vivienda)
                            <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="vivienda-row-{{ $vivienda->id }}">
                                
                                {{-- Ubicación & Ficha --}}
                                <td class="px-6 py-2 group/card">
                                    <div class="flex items-start gap-3">
                                        {{-- Contenedor del Icono con Hover Corregido --}}
                                        <div class="h-10 w-10 rounded-xl bg-gray-100/80 dark:bg-gray-800/60 text-gray-500 dark:text-gray-400 border border-gray-200/80 dark:border-gray-700/60 flex items-center justify-center shrink-0 mt-0.5 transition-all duration-300 shadow-2xs group-hover/card:bg-indigo-600 group-hover/card:text-white group-hover/card:border-indigo-600 dark:group-hover/card:bg-indigo-500 dark:group-hover/card:border-indigo-500 group-hover/card:shadow-md group-hover/card:shadow-indigo-500/20">
                                            <i class="fa-solid fa-building-circle-check text-sm transition-transform duration-300 group-hover/card:scale-110"></i>
                                        </div>

                                        <div>
                                            {{-- Título / Fraccionamiento --}}
                                            <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight group-hover/card:text-indigo-600 dark:group-hover/card:text-indigo-400 transition-colors uppercase">
                                                {{ $vivienda->fraccionamiento ?? 'Desarrollo Independiente' }}
                                            </div>

                                            {{-- Dirección --}}
                                            <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5 max-w-xs truncate uppercase flex items-center gap-1">
                                                <i class="fa-solid fa-location-dot text-[11px] text-gray-400 dark:text-gray-500 shrink-0"></i>
                                                <span class="truncate">{{ $vivienda->direccion }}</span>
                                            </div>

                                            {{-- Asentamiento & Código Postal --}}
                                            @if($vivienda->asentamiento)
                                                <div class="text-[10px] font-mono font-bold text-indigo-600 dark:text-indigo-400 mt-1 uppercase tracking-wider flex items-center gap-1.5">
                                                    <span class="bg-indigo-50 dark:bg-indigo-500/10 px-1.5 py-0.5 rounded-md border border-indigo-100 dark:border-indigo-500/20">
                                                        C.P. {{ $vivienda->asentamiento->codigo_postal }}
                                                    </span>
                                                    <span class="truncate max-w-[180px] uppercase font-sans text-gray-600 dark:text-gray-300 font-medium">
                                                        {{ $vivienda->asentamiento->nombre_asentamiento }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Tipo / Recámaras / Llaves --}}
                                <td class="px-6 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300">
                                    <div class="font-bold text-gray-900 dark:text-white">
                                        {{ $vivienda->tipoVivienda->nombre ?? 'Sin Prototipo' }}
                                    </div>
                                    
                                    <div class="flex items-center gap-3 mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span><i class="fa-solid fa-bed text-indigo-500 mr-1"></i>{{ $vivienda->recamaras }} Rec.</span>
                                        
                                        @if($vivienda->llaves)
                                            <span class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1" title="Llaves en oficina">
                                                <i class="fa-solid fa-key text-[10px]"></i> Llaves
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic text-[11px]">
                                                Sin Llaves
                                            </span>
                                        @endif
                                    </div>

                                    @if($vivienda->amenidades_count ?? $vivienda->amenidades->count())
                                        <div class="mt-1.5 flex flex-wrap gap-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700">
                                                <i class="fa-solid fa-swimming-pool text-[9px] mr-1 text-indigo-500"></i>
                                                {{ $vivienda->amenidades_count ?? $vivienda->amenidades->count() }} Amenidades
                                            </span>
                                        </div>
                                    @endif
                                </td>

                                {{-- Contactos --}}
                                <td class="px-6 py-2">
                                    <div class="space-y-2 max-w-xs">
                                        @forelse($vivienda->contactos->take(2) as $contacto)
                                            <div class="flex items-center justify-between text-xs bg-gray-50/60 dark:bg-gray-900/60 p-1.5 rounded border border-gray-150 dark:border-gray-800">
                                                <div class="truncate">
                                                    <div class="font-bold text-gray-800 dark:text-gray-200 truncate uppercase">{{ $contacto->nombre }}</div>
                                                    <div class="text-[10px] text-gray-400 capitalize">{{ $contacto->relacion ?? 'Contacto' }}</div>
                                                </div>
                                                @if($contacto->telefono)
                                                    <a href="tel:{{ $contacto->telefono }}" class="ml-2 text-indigo-600 dark:text-indigo-400 font-mono text-[11px] hover:underline font-bold shrink-0 flex items-center gap-1">
                                                        <i class="fa-solid fa-phone text-[9px]"></i> {{ $contacto->telefono }}
                                                    </a>
                                                @endif
                                            </div>
                                        @empty
                                            <span class="text-xs text-gray-400 italic">Sin contactos</span>
                                        @endforelse
                                    </div>
                                </td>

                                {{-- Precio --}}
                                <td class="px-6 py-2 whitespace-nowrap text-end font-mono text-sm font-black text-gray-900 dark:text-white">
                                    ${{ number_format($vivienda->precio_lista, 2) }}
                                </td>

                                {{-- Estatus --}}
                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                    @php
                                        $color = match($vivienda->estatus_vivienda) {
                                            'Disponible'    => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border-emerald-100 dark:border-emerald-500/20',
                                            'Apartada'      => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border-amber-100 dark:border-amber-500/20',
                                            'Vendida'       => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-700',
                                            'Rentada'       => 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-400 border-indigo-100 dark:border-indigo-500/20',
                                            'Mantenimiento' => 'bg-cyan-50 text-cyan-700 dark:bg-cyan-500/10 dark:text-cyan-400 border-cyan-100 dark:border-cyan-500/20',
                                            default         => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border-red-100 dark:border-red-500/20',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border shadow-xs {{ $color }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5"></span>
                                        {{ $vivienda->estatus_vivienda }}
                                    </span>
                                </td>

                                {{-- Acciones --}}
                                <x-shared::form.dropdown-actions title="Opciones">
                                    
                                    {{-- Opción Editar Propiedad --}}
                                    <x-shared::form.dropdown-item 
                                        :href="route('viviendas.edit', $vivienda->id)" 
                                        icon="fa-solid fa-pen-to-square"
                                    >
                                        Editar Propiedad
                                    </x-shared::form.dropdown-item>

                                    {{-- Opción Dar de Baja / Eliminar --}}
                                    @if(checkPermiso('viviendas.is_update'))
                                        <div class="my-1 border-t border-gray-100 dark:border-gray-800"></div>

                                        <x-shared::form.dropdown-item 
                                            wire:click="confirmDelete({{ $vivienda->id }})" 
                                            icon="fa-solid fa-trash-can" 
                                            variant="danger"
                                        >
                                            Dar de Baja Propiedad
                                        </x-shared::form.dropdown-item>
                                    @endif

                                </x-shared::form.dropdown-actions>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 shadow-xs">
                                            <i class="fa-solid fa-house-circle-xmark text-2xl text-gray-300 dark:text-gray-700"></i>
                                        </div>
                                        <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight">Sin Inmuebles</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs mx-auto mt-1">
                                            No se encontraron fichas de propiedades cargadas que coincidan con los filtros aplicados.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        @if($viviendas->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $viviendas->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>