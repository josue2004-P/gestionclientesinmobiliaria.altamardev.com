<div>
    <x-shared::common.header 
        title="Catálogo de Asentamientos" 
        icon="fa-map-marked-alt"
        desc="Catálogo de colonias, fraccionamientos y asentamientos registrados"
        :breadcrumb="[
            ['label' => 'Inicio', 'url' => route('dashboard')],
            ['label' => 'Catálogo de Asentamientos', 'url' => null]
        ]"
    />
    <x-shared::form.table-filters 
        title="Control de Ubicaciones"
        :search="$search"
        :perPage="$perPage"
        :createRoute="route('asentamientos.create')"
    >
        <x-slot:filters>
        </x-slot:filters>

        <x-slot:actions>
            <div class="flex flex-col items-end gap-1" 
                x-data="{ uploading: false }" 
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-cancel="uploading = false"
                wire:key="asentamientos-import-container">
                
                <div class="flex items-center gap-2 rounded-md bg-gray-100/80 p-1 dark:bg-white/[0.03] border-t border-b border-gray-200 dark:border-gray-800 transition-colors h-[46px] px-2">
                    
                    {{-- Input encapsulado --}}
                    <label 
                        :class="{ 'opacity-50 cursor-not-allowed pointer-events-none': uploading }"
                        class="flex items-center justify-center px-3 h-9 text-xs font-bold uppercase hover:bg-white dark:hover:bg-gray-850 text-gray-600 dark:text-gray-400 cursor-pointer transition-all rounded-md select-none">

                        <i class="fa-solid fa-circle-notch animate-spin text-indigo-500 mr-2" x-show="uploading" x-cloak></i>
                        <i class="fa-solid fa-file-excel text-green-600 dark:text-green-400 mr-2" x-show="!uploading"></i>

                        <span class="max-w-[120px] truncate">
                            <template x-if="uploading">
                                <span>Subiendo...</span>
                            </template>
                            <template x-if="!uploading">
                                <span>
                                    @if($excelFile)
                                        ¡Excel Listo!
                                    @else
                                        Seleccionar XLS
                                    @endif
                                </span>
                            </template>
                        </span>

                        <input type="file" wire:model="excelFile" class="hidden" accept=".xls,.xlsx" :disabled="uploading" />
                    </label>

                    @if($excelFile && !$errors->has('excelFile'))
                        <button type="button" 
                                wire:click="import" 
                                x-bind:disabled="uploading"
                                class="inline-flex h-9 items-center justify-center rounded-xl bg-indigo-600 hover:bg-indigo-700 px-4 text-xs font-black uppercase tracking-wider text-white transition-all shadow-xs disabled:opacity-50 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled"
                                wire:target="import, executeImport">
                            
                            <i class="fa-solid fa-arrow-up-from-bracket mr-1.5" wire:loading.remove wire:target="import, executeImport"></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-1.5" wire:loading wire:target="import, executeImport"></i>
                            <span>Procesar</span>
                        </button>
                    @endif
                </div>

                {{-- Contenedor de Error con limpieza estable --}}
                @error('excelFile')
                    <div class="flex items-center gap-1.5 mt-1 bg-red-50 dark:bg-red-950/20 px-2 py-1 rounded-lg border border-red-150 dark:border-red-900/40">
                        <span class="text-[10px] font-black text-red-650 dark:text-red-400 uppercase tracking-wide">
                            <i class="fa-solid fa-circle-exclamation mr-0.5"></i> {{ $message }}
                        </span>
                        
                        <button type="button" 
                                wire:click="$set('excelFile', null)" 
                                class="text-red-400 hover:text-red-700 dark:text-red-500 dark:hover:text-red-300 text-[10px] font-bold ml-1 uppercase select-none cursor-pointer">
                            [Limpiar]
                        </button>
                    </div>
                @enderror
            </div>
        </x-slot:actions>

        <div class="overflow-x-auto bg-transparent rounded-none border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-900/40 transition-colors divide-x divide-gray-200 dark:divide-gray-800 border-b border-gray-200 dark:border-gray-800">
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">C.P.</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Asentamiento / Colonia</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Municipio / Del.</th>
                        <th scope="col" class="px-6 py-4 text-start text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Estado</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase dark:text-gray-400 tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-transparent">
                    @forelse($asentamientos as $asentamiento)
                        <tr class="group hover:bg-gray-50/80 dark:hover:bg-indigo-500/5 transition-all duration-200 divide-x divide-gray-200 dark:divide-gray-800" wire:key="asentamiento-{{ $asentamiento->id }}">
                            
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm font-bold text-indigo-600 dark:text-indigo-400 ">
                                {{ $asentamiento->codigo_postal }}
                            </td>
                            
                            <td class="px-6 py-2 whitespace-nowrap ">
                                <div class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">{{ $asentamiento->nombre_asentamiento }}</div>
                                <div class="text-[10px] font-extrabold text-gray-400 dark:text-gray-550 uppercase tracking-widest mt-0.5">{{ $asentamiento->tipo_asentamiento }}</div>
                            </td>
                            
                            <td class="px-6 py-2 whitespace-nowrap text-sm font-semibold text-gray-600 dark:text-gray-300 ">
                                {{ $asentamiento->municipio }} 
                                @if($asentamiento->ciudad) 
                                    <span class="text-xs text-gray-400 dark:text-gray-550 font-medium">({{ $asentamiento->ciudad }})</span> 
                                @endif
                            </td>
                            
                            <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-700 dark:text-gray-400 ">
                                {{ $asentamiento->estado }}
                            </td>
                            
                            {{-- Acciones (Dropdown con Teleport para Asentamientos) --}}
                            <x-shared::form.dropdown-actions title="Opciones">
                                
                                {{-- Enlace Editar --}}
                                <x-shared::form.dropdown-item 
                                    :href="route('asentamientos.edit', $asentamiento->id)" 
                                    icon="fa-solid fa-pen-to-square"
                                >
                                    Editar Asentamiento
                                </x-shared::form.dropdown-item>

                                <div class="my-1 border-t border-gray-100 dark:border-gray-800"></div>

                                {{-- Botón Eliminar --}}
                                <x-shared::form.dropdown-item 
                                    wire:click="confirmDelete({{ $asentamiento->id }})" 
                                    icon="fa-solid fa-trash-can" 
                                    variant="danger"
                                >
                                    Eliminar Asentamiento
                                </x-shared::form.dropdown-item>

                            </x-shared::form.dropdown-actions>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center ">
                                <div class="flex flex-col items-center">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4 border border-gray-200 dark:border-gray-800 transition-colors shadow-xs">
                                        <i class="fa-solid fa-earth-lines text-2xl text-gray-300 dark:text-gray-700"></i>
                                    </div>
                                    <h3 class="text-base font-extrabold text-gray-900 dark:text-white uppercase tracking-tight transition-colors">Sin Asentamientos</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 transition-colors">No se encontraron ubicaciones geográficas bajo los parámetros ingresados.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($asentamientos->hasPages())
            <div class="px-6 py-5 bg-transparent border-t border-gray-200 dark:border-gray-800 transition-colors duration-200">
                {{ $asentamientos->links() }}
            </div>
        @endif
    </x-shared::form.table-filters>
</div>