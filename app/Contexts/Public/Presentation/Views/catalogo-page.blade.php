@section('title', 'Catálogo de Propiedades — EstateLab')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

    <!-- CABECERA Y BREADCRUMB -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200/80 dark:border-gray-700/80 shadow-sm transition-colors duration-200">
        <div>
            <nav class="flex text-xs font-semibold text-gray-400 dark:text-gray-500 space-x-2 mb-1">
                <span>Inicio</span>
                <span>/</span>
                <span class="text-indigo-600 dark:text-indigo-400">Catálogo Completo</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-black text-gray-900 dark:text-white">Todas las Propiedades</h1>
        </div>
        
        <div class="flex items-center gap-4">
            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                <strong class="text-gray-900 dark:text-white">{{ $viviendas->total() }}</strong> Inmuebles encontrados
            </span>
            <div class="flex items-center gap-2">
                <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider hidden sm:inline">Ordenar:</label>
                <select wire:model.live="sort" class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-700 dark:text-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-600">
                    <option value="recent">Más Recientes</option>
                    <option value="price_asc">Precio: Menor a Mayor</option>
                    <option value="price_desc">Precio: Mayor a Menor</option>
                </select>
            </div>
        </div>
    </div>

    <!-- GRID Y FILTROS -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- SIDEBAR DE FILTROS LATERAL -->
        <aside class="lg:col-span-3 bg-white dark:bg-gray-800 border border-gray-200/80 dark:border-gray-700/80 rounded-2xl p-5 shadow-sm sticky top-24 space-y-5 transition-colors duration-200">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 dark:border-gray-700/50">
                <h2 class="font-black text-gray-900 dark:text-white text-xs uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-indigo-600 dark:text-indigo-400"></i>
                    Filtros
                </h2>
                <button wire:click="limpiarFiltros" type="button" class="text-[11px] font-bold text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Limpiar</button>
            </div>

            <div class="space-y-4">
                <!-- Buscador -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Buscar / ID / Fracc.</label>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Ej: Reforma, ID-204..." 
                           class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2 text-xs font-medium text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:border-indigo-600" />
                </div>

                <!-- Estatus -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Estatus</label>
                    <select wire:model.live="estatus" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-700 dark:text-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-600">
                        <option value="">Todos los estatus</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Apartada">Apartada</option>
                        <option value="Rentada">Rentada</option>
                        <option value="Vendida">Vendida</option>
                    </select>
                </div>

                <!-- Municipio -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Ubicación / Municipio</label>
                    <select wire:model.live="municipio" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-700 dark:text-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-600">
                        <option value="">Todas las zonas</option>
                        @foreach($municipios as $m)
                            <option value="{{ $m }}">{{ $m }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipos de Inmueble -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Tipo de Inmueble</label>
                    <div class="space-y-2 text-xs font-medium text-gray-700 dark:text-gray-300">
                        @foreach($tiposVivienda as $tipo)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model.live="tipo_vivienda_id" value="{{ $tipo->id }}" class="rounded text-indigo-600 border-gray-300 dark:border-gray-600 dark:bg-gray-900 focus:ring-indigo-500" />
                                <span>{{ $tipo->nombre }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Recámaras -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Recámaras Mínimas</label>
                    <div class="flex gap-1">
                        @foreach([0 => 'Todas', 1 => '1+', 2 => '2+', 3 => '3+', 4 => '4+'] as $val => $label)
                            <button type="button" wire:click="$set('recamaras', {{ $val }})" 
                                    class="flex-1 py-1 rounded-lg text-xs font-bold border transition {{ $recamaras == $val ? 'bg-white dark:bg-gray-800 border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400' : 'bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:border-indigo-600' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Presupuesto Máximo -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Presupuesto Máximo</label>
                    <select wire:model.live="precio_max" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-700 dark:text-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-600">
                        <option value="">Sin límite</option>
                        <option value="1500000">$1,500,000 MXN</option>
                        <option value="3000000">$3,000,000 MXN</option>
                        <option value="5000000">$5,000,000 MXN</option>
                        <option value="10000000">$10,000,000 MXN</option>
                    </select>
                </div>

                <!-- Amenidades -->
                @if($amenidadesList->count() > 0)
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Amenidades</label>
                    <div class="space-y-2 text-xs font-medium text-gray-700 dark:text-gray-300">
                        @foreach($amenidadesList as $amenidad)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model.live="amenidades" value="{{ $amenidad->id }}" class="rounded text-indigo-600 border-gray-300 dark:border-gray-600 dark:bg-gray-900 focus:ring-indigo-500" />
                                <span>{{ $amenidad->nombre }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </aside>

        <!-- GRID DE PROPIEDADES -->
        <section class="lg:col-span-9 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($viviendas as $vivienda)
                    @php
                        $fotoPrincipal = $vivienda->fotos->firstWhere('es_principal', true)?->url 
                                         ?? $vivienda->fotos->first()?->url 
                                         ?? 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80';
                        $msjWa = rawurlencode("Hola, me interesa obtener más información de la propiedad: {$vivienda->fraccionamiento} (ID: {$vivienda->id}) con precio de $" . number_format($vivienda->precio_lista, 2) . " MXN");
                    @endphp

                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200/80 dark:border-gray-700/80 overflow-hidden shadow-sm hover:shadow-md transition-all duration-200 group flex flex-col justify-between">
                        <div>
                            <!-- IMAGEN -->
                            <div class="relative overflow-hidden h-48 bg-gray-200 dark:bg-gray-700">
                                <img src="{{ $fotoPrincipal }}" alt="{{ $vivienda->fraccionamiento }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                                
                                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 items-center">
                                    <span class="bg-gray-900/90 dark:bg-gray-900/90 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full">
                                        {{ $vivienda->estatus_vivienda }}
                                    </span>
                                    @if($vivienda->llaves)
                                        <span class="bg-emerald-600/90 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full flex items-center gap-1">
                                            <i class="fa-solid fa-key text-[9px]"></i> Llaves
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- INFORMACIÓN -->
                            <div class="p-4">
                                <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-1 line-clamp-1">
                                    <i class="fa-solid fa-location-dot"></i> {{ $vivienda->asentamiento?->nombre_asentamiento ?? 'Ubicación' }}, {{ $vivienda->asentamiento?->municipio }}
                                </p>
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-1">
                                    {{ $vivienda->fraccionamiento ?? 'Inmueble ID-' . $vivienda->id }}
                                </h3>
                                <p class="text-lg font-black text-gray-900 dark:text-white mt-1">
                                    ${{ number_format($vivienda->precio_lista, 2) }} <span class="text-[10px] font-semibold text-gray-400">MXN</span>
                                </p>

                                <div class="mt-3 pt-3 border-t border-gray-100 dark:border-gray-700/50 grid grid-cols-3 gap-1 text-center text-gray-600 dark:text-gray-400 text-[11px] font-medium">
                                    <div class="bg-gray-50 dark:bg-gray-900 p-1.5 rounded-lg border border-gray-100 dark:border-gray-700/40">
                                        <i class="fa-solid fa-bed text-indigo-600 dark:text-indigo-400 block mb-0.5"></i> {{ $vivienda->recamaras }} Rec.
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-900 p-1.5 rounded-lg border border-gray-100 dark:border-gray-700/40">
                                        <i class="fa-solid fa-house text-indigo-600 dark:text-indigo-400 block mb-0.5"></i> {{ $vivienda->tipoVivienda?->nombre ?? 'Inmueble' }}
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-900 p-1.5 rounded-lg border border-gray-100 dark:border-gray-700/40">
                                        <i class="fa-solid fa-hashtag text-indigo-600 dark:text-indigo-400 block mb-0.5"></i> ID: {{ $vivienda->id }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA WHATSAPP -->
                        <div class="px-4 pb-4">
                            <a href="https://wa.me/521223456789?text={{ $msjWa }}" target="_blank" 
                               class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 rounded-xl text-xs flex items-center justify-center gap-2 transition shadow-sm">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Pedir Informes</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 p-12 rounded-2xl border border-gray-200 dark:border-gray-700 text-center">
                        <i class="fa-solid fa-house-circle-xmark text-4xl text-gray-400 mb-3 block"></i>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">No se encontraron propiedades</h3>
                        <p class="text-xs text-gray-500 mt-1">Intenta modificar los criterios de búsqueda o limpia los filtros aplicados.</p>
                        <button wire:click="limpiarFiltros" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-xl text-xs transition">
                            Limpiar Filtros
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- PAGINACIÓN -->
            <div class="pt-4">
                {{ $viviendas->links() }}
            </div>
        </section>

    </div>

</div>