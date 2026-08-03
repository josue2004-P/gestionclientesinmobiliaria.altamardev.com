<div>
    {{-- Encabezado --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
            <i class="fa-solid fa-folder-closed mr-2"></i>Expediente Digitalizado (1:N)
        </h3>
    </div>

    {{-- Panel de Carga --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 bg-gray-50/50 dark:bg-gray-900/40 p-4 border border-gray-100 dark:border-gray-800/60 rounded-xl items-end mb-6">
        
        {{-- Seleccionar Archivo --}}
        <div class="md:col-span-5">
            <x-shared::form.file-input 
                id="file_upload_input" 
                wire:model="temporalFile"
                :label="__('Seleccionar Archivo')"
                :required="true"
                accept=".pdf,.png,.jpg,.jpeg"
                :messages="$errors->get('temporalFile')"
            />
        </div>

        {{-- Clasificación del Documento --}}
        <div class="md:col-span-4">
            <x-shared::form.input-label for="temporalTipo" :value="__('Clasificación del Documento')" required />
            <div class="mt-1.5">
                <x-shared::form.input-select id="temporalTipo" wire:model="temporalTipo" placeholder="-- SELECCIONAR CLASE --">
                    @foreach($tiposDisponibles as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </x-shared::form.input-select>
            </div>
            <x-shared::form.input-error :messages="$errors->get('temporalTipo')" class="mt-2" />
        </div>

        {{-- Botón Subir Documento con indicador de carga --}}
        <div class="md:col-span-3">
            <x-shared::form.button-form 
                type="button" 
                wire:click="addDocumento" 
                variant="primary" 
                class="w-full h-11"
                wire:loading.attr="disabled" 
                wire:target="temporalFile, addDocumento"
            >
                <i class="fa-solid fa-cloud-arrow-up text-sm" wire:loading.remove wire:target="addDocumento"></i>
                <i class="fa-solid fa-circle-notch animate-spin text-sm" wire:loading wire:target="temporalFile, addDocumento"></i>
                <span>Subir Documento</span>
            </x-shared::form.button-form>
        </div>
    </div>

    {{-- Lista de Documentos Cargados --}}
    <div class="space-y-3">
        @foreach($documentos as $index => $doc)
            <div class="flex items-center justify-between p-3.5 border border-gray-100 dark:border-gray-800/60 bg-gray-50/50 dark:bg-gray-900/40 rounded-xl transition-all duration-150" 
                wire:key="doc-item-{{ $index }}-{{ $doc['id'] ?? 'new' }}">
                
                {{-- Info del archivo --}}
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-50 dark:bg-indigo-500/10 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-sm shrink-0">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-gray-800 dark:text-white/90">
                            {{ $tiposDisponibles[$doc['tipo_documento']] ?? $doc['tipo_documento'] }}
                        </span>
                        <span class="block text-[11px] text-gray-400 dark:text-gray-500 font-mono tracking-tight mt-0.5">
                            {{ $doc['nombre_original'] }} ({{ round($doc['peso_bytes'] / 1024, 2) }} KB)
                        </span>
                    </div>
                </div>

                {{-- Acciones y Estado --}}
                <div class="flex items-center gap-3">
                    @if(!empty($doc['verificado']))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20 text-[10px] font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Verificado
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20 text-[10px] font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-triangle-exclamation text-[10px]"></i> Pendiente
                        </span>
                    @endif

                    <div class="flex items-center gap-1.5">
                        @if(!empty($doc['url']))
                            <a href="{{ route('clientes.documentos.ver', ['path' => $doc['url']]) }}" 
                               target="_blank" 
                               class="inline-flex items-center justify-center h-9 w-9 rounded-lg bg-white text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 border border-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-indigo-400 dark:border-gray-700 dark:hover:bg-gray-700 transition-colors" 
                               title="Visualizar Documento">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                        @endif

                        <x-shared::form.button-form 
                            type="button" 
                            wire:click="removeDocumento({{ $index }})" 
                            variant="danger" 
                            size="sm"
                            class="h-9 px-2.5"
                            title="Retirar del Expediente"
                        >
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </x-shared::form.button-form>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($documentos) === 0)
            <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/20 rounded-xl text-xs font-medium text-gray-400 dark:text-gray-500">
                <i class="fa-solid fa-folder-open text-xl block mb-2 text-gray-300 dark:text-gray-700"></i> 
                El expediente no contiene archivos digitalizados vinculados.
            </div>
        @endif
    </div>
</div>