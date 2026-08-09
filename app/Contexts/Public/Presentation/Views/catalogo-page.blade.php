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

                <!-- ESTADO -->
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Estado</label>
                    <select wire:model.live="selectedEstado" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-600">
                        <option value="">Todos los Estados</option>
                        @foreach($this->estados as $est)
                            <option value="{{ $est }}">{{ $est }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- MUNICIPIO (Se habilita según el Estado seleccionado) -->
                @if(!empty($selectedEstado))
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Municipio</label>
                    <select wire:model.live="selectedMunicipio" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-600">
                        <option value="">Todos los Municipios</option>
                        @foreach($this->municipios as $mun)
                            <option value="{{ $mun }}">{{ $mun }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <!-- CIUDAD (Se habilita según el Municipio seleccionado) -->
                @if(!empty($selectedMunicipio))
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Ciudad / Localidad</label>
                    <select wire:model.live="selectedCiudad" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-600">
                        <option value="">Todas las Ciudades</option>
                        @foreach($this->ciudades as $ciu)
                            <option value="{{ $ciu }}">{{ $ciu }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <!-- TIPO DE VIVIENDA (Usando $this->tiposVivienda) -->
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Tipo de Inmueble</label>
                    <div class="space-y-2 text-xs font-medium text-slate-700 dark:text-slate-300">
                        @foreach($this->tiposVivienda as $tipo)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" 
                                    wire:model.live="tipo_vivienda_id" 
                                    value="{{ $tipo['id'] }}" 
                                    class="rounded text-indigo-600 border-slate-300 dark:border-slate-600 dark:bg-slate-900 focus:ring-indigo-500" />
                                <span>{{ $tipo['nombre'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- AMENIDADES (Usando $this->amenidadesDisponibles) -->
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Amenidades</label>
                    <div class="space-y-2 text-xs font-medium text-slate-700 dark:text-slate-300">
                        @foreach($this->amenidadesDisponibles as $amenidad)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" 
                                    wire:model.live="amenidades" 
                                    value="{{ $amenidad['id'] }}" 
                                    class="rounded text-indigo-600 border-slate-300 dark:border-slate-600 dark:bg-slate-900 focus:ring-indigo-500" />
                                <span>{{ $amenidad['nombre'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        <!-- GRID DE PROPIEDADES -->
        <section class="lg:col-span-9 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($viviendas as $vivienda)
                    @php
                        $fotoEntity = $vivienda->fotos->firstWhere('es_principal', true) ?? $vivienda->fotos->first();

                        if ($fotoEntity) {
                            $fotoUrl = route('viviendas.fotos.show', ['id' => $fotoEntity->id]);
                        } else {
                            $fotoUrl = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80';
                        }

                        $tituloPropiedad = $vivienda->fraccionamiento ?? 'Inmueble ID-' . $vivienda->id;
                        
                        $msjWa = rawurlencode("Hola, me interesa solicitar la ficha técnica y precio de la propiedad: {$tituloPropiedad} (ID: {$vivienda->id}) ubicada en {$vivienda->asentamiento?->municipio}.");
                    @endphp

                    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col justify-between">
                        <div>
                            <!-- CONTENEDOR DE LA IMAGEN Y BADGES -->
                            <div class="relative overflow-hidden h-56 bg-slate-200 dark:bg-slate-700">
                                <img src="{{ $fotoUrl }}" 
                                    alt="{{ $tituloPropiedad }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                                    loading="lazy" />
                                
                                <!-- BADGES DE ESTATUS Y CARACTERÍSTICAS CLAVE -->
                                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 items-center">
                                    <span class="bg-slate-900/90 dark:bg-slate-950/90 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                                        {{ $vivienda->estatus_vivienda }}
                                    </span>
                                    
                                    @if($vivienda->llaves)
                                        <span class="bg-emerald-600/90 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                            <i class="fa-solid fa-key text-[9px]"></i> Llaves listas
                                        </span>
                                    @endif
                                </div>

                                <!-- BADGE DE ID TIPO FICHA -->
                                <div class="absolute bottom-3 right-3 bg-slate-900/80 backdrop-blur text-white text-[10px] font-mono px-2.5 py-0.5 rounded-lg border border-white/20">
                                    ID: #{{ $vivienda->id }}
                                </div>
                            </div>

                            <!-- CONTENIDO INFORMATIVO EXPANDIDO -->
                            <div class="p-5 space-y-3">
                                <!-- UBICACIÓN Y MUNICIPIO -->
                                <div>
                                    <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-1 flex items-center gap-1 line-clamp-1">
                                        <i class="fa-solid fa-location-dot"></i> 
                                        {{ $vivienda->asentamiento?->nombre_asentamiento ?? 'Zona residencial' }}, {{ $vivienda->asentamiento?->municipio }}
                                    </p>

                                    <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-1 uppercase">
                                        {{ $tituloPropiedad }}
                                    </h3>
                                </div>

                                <!-- DIRECCIÓN O REFERENCIA CERCANA -->
                                @if($vivienda->direccion)
                                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed uppercase">
                                        <i class="fa-solid fa-map-pin text-slate-400 dark:text-slate-500 mr-1 text-[11px]"></i>
                                        {{ $vivienda->direccion }}
                                    </p>
                                @endif

                                <!-- ESPECIFICACIONES TÉCNICAS (GRID DE 3 COLUMNAS) -->
                                <div class="pt-2 border-t border-slate-100 dark:border-slate-700/60 grid grid-cols-3 gap-1.5 text-center text-slate-600 dark:text-slate-300 text-[11px] font-medium">
                                    <div class="bg-slate-50 dark:bg-slate-900/60 p-2 rounded-xl border border-slate-100 dark:border-slate-700/50">
                                        <i class="fa-solid fa-bed text-indigo-600 dark:text-indigo-400 block mb-1 text-xs"></i> 
                                        <span>{{ $vivienda->recamaras }} Recámaras</span>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-900/60 p-2 rounded-xl border border-slate-100 dark:border-slate-700/50">
                                        <i class="fa-solid fa-house text-indigo-600 dark:text-indigo-400 block mb-1 text-xs"></i> 
                                        <span class="truncate block">{{ $vivienda->tipoVivienda?->nombre ?? 'Inmueble' }}</span>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-900/60 p-2 rounded-xl border border-slate-100 dark:border-slate-700/50">
                                        <i class="fa-solid fa-map-location-dot text-indigo-600 dark:text-indigo-400 block mb-1 text-xs"></i> 
                                        <span class="truncate block">{{ $vivienda->asentamiento?->tipo_asentamiento ?? 'Colonia' }}</span>
                                    </div>
                                </div>

                                <!-- LISTA DE AMENIDADES DESTACADAS (SI EXISTEN EN LA RELACIÓN) -->
                                @if($vivienda->amenidades && $vivienda->amenidades->count() > 0)
                                    <div class="pt-1 flex flex-wrap gap-1">
                                        @foreach($vivienda->amenidades->take(3) as $amenidad)
                                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-300 px-2 py-0.5 rounded-md border border-indigo-100 dark:border-indigo-900/50">
                                                <i class="fa-solid fa-circle-check text-[8px] text-indigo-500"></i>
                                                {{ $amenidad->nombre }}
                                            </span>
                                        @endforeach
                                        @if($vivienda->amenidades->count() > 3)
                                            <span class="text-[10px] font-bold text-slate-400 self-center pl-1">
                                                +{{ $vivienda->amenidades->count() - 3 }} más
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- CTA PRINCIPAL SOLICITAR PRECIO / INFORMES POR WHATSAPP -->
                        <div class="px-5 pb-5 pt-2">
                            <a href="https://wa.me/522292433841?text={{ $msjWa }}" 
                            target="_blank" 
                            class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2.5 rounded-xl text-xs flex items-center justify-center gap-2 transition shadow-sm hover:shadow">
                                <i class="fa-brands fa-whatsapp text-base"></i>
                                <span>Solicitar Precio / Informes</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white dark:bg-slate-800 p-12 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 text-center space-y-3">
                        <i class="fa-solid fa-house-circle-xmark text-4xl text-slate-400"></i>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">No se encontraron propiedades</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Intenta modificar los filtros aplicados para obtener resultados.</p>
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