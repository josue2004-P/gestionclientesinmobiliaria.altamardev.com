<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Modificar Expediente de Cliente" 
        icon="fa-user-pen"
        desc="Edita los datos generales, capacidad de compra o información de localización del comprador."
        :breadcrumb="[
            ['label' => 'Clientes', 'url' => route('clientes.index')],
            ['label' => 'Editar Cliente', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit.prevent="save">
            <x-shared::common.component-card 
                title="Actualizar Datos del Comprador" 
                desc="Edite los campos necesarios. Los cambios se verán reflejados inmediatamente en las bitácoras comerciales." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="space-y-8">
                    
                    {{-- SECCIÓN: DATOS PERSONALES --}}
                    <div>
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">
                            <i class="fa-solid fa-user mr-2"></i>Información Personal
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-shared::form.input-label for="nombre" :value="__('Nombre(s)')" required/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="nombre" type="text" wire:model="nombre" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="apellido_paterno" :value="__('Apellido Paterno')" required/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="apellido_paterno" type="text" wire:model="apellido_paterno" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="apellido_materno" :value="__('Apellido Materno')" required/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="apellido_materno" type="text" wire:model="apellido_materno" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                            </div>

                            <div wire:key="cliente-datepicker-{{ $clienteId }}" wire:ignore>
                                <x-shared::form.input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.date-picker id="fecha_nacimiento" wire:model="fecha_nacimiento" placeholder="Selecciona la fecha" :messages="$errors->get('fecha_nacimiento')" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="estado_civil" :value="__('Estado Civil')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.input-select id="estado_civil" wire:model.live="estado_civil" placeholder="-- SELECCIONAR --" :messages="$errors->get('estado_civil')">
                                        <option value="Soltero">Soltero/a</option>
                                        <option value="Casado">Casado/a</option>
                                        <option value="Divorciado">Divorciado/a</option>
                                        <option value="Viudo">Viudo/a</option>
                                        <option value="Union_Libre">Unión Libre</option>
                                    </x-shared::form.input-select>
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('estado_civil')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="regimen_casamiento" :value="__('Régimen Patrimonial')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="regimen_casamiento" type="text" wire:model="regimen_casamiento" :disabled="$estado_civil !== 'Casado'" class="w-full font-medium disabled:bg-gray-100 dark:disabled:bg-gray-900 transition-colors" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('regimen_casamiento')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN DE CONTACTOS / TELÉFONOS RELACIONADOS (1:N) --}}
                    <div class="md:col-span-3 pt-6 mt-4 border-t border-dashed border-gray-200 dark:border-gray-800" wire:key="cliente-telefonos-modulo-{{ $clienteId }}">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Directorio de Contacto (1:N)</span>
                                <p class="text-xs text-gray-400 dark:text-gray-550 font-medium">Asigne los números telefónicos principales y alternos para el seguimiento comercial.</p>
                            </div>
                            {{-- Botón reactivo conectado a Livewire --}}
                            <button type="button" wire:click="addTelefono" class="inline-flex items-center justify-center px-3 h-9 text-xs font-bold uppercase border border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 rounded-none transition-colors">
                                <i class="fa-solid fa-plus mr-2 text-indigo-600"></i> Añadir Teléfono
                            </button>
                        </div>

                        <div class="space-y-4">
                            @foreach($telefonos as $index => $item)
                                {{-- 🟢 EL WIRE:KEY DE CADA FILA COMBINA EL ÍNDICE Y EL ID PARA QUE MORPHDOM NO SE CONFUNDA --}}
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/10 relative rounded-none" 
                                    wire:key="telefono-row-{{ $index }}-{{ $item['id'] ?? 'new' }}">
                                    
                                    <input type="hidden" wire:model="telefonos.{{ $index }}.id">

                                    {{-- Campo: Número Registrado --}}
                                    <div class="md:col-span-6">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Número de Teléfono</label>
                                        <x-shared::form.text-input 
                                            type="text" 
                                            wire:model="telefonos.{{ $index }}.telefono" 
                                            placeholder="10 dígitos (ej: 3312345678)" 
                                            class="w-full text-xs font-mono font-bold" 
                                        />
                                        <x-shared::form.input-error :messages="$errors->get('telefonos.'.$index.'.telefono')" class="mt-1" />
                                    </div>

                                    {{-- Campo: Tipo de Línea --}}
                                    <div class="md:col-span-4">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Tipo de Línea</label>
                                        <x-shared::form.input-select 
                                            id="tipo_telefono_{{ $index }}" 
                                            wire:model="telefonos.{{ $index }}.tipo_telefono"
                                            :messages="$errors->get('telefonos.'.$index.'.tipo_telefono')"
                                        >
                                            <option value="Celular">📱 Celular</option>
                                            <option value="Casa">🏠 Casa / Residencial</option>
                                            <option value="Trabajo">💼 Oficina / Trabajo</option>
                                        </x-shared::form.input-select>
                                    </div>

                                    {{-- Botón: Eliminar Fila --}}
                                    <div class="md:col-span-2 flex items-end justify-center pb-0.5">
                                        <button type="button" wire:click="removeTelefono({{ $index }})" class="h-11 w-full border border-red-200 dark:border-red-900/30 bg-red-50/50 hover:bg-red-100 text-red-650 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/50 transition-colors flex items-center justify-center rounded-none shadow-xs">
                                            <i class="fa-solid fa-trash-can text-xs mr-2"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                            @if(count($telefonos) === 0)
                                <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/10 text-xs font-medium text-gray-400 dark:text-gray-550" wire:key="telefonos-vacio-{{ $clienteId }}">
                                    <i class="fa-solid fa-phone-slash text-lg block mb-1 text-gray-300 dark:text-gray-700"></i> 
                                    El expediente comercial no contiene números telefónicos vinculados. Registre al menos uno.
                                </div>
                            @endif
                        </div>
                        
                        <x-shared::form.input-error :messages="$errors->get('telefonos')" class="mt-2" />
                    </div>

                    {{-- SECCIÓN: REFERENCIAS DEL COMPRADOR (1:N) --}}
                    <div class="md:col-span-3 pt-8 mt-6 border-t border-dashed border-gray-200 dark:border-gray-800" wire:key="cliente-referencias-modulo-{{ $clienteId }}">
                        
                        {{-- Encabezado con Layout de Foco --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="p-1.5 bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 text-xs font-bold">
                                        <i class="fa-solid fa-users-rectangle"></i>
                                    </span>
                                    <span class="text-xs font-black uppercase tracking-wider text-gray-900 dark:text-white">Contactos y Referencias de Aval</span>
                                </div>
                                <p class="text-[11px] text-gray-400 dark:text-gray-500 font-medium mt-1">Especifique el directorio de relaciones familiares o comerciales requeridos para el análisis de riesgo.</p>
                            </div>
                            
                            <button type="button" wire:click="addReferencia" class="inline-flex items-center justify-center px-4 h-9 text-xs font-bold uppercase border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 hover:bg-gray-50 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-300 rounded-none transition-colors shadow-2xs shrink-0">
                                <i class="fa-solid fa-plus mr-2 text-indigo-600 dark:text-indigo-400"></i> Añadir Referencia
                            </button>
                        </div>

                        {{-- Contenedor de Filas --}}
                        <div class="space-y-4">
                            @foreach($referencias as $index => $item)
                                <div class="border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-all duration-150 relative rounded-none shadow-2xs" 
                                    wire:key="referencia-row-{{ $index }}-{{ $item['id'] ?? 'new' }}">
                                    
                                    <input type="hidden" wire:model="referencias.{{ $index }}.id">

                                    {{-- Fila Primaria de Datos Rápidos --}}
                                    <div class="p-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                        
                                        {{-- Indicador numérico estético --}}
                                        <div class="hidden md:flex md:col-span-1 items-center justify-center font-mono text-xs font-bold text-gray-300 dark:text-gray-700">
                                            #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </div>

                                        {{-- Campo: Nombre Completo --}}
                                        <div class="md:col-span-4">
                                            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1.5">Nombre Completo</label>
                                            <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.nombre" placeholder="Nombre de la referencia" class="w-full text-xs font-bold rounded-none" />
                                            <x-shared::form.input-error :messages="$errors->get('referencias.'.$index.'.nombre')" class="mt-1" />
                                        </div>

                                        {{-- Campo: Celular --}}
                                        <div class="md:col-span-3">
                                            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1.5">Teléfono Celular</label>
                                            <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.celular" placeholder="10 dígitos" class="w-full text-xs font-mono font-bold tracking-wide rounded-none" />
                                            <x-shared::form.input-error :messages="$errors->get('referencias.'.$index.'.celular')" class="mt-1" />
                                        </div>

                                        {{-- Campo: Parentesco --}}
                                        <div class="md:col-span-3">
                                            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1.5">Vínculo / Relación</label>
                                            <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.parentesco" placeholder="Ej: Familiar, Comercial" class="w-full text-xs font-medium rounded-none" />
                                            <x-shared::form.input-error :messages="$errors->get('referencias.'.$index.'.parentesco')" class="mt-1" />
                                        </div>

                                        {{-- Acción: Eliminar --}}
                                        <div class="md:col-span-1 flex justify-end pt-3 md:pt-5">
                                            <button type="button" wire:click="removeReferencia({{ $index }})" class="h-9 w-9 border border-gray-200 hover:border-red-200 dark:border-gray-800 dark:hover:border-red-950/40 bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-600 dark:bg-gray-900 dark:hover:bg-red-950/20 dark:text-gray-550 dark:hover:text-red-400 transition-colors flex items-center justify-center rounded-none shadow-3xs" title="Remover Referencia">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Sub-Bloque Desplegable de Localización (Diseño Integrado) --}}
                                    <div class="px-4 pb-4 pt-3 border-t border-dashed border-gray-150 dark:border-gray-900 bg-gray-50/50 dark:bg-gray-900/20 grid grid-cols-1 md:grid-cols-12 gap-4">
                                        
                                        <div class="md:col-span-1 hidden md:flex items-center justify-center text-gray-300 dark:text-gray-700">
                                            <i class="fa-solid fa-map-location-dot text-xs"></i>
                                        </div>

                                        <div class="md:col-span-7">
                                            <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Calle y Número de Contacto</label>
                                            <x-shared::form.text-input type="text" wire:model="referencias.{{ $index }}.calle_numero" placeholder="Dirección completa del contacto (Calle, Num Ext, Num Int)" class="w-full text-xs bg-white dark:bg-gray-950 rounded-none" />
                                            <x-shared::form.input-error :messages="$errors->get('referencias.'.$index.'.calle_numero')" class="mt-1" />
                                        </div>

                                        <div class="md:col-span-4">
                                            <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Ubicación / Asentamiento</label>
                                            <x-shared::form.searchable-select wire:model="referencias.{{ $index }}.asentamiento_id" placeholder="-- BUSCAR ZONA --">
                                                <option value="">-- Sin asignar --</option>
                                                @foreach($asentamientos as $asentamiento)
                                                    <option value="{{ $asentamiento->getId() }}">
                                                        {{ $asentamiento->getNombreAsentamiento() }} (C.P. {{ $asentamiento->getCodigoPostal() }})
                                                    </option>
                                                @endforeach
                                            </x-shared::form.searchable-select>
                                            <x-shared::form.input-error :messages="$errors->get('referencias.'.$index.'.asentamiento_id')" class="mt-1" />
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            {{-- Estado de Arreglo Vacío Mejorado --}}
                            @if(count($referencias) === 0)
                                <div class="p-8 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/20 dark:bg-gray-950/10 text-xs font-medium text-gray-400 dark:text-gray-500" wire:key="referencias-vacio-{{ $clienteId }}">
                                    <i class="fa-solid fa-users-slash text-xl block mb-2 text-gray-300 dark:text-gray-700"></i> 
                                    El expediente no contiene referencias asignadas. Registre al menos un contacto.
                                </div>
                            @endif
                        </div>

                        <x-shared::form.input-error :messages="$errors->get('referencias')" class="mt-2" />
                    </div>

                    {{-- SECCIÓN: EXPEDIENTE DIGITAL / DOCUMENTOS RELACIONADOS (1:N) --}}
                    <div class="md:col-span-3 pt-6 mt-6 border-t border-dashed border-gray-200 dark:border-gray-800" wire:key="cliente-documentos-modulo-{{ $clienteId }}">
                        <div>
                            <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Expediente Digitalizado (1:N)</span>
                            <p class="text-xs text-gray-400 dark:text-gray-550 font-medium mb-4">Adjunte y clasifique las identificaciones y constancias oficiales del comprador para agilizar la validación del expediente.</p>
                        </div>

                        {{-- Panel de Carga Asíncrona --}}
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 bg-gray-50 dark:bg-gray-900/40 p-4 border border-gray-200 dark:border-gray-800 rounded-none items-end mb-4" wire:key="panel-upload-container">
                            
                            {{-- Input de Archivo --}}
                            <div class="md:col-span-5">
                                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1.5">Seleccionar Archivo</label>
                                <div class="flex items-center gap-2 bg-white dark:bg-gray-950 px-2 border border-gray-200 dark:border-gray-800 h-11">
                                    <input type="file" wire:model="temporalFile" class="w-full text-xs font-semibold text-gray-550 file:mr-2 file:py-1 file:px-2 file:border-0 file:text-[10px] file:font-bold file:bg-gray-100 dark:file:bg-gray-800 file:text-gray-700 dark:file:text-gray-300 hover:file:bg-gray-200 outline-none" />
                                    
                                    {{-- 🟢 PREVISUALIZADOR TEMPORAL: Se muestra solo si hay un archivo cargado en memoria listo para subir --}}
                                    @if ($temporalFile)
                                        @try {
                                            <a href="{{ $temporalFile->temporaryUrl() }}" target="_blank" class="px-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors text-xs font-bold shrink-0 flex items-center gap-1" title="Ver archivo temporal cargado">
                                                <i class="fa-solid fa-eye animate-pulse"></i> <span class="text-[10px] font-bold uppercase tracking-wider">Ver</span>
                                            </a>
                                        } @catch (\Exception $e) {
                                            {{-- Resguardo para archivos que no soportan temporaryUrl nativo (como PDFs pesados en ciertos drivers) --}}
                                            <span class="text-[10px] text-gray-400 uppercase font-mono px-2 shrink-0">📎 Listo</span>
                                        }
                                    @endif
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('temporalFile')" class="mt-1" />
                            </div>

                            {{-- Clasificación --}}
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

                            {{-- Botón de Acción --}}
                            <div class="md:col-span-3">
                                <button type="button" wire:click="addDocumento" class="w-full h-11 text-xs font-bold uppercase bg-indigo-600 text-white hover:bg-indigo-700 transition-colors shadow-xs flex items-center justify-center" wire:loading.attr="disabled" wire:target="temporalFile, addDocumento">
                                    <i class="fa-solid fa-cloud-arrow-up mr-2" wire:loading.remove wire:target="addDocumento"></i>
                                    <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading wire:target="temporalFile, addDocumento"></i>
                                    <span>Subir Documento</span>
                                </button>
                            </div>
                        </div>

                        {{-- Listado de Documentos en el Expediente --}}
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
                                        {{-- Badge de Verificación --}}
                                        @if($doc['verificado'])
                                            <span class="px-2 py-0.5 rounded-sm bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400 text-[10px] font-bold uppercase">
                                                ✓ Verificado
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-sm bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-400 text-[10px] font-bold uppercase">
                                                ⚠️ Pendiente
                                            </span>
                                        @endif

                                        {{-- Acciones Quirúrgicas --}}
                                        <div class="flex items-center gap-1">
                                            {{-- 🟢 MODIFICADO: Apunta a tu ruta limpia del controlador de Clientes para los ya guardados --}}
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

                    {{-- SECCIÓN: IDENTIFICACIONES Y CRÉDITO --}}
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-900">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">
                            <i class="fa-solid fa-credit-card mr-2"></i>Identificaciones y Capacidad Financiera
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-shared::form.input-label for="curp" :value="__('CURP')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="curp" type="text" wire:model="curp" class="w-full font-mono uppercase font-bold tracking-wide" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('curp')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="rfc" :value="__('RFC')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="rfc" type="text" wire:model="rfc" class="w-full font-mono uppercase font-bold tracking-wide" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('rfc')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="nss" :value="__('NSS (Seguro Social)')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="nss" type="text" wire:model="nss" class="w-full font-mono font-bold tracking-wide" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('nss')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                            <div class="md:col-span-2">
                                <x-shared::form.input-label for="correo_infonavit" :value="__('Correo Cuenta Infonavit')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="correo_infonavit" type="email" wire:model="correo_infonavit" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('correo_infonavit')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="contrasena_infonavit" :value="__('Contraseña Infonavit')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="contrasena_infonavit" type="password" wire:model="contrasena_infonavit" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('contrasena_infonavit')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="precalificacion" :value="__('Monto Precalificación ($)')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="precalificacion" type="number" step="0.01" wire:model="precalificacion" class="w-full font-mono font-bold" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('precalificacion')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <x-shared::form.input-label for="avaluo_solicitado" :value="__('¿Avalúo Solicitado?')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.input-select id="avaluo_solicitado" wire:model="avaluo_solicitado" :messages="$errors->get('avaluo_solicitado')">
                                        <option value="No">No</option>
                                        <option value="Sí">Sí</option>
                                    </x-shared::form.input-select>
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('avaluo_solicitado')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="tipo_credito_id" :value="__('Tipo de Crédito Tentativo')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.searchable-select wire:model="tipo_credito_id" placeholder="-- BUSCAR O SELECCIONAR CRÉDITO --" :messages="$errors->get('tipo_credito_id')">
                                        <option value="">-- No Asignado --</option>
                                        @foreach($tiposCredito as $tipo)
                                            <option value="{{ $tipo->getId() }}">{{ $tipo->getNombre() }}</option>
                                        @endforeach
                                    </x-shared::form.searchable-select>
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('tipo_credito_id')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN: UBICACIÓN Y DOMICILIO --}}
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-900">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">
                            <i class="fa-solid fa-map-location-dot mr-2"></i>Ubicación y Domicilio
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <x-shared::form.input-label for="calle_numero" :value="__('Calle y Número')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="calle_numero" type="text" wire:model="calle_numero" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('calle_numero')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="asentamiento_id" :value="__('Asentamiento / Zona')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.searchable-select wire:model="asentamiento_id" placeholder="-- BUSCAR O SELECCIONAR ZONA --" :messages="$errors->get('asentamiento_id')">
                                        <option value="">-- Seleccionar Asentamiento --</option>
                                        @foreach($asentamientos as $asentamiento)
                                            <option value="{{ $asentamiento->getId() }}">
                                                {{ $asentamiento->getNombreAsentamiento() }} (C.P. {{ $asentamiento->getCodigoPostal() }})
                                            </option>
                                        @endforeach
                                    </x-shared::form.searchable-select>
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('asentamiento_id')" class="mt-2" />
                            </div>
                        </div>

                        {{-- COMPONENTE REUTILIZABLE DE SELECCIÓN MÚLTIPLE DE BURBUJAS (M:N ZONAS) --}}
                        <div class="mt-6 pt-6 border-t border-dashed border-gray-150 dark:border-gray-900">
                            <x-shared::form.multi-select-tags 
                                id="zonas_ids"
                                wire:model="zonas_ids"
                                label="Zonas geográficas de interés / Preferencias de compra"
                                placeholder="Escriba para buscar y agregar asentamientos..."
                                :messages="$errors->get('zonas_ids')"
                                :options="collect($asentamientos)->map(fn($a) => [
                                    'id' => $a->getId(),
                                    'label' => $a->getNombreAsentamiento() . ' (C.P. ' . $a->getCodigoPostal() . ')'
                                ])->toArray()"
                            />
                        </div>

                    </div>
                </div>

                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('clientes.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-550 transition-colors">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        <x-shared::form.button-primary type="submit" class="shadow-lg px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-floppy-disk mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Actualizar Cambios</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>