<div>
    <x-shared::form.table-filters title="Control de Amenidades" :search="$search" :perPage="$perPage" :createRoute="route('amenidades.create')">
        <x-slot:filters>
            {{-- Espacio libre para filtros rápidos --}}
        </x-slot:filters>
        <div class="overflow-x-auto bg-transparent rounded-none border border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Nombre de la Amenidad</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($amenidades as $amenidad)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-100 dark:divide-gray-800" wire:key="amenidad-{{ $amenidad->id }}">
                            <td class="px-6 py-4 border-l border-r border-gray-150 dark:border-gray-855">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">{{ $amenidad->nombre }}</div>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap z-30 border-l border-r border-gray-150 dark:border-gray-855">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('amenidades.edit', $amenidad->id) }}" class="p-2 rounded-xl text-gray-400 hover:text-indigo-600 transition-all shadow-xs"><i class="fa-solid fa-pen-to-square text-base"></i></a>
                                    <button type="button" wire:click="confirmDelete({{ $amenidad->id }})" class="p-2 rounded-xl text-gray-400 hover:text-red-600 transition-all shadow-xs"><i class="fa-solid fa-trash-can text-base"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-20 text-center border-l border-r border-gray-150 dark:border-gray-855">
                                <div class="flex flex-col items-center"><h3 class="text-base font-extrabold text-gray-900 dark:text-white">Sin Registros</h3></div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($amenidades->hasPages()) <div class="px-6 py-5 bg-transparent border-t border border-gray-200 dark:border-gray-800">{{ $amenidades->links() }}</div> @endif
    </x-shared::form.table-filters>
</div>