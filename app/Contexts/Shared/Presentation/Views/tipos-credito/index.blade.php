<div>
    <x-shared::common.header 
        title="Catálogo de Tipos de Créditos" 
        icon="fa-file-invoice-dollar"
        desc="Catálogo y administración de los tipos de créditos financieros y de vivienda"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Tipos de Créditos', 'url' => null]
        ]"
    />
    <x-shared::form.table-filters 
        title="Tipos de Crédito"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('tipos-credito.create')"
    >
        <x-slot:filters>
            {{-- Espacio libre para filtros rápidos --}}
        </x-slot:filters>

        <div class="overflow-x-auto bg-transparent rounded-none border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Crédito Financiero</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Aplica Vivienda</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Aplica Cliente</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($creditos as $credito)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="credito-{{ $credito->id }}">
                            
                            {{-- Crédito Financiero --}}
                            <td class="px-6 py-2 ">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">{{ $credito->nombre }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5">{{ $credito->descripcion ?? 'Sin descripción añadida' }}</div>
                            </td>
                            
                            {{-- Aplica Vivienda --}}
                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                @if($credito->aplica_vivienda)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20">Sí</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-50 text-gray-600 dark:bg-gray-500/10 dark:text-gray-400 border border-gray-100 dark:border-gray-500/20">No</span>
                                @endif
                            </td>

                            {{-- Aplica Cliente --}}
                            <td class="px-6 py-2 text-center whitespace-nowrap ">
                                @if($credito->aplica_cliente)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20">Sí</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-50 text-gray-600 dark:bg-gray-500/10 dark:text-gray-400 border border-gray-100 dark:border-gray-500/20">No</span>
                                @endif
                            </td>
                            
                            {{-- Acciones --}}
                            <td class="px-6 py-2 text-center whitespace-nowrap z-30 ">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('tipos-credito.edit', $credito->id) }}" class="p-2 rounded-xl text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-pen-to-square text-base"></i>
                                    </a>
                                    
                                    <button type="button" wire:click="confirmDelete({{ $credito->id }})" class="p-2 rounded-xl text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all shadow-xs">
                                        <i class="fa-solid fa-trash-can text-base"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 shadow-xs">
                                        <i class="fa-solid fa-credit-card text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight">Sin Registros</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No se encontraron esquemas de créditos configurados en el sistema.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($creditos->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $creditos->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>