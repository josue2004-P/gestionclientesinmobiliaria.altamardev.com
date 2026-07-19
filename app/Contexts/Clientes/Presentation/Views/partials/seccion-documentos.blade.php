<div class="md:col-span-3 pt-6 mt-6 border-t border-dashed border-gray-200 dark:border-gray-800" wire:key="cliente-documentos-modulo-{{ $clienteId }}">
    <div>
        <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Expediente Digitalizado (1:N)</span>
        <p class="text-xs text-gray-400 dark:text-gray-550 font-medium mb-4">Adjunte y clasifique las identificaciones y constancias oficiales del comprador para agilizar la validación del expediente.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 bg-gray-50 dark:bg-gray-900/40 p-4 border border-gray-200 dark:border-gray-800 rounded-none items-end mb-4" wire:key="panel-upload-container">
        <div class="md:col-span-5">
            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1.5">Seleccionar Archivo</label>
            <div class="flex items-center gap-2 bg-white dark:bg-gray-950 px-2 border border-gray-200 dark:border-gray-800 h-11">
                <input type="file" wire:model="temporalFile" class="w-full text-xs font-semibold text-gray-550 file:mr-2 file:py-1 file:px-2 file:border-0 file:text-[10px] file:font-bold file:bg-gray-100 dark:file:bg-gray-800 file:text-gray-700 dark:file:text-gray-300 hover:file:bg-gray-200 outline-none" />
                
                @if ($temporalFile)
                    @try {
                        <a href="{{ $temporalFile->temporaryUrl() }}" target="_blank" class="px-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors text-xs font-bold shrink-0 flex items-center gap-1" title="Ver archivo temporal cargado">
                            <i class="fa-solid fa-eye animate-pulse"></i> <span class="text-[10px] font-bold uppercase tracking-wider">Ver</span>
                        </a>
                    } @catch (\Exception $e) {
                        <span class="text-[10px] text-gray-400 uppercase font-mono px-2 shrink-0">📎 Listo</span>
                    }
                @endif
            </div>
            <x-shared::form.input-error :messages="$errors->get('temporalFile')" class="mt-1" />
        </div>

        <div class="md:col-span-4">
            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1.5">Clasificación del Documento</label>
            <x-shared::form.input-select id="temporalTipo" wire:model="temporalTipo">
                <option value="">-- SELECCIONAR CLASE --</option>
                @foreach($tiposDisponibles as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </x-shared::form.input-select>
            <x-shared::form.input-error :messages="$errors->get('temporalTipo')" class="mt-1" />
        </div>

        <div class="md:col-span-3">
            <button type="button" wire:click="addDocumento" class="w-full h-11 text-xs font-bold uppercase bg-indigo-600 text-white hover:bg-indigo-700 transition-colors shadow-xs flex items-center justify-center" wire:loading.attr="disabled" wire:target="temporalFile, addDocumento">
                <i class="fa-solid fa-cloud-arrow-up mr-2" wire:loading.remove wire:target="addDocumento"></i>
                <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading wire:target="temporalFile, addDocumento"></i>
                <span>Subir Documento</span>
            </button>
        </div>
    </div>

    <div class="space-y-3">
        @foreach($documentos as $index => $doc)
            <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950/20" 
                wire:key="documento-row-{{ $index }}-{{ $doc['id'] ?? 'new' }}">
                
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center text-indigo-650 dark:text-indigo-400 text-sm">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-gray-900 dark:text-white">
                            {{ $tiposDisponibles[$doc['tipo_documento']] ?? $doc['tipo_documento'] }}
                        </span>
                        <span class="block text-[10px] text-gray-400 font-mono tracking-tight">
                            {{ $doc['nombre_original'] }} ({{ round($doc['peso_bytes'] / 1024, 2) }} KB)
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if($doc['verificado'])
                        <span class="px-2 py-0.5 rounded-sm bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400 text-[10px] font-bold uppercase">
                            ✓ Verificado
                        </span>
                    @else
                        <span class="px-2 py-0.5 rounded-sm bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-400 text-[10px] font-bold uppercase">
                            ⚠️ Pendiente
                        </span>
                    @endif

                    <div class="flex items-center gap-1">
                        <a href="{{ route('clientes.documentos.ver', ['path' => $doc['url']]) }}" 
                        target="_blank" 
                        class="p-2 text-gray-400 hover:text-indigo-600 transition-colors" 
                        title="Visualizar Documento">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>
                        <button type="button" wire:click="removeDocumento({{ $index }})" class="p-2 text-gray-400 hover:text-red-500 transition-colors" title="Retirar del Expediente">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($documentos) === 0)
            <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/10 text-xs font-medium text-gray-400 dark:text-gray-550" wire:key="documentos-vacio-{{ $clienteId }}">
                <i class="fa-solid fa-folder-open text-lg block mb-1 text-gray-300 dark:text-gray-700"></i> 
                El expediente no contiene archivos digitalizados vinculados.
            </div>
        @endif
    </div>
</div>