<div>
    {{-- Header de la Sección --}}
    <x-shared::common.header 
        title="Catálogo de Clientes" 
        icon="fa-address-book"
        desc="Administración de expedientes de clientes, información de contacto y zonas de interés"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Control de Clientes', 'url' => null]
        ]"
    />

    <x-shared::form.table-filters 
        title="Control de Clientes"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('clientes.create')"
    >
        <x-slot:filters>
            {{-- Espacio para filtros --}}
        </x-slot:filters>

        <div class="border-t border-gray-200 dark:border-gray-800">
            
            {{-- ================================================= --}}
            {{-- 1. VISTA MÓVIL: GRID DE CARDS (Oculto en Escritorio) --}}
            {{-- ================================================= --}}
            <div class="block md:hidden p-4 space-y-4 bg-gray-50/50 dark:bg-gray-950/20">
                @forelse($clientes as $cliente)
                    <div wire:key="cliente-card-{{ $cliente->id }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-2xs dark:border-gray-800 dark:bg-gray-900 space-y-3">
                        
                        {{-- Cabecera Card: Cliente y Acciones --}}
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-extrabold text-sm shrink-0">
                                    {{ strtoupper(substr($cliente->nombre, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-gray-900 dark:text-white capitalize">
                                        {{ $cliente->nombre }} {{ $cliente->apellido_paterno }}
                                    </h3>
                                    <div class="text-[11px] font-mono text-gray-500 dark:text-gray-400">
                                        NSS: {{ $cliente->nss ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            {{-- Botones Rápidos --}}
                            <div class="flex items-center gap-1 shrink-0">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    <i class="fa-solid fa-user-pen text-sm"></i>
                                </a>
                                @if(checkPermiso('clientes.is_update'))
                                    <button type="button" wire:click="confirmDelete({{ $cliente->id }})" class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400">
                                        <i class="fa-solid fa-user-slash text-sm"></i>
                                    </button>
                                @endif
                            </div>
                        </div>

                        {{-- Teléfonos Directos --}}
                        <div class="pt-2 border-t border-gray-100 dark:border-gray-800">
                            <span class="text-[10px] font-black uppercase text-gray-400 block mb-1">Teléfonos</span>
                            <div class="flex flex-wrap gap-2">
                                @forelse($cliente->telefonos as $tel)
                                    <a href="tel:{{ $tel->telefono }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 font-mono text-xs font-bold">
                                        <i class="fa-solid fa-phone text-[9px]"></i>
                                        <span>{{ $tel->telefono }}</span>
                                    </a>
                                @empty
                                    <span class="text-xs text-gray-400 italic">Sin teléfonos</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Zonas de Interés --}}
                        @if($cliente->zonasInteres->count() > 0)
                            <div class="pt-2 border-t border-gray-100 dark:border-gray-800">
                                <span class="text-[10px] font-black uppercase text-gray-400 block mb-1">Zonas de Interés</span>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($cliente->zonasInteres as $zona)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                                            C.P. {{ $zona->codigo_postal }} - {{ $zona->nombre_asentamiento }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="py-10 text-center text-xs text-gray-500">Sin clientes registrados.</div>
                @endforelse
            </div>

            {{-- ================================================= --}}
            {{-- 2. VISTA ESCRITORIO: TABLA (Oculto en Móviles)    --}}
            {{-- ================================================= --}}
            <div class="hidden md:block overflow-x-auto bg-transparent">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-900/40 divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                            <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Cliente / Expediente</th>
                            <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Teléfonos Directos</th>
                            <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Zonas de Interés</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                        @forelse($clientes as $cliente)
                            <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="cliente-table-{{ $cliente->id }}">
                                
                                {{-- Cliente --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900 dark:text-white capitalize">
                                        {{ $cliente->nombre }} {{ $cliente->apellido_paterno }} {{ $cliente->apellido_materno }}
                                    </div>
                                    <div class="text-[11px] font-mono text-gray-500 dark:text-gray-400">
                                        NSS: {{ $cliente->nss ?? 'N/A' }} | CURP: {{ $cliente->curp ?? 'N/A' }}
                                    </div>
                                </td>

                                {{-- Teléfonos --}}
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @forelse($cliente->telefonos as $tel)
                                            <a href="tel:{{ $tel->telefono }}" class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                                <i class="fa-solid fa-phone text-[9px]"></i> {{ $tel->telefono }}
                                            </a>
                                        @empty
                                            <span class="text-xs text-gray-400 italic">Sin teléfonos</span>
                                        @endforelse
                                    </div>
                                </td>

                                {{-- Zonas --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1 max-w-xs">
                                        @forelse($cliente->zonasInteres as $zona)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-500/20">
                                                C.P. {{ $zona->codigo_postal }} - {{ $zona->nombre_asentamiento }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-gray-400 italic">Sin zonas</span>
                                        @endforelse
                                    </div>
                                </td>

                                {{-- Acciones --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="p-2 rounded-xl text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10">
                                            <i class="fa-solid fa-user-pen text-base"></i>
                                        </a>
                                        @if(checkPermiso('clientes.is_update'))
                                            <button type="button" wire:click="confirmDelete({{ $cliente->id }})" class="p-2 rounded-xl text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10">
                                                <i class="fa-solid fa-user-slash text-base"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-xs text-gray-500">Sin clientes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{-- Paginación --}}
        @if($clientes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-800">
                {{ $clientes->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>