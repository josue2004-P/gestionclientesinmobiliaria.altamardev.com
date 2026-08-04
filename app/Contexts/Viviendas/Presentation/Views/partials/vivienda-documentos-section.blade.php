<div class="pt-6 mt-6 border-t-2 border-dashed border-gray-200 dark:border-gray-800">
    <div class="mb-5">
        <span class="block text-sm font-extrabold uppercase tracking-tight text-gray-900 dark:text-white">
            Expediente Digital Transaccional
        </span>
        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5">
            Adjunte archivos legibles (PDF, PNG, JPG). Los documentos se procesarán al guardar la propiedad.
        </p>
    </div>

    {{-- Formulario para encolar archivo --}}
    <div class="p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/40 dark:bg-gray-900/20 mb-5 rounded-xl shadow-2xs">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            
            {{-- Clasificación --}}
            <div class="md:col-span-4">
                <x-shared::form.input-label for="temporalTipo" :value="__('Clasificación del Documento')" required />
                <div class="mt-1.5">
                    <x-shared::form.input-select 
                        id="temporalTipo"
                        wire:model="temporalTipo" 
                        placeholder="-- Clasificar archivo --" 
                        :messages="$errors->get('temporalTipo')"
                    >
                        @foreach($tiposDisponibles as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-shared::form.input-select>
                </div>
            </div>

            {{-- Componente File Input --}}
            <div class="md:col-span-5">
                <x-shared::form.file-input
                    id="temporalFile"
                    wire:model="temporalFile"
                    label="Seleccionar Archivo Físico"
                    :file="$temporalFile"
                    accept=".pdf,.png,.jpg,.jpeg"
                    :messages="$errors->get('temporalFile')"
                />
            </div>

            {{-- Botón Agregar --}}
            <div class="md:col-span-3">
                <x-shared::form.button-form
                    type="button"
                    variant="primary"
                    wire:click="addDocumento"
                    wire:loading.attr="disabled"
                    wire:target="temporalFile, addDocumento"
                    class="w-full h-11 justify-center"
                >
                    <i class="fa-solid fa-plus text-sm" wire:loading.remove wire:target="temporalFile, addDocumento"></i>
                    <i class="fa-solid fa-spinner animate-spin text-sm" wire:loading wire:target="temporalFile, addDocumento"></i>
                    <span wire:loading.remove wire:target="temporalFile, addDocumento">Agregar a la Lista</span>
                    <span wire:loading wire:target="temporalFile, addDocumento">Cargando...</span>
                </x-shared::form.button-form>
            </div>
        </div>
    </div>

    {{-- Listado de Documentos --}}
    @if(count($documentos) > 0)
        <div class="border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800 rounded-xl overflow-hidden shadow-2xs">
            @foreach($documentos as $index => $doc)
                <div class="p-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs" wire:key="doc-item-{{ $index }}">
                    
                    <div class="flex items-center gap-3 min-w-0 flex-1">
                        <div class="p-2.5 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 shrink-0">
                            <i class="fa-solid fa-file-pdf text-lg"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <span class="block font-bold text-gray-900 dark:text-white truncate">
                                {{ $doc['nombre_original'] }}
                            </span>
                            <div class="flex flex-wrap items-center gap-2 mt-1 text-[11px] text-gray-500 dark:text-gray-400 font-medium">
                                <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-800 rounded-md text-gray-700 dark:text-gray-300 font-bold uppercase tracking-wider text-[10px]">
                                    {{ $tiposDisponibles[$doc['tipo_documento']] ?? $doc['tipo_documento'] }}
                                </span>
                                <span>•</span>
                                <span>{{ round(($doc['peso_bytes'] ?? 0) / 1024, 2) }} KB</span>
                                <span>•</span>
                                @if(!empty($doc['id']))
                                    <span class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check"></i> En Servidor
                                    </span>
                                @else
                                    <span class="text-amber-600 dark:text-amber-400 font-bold flex items-center gap-1">
                                        <i class="fa-solid fa-clock"></i> Pendiente por Guardar
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 self-end sm:self-center shrink-0">
                        
                        {{-- CASO 1: Documento ya guardado en la Base de Datos --}}
                        @if(!empty($doc['id']))
                            <x-shared::form.button-form
                                type="a"
                                :href="route('viviendas.documentos.download', $doc['id'])"
                                target="_blank"
                                variant="secondary"
                                class="h-9 px-3"
                                title="Ver en nueva pestaña"
                            >
                                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </x-shared::form.button-form>

                        {{-- CASO 2: Documento temporal en proceso de carga --}}
                        @elseif(isset($doc['file_instance']) && is_object($doc['file_instance']) && method_exists($doc['file_instance'], 'temporaryUrl'))
                            @php
                                $tempUrl = null;
                                try {
                                    $tempUrl = $doc['file_instance']->temporaryUrl();
                                } catch (\Throwable $e) {
                                    $tempUrl = null;
                                }
                            @endphp

                            @if($tempUrl)
                                <x-shared::form.button-form
                                    type="a"
                                    :href="$tempUrl"
                                    target="_blank"
                                    variant="secondary"
                                    class="h-9 px-3"
                                    title="Previsualizar archivo temporal"
                                >
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </x-shared::form.button-form>
                            @endif
                        @endif

                        {{-- Botón Quitar / Eliminar --}}
                        <x-shared::form.button-form
                            type="button"
                            variant="danger"
                            wire:click="removeDocumento({{ $index }})"
                            class="h-9 px-3"
                            title="Quitar de la lista"
                        >
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </x-shared::form.button-form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/10 rounded-xl text-xs font-medium text-gray-500 dark:text-gray-400">
            <i class="fa-solid fa-folder-open text-2xl block mb-2 text-gray-300 dark:text-gray-700"></i>
            No se han anexado documentos digitales a este expediente todavía.
        </div>
    @endif
</div>