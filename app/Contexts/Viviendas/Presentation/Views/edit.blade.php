{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Modificar Ficha de Inmueble" 
        icon="fa-house-chimney-user"
        desc="Actualización integral de las características y disponibilidad del inmueble."
        :breadcrumb="[
            ['label' => 'Inventario', 'url' => route('viviendas.index')],
            ['label' => 'Modificar Ficha', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Actualizar Características del Inmueble" 
                desc="Los cambios realizados afectarán las simulaciones de crédito activas y la disponibilidad en el CRM corporativo." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Fraccionamiento --}}
                    <div>
                        <x-shared::form.input-label for="fraccionamiento" :value="__('Fraccionamiento / Proyecto')" class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="fraccionamiento" type="text" wire:model="fraccionamiento" class="w-full font-bold" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('fraccionamiento')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="asentamiento_id" :value="__('Ubicación Postal / Asentamiento')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.searchable-select 
                                id="asentamiento_id" 
                                wire:model="asentamiento_id" 
                                liveSearch="searchAsentamiento"
                                placeholder="Buscar por C.P. o Colonia..."
                            >
                                @if(count($asentamientos) === 0)
                                    <option value="">-- NO SE ENCONTRARON RESULTADOS --</option>
                                @else
                                    <option value="">-- SELECCIONAR --</option>
                                    @foreach($asentamientos as $as)
                                        <option value="{{ $as->getId() }}">CP {{ $as->getCodigoPostal() }} - {{ $as->getNombreAsentamiento() }}</option>
                                    @endforeach
                                @endif
                            </x-shared::form.searchable-select>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('asentamiento_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="tipo_vivienda_id" :value="__('Modelo / Tipo de Vivienda')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.searchable-select 
                                id="tipo_vivienda_id" 
                                wire:model="tipo_vivienda_id" 
                                placeholder="Seleccionar Modelo..."
                            >
                                <option value="">-- SELECCIONAR --</option>
                                @foreach($tiposVivienda as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </x-shared::form.searchable-select>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('tipo_vivienda_id')" class="mt-2" />
                    </div>

                    {{-- Precio Lista --}}
                    <div>
                        <x-shared::form.input-label for="precio_lista" :value="__('Precio de Lista ($)')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="precio_lista" type="number" step="0.01" wire:model="precio_lista" class="w-full font-mono font-bold" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('precio_lista')" class="mt-2" />
                    </div>

                    {{-- Recámaras --}}
                    <div>
                        <x-shared::form.input-label for="recamaras" :value="__('Número de Recámaras')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="recamaras" type="number" wire:model="recamaras" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('recamaras')" class="mt-2" />
                    </div>

                    {{-- 🟢 Estatus Operativo (Input Select compartido) --}}
                    <div>
                        <x-shared::form.input-label for="estatus_vivienda" :value="__('Estatus Operativo')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.input-select 
                                id="estatus_vivienda" 
                                wire:model="estatus_vivienda"
                                :messages="$errors->get('estatus_vivienda')"
                                class="uppercase tracking-wide font-bold"
                            >
                                <option value="Disponible">Disponible</option>
                                <option value="Apartada">Apartada</option>
                                <option value="Vendida">Vendida</option>
                                <option value="Rentada">Rentada</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Suspendida">Suspendida</option>
                            </x-shared::form.input-select>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('estatus_vivienda')" class="mt-2" />
                    </div>

                    {{-- Dirección Detallada --}}
                    <div class="md:col-span-3">
                        <x-shared::form.input-label for="direccion" :value="__('Dirección Completa (Calle, Número, Interno)')" required/>
                        <div class="mt-1.5">
                            <x-shared::form.textarea-input 
                                id="direccion" 
                                wire:model="direccion" 
                                placeholder="Ingresa la calle, número exterior y número de lote exacto..." 
                                :messages="$errors->get('direccion')"
                                class="w-full text-sm font-medium h-24 rounded-none" 
                            />
                        </div>
                    </div>

                    {{-- Switches Cruzados M:N (Desestructurados de forma segura con toArray) --}}
                    <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 dark:border-gray-900">
                        {{-- Créditos Admitidos --}}
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">Créditos Financieros Permitidos</span>
                            <div class="space-y-2 max-h-40 overflow-y-auto p-3 border border-gray-150 dark:border-gray-900 rounded-none bg-gray-50/50 dark:bg-gray-950/20">
                                @foreach($creditosDisponibles as $cr)
                                    @php $crData = $cr->toArray(); @endphp
                                    <label class="flex items-center gap-3 text-xs font-medium text-gray-700 dark:text-gray-400 cursor-pointer">
                                        <input type="checkbox" value="{{ $crData['id'] }}" wire:model="creditos_ids" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                                        <span>{{ $crData['nombre'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Amenidades --}}
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">Amenidades e Infraestructura Interna</span>
                            <div class="space-y-2 max-h-40 overflow-y-auto p-3 border border-gray-150 dark:border-gray-900 rounded-none bg-gray-50/50 dark:bg-gray-950/20">
                                @foreach($amenidadesDisponibles as $am)
                                    @php $amData = $am->toArray(); @endphp
                                    <label class="flex items-center gap-3 text-xs font-medium text-gray-700 dark:text-gray-400 cursor-pointer">
                                        <input type="checkbox" value="{{ $amData['id'] }}" wire:model="amenidades_ids" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                                        <span>{{ $amData['nombre'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Llaves en Resguardo Control --}}
                    <div class="md:col-span-3 pt-3 flex items-start gap-3">
                        <div class="flex h-5 items-center">
                            <input id="llaves" type="checkbox" wire:model="llaves" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                        </div>
                        <div class="text-xs">
                            <label for="llaves" class="font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide">¿Llaves en Resguardo Oficina?</label>
                            <p class="text-gray-400 dark:text-gray-550 font-medium mt-0.5">Modifique el estado si las llaves físicas han sido entregadas o retiradas de la sucursal comercial.</p>
                        </div>
                    </div>

                    {{-- SECCIÓN DE CONTACTOS RELACIONADOS --}}
                    <div class="md:col-span-3 pt-6 mt-4 border-t-2 border-dashed border-gray-200 dark:border-gray-800">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Contactos Relacionados Propietario / Llaves</span>
                                <p class="text-xs text-gray-400 dark:text-gray-550 font-medium">Asigne números telefónicos de administradores, dueños anteriores o agentes con acceso al inmueble.</p>
                            </div>
                            <button type="button" wire:click="addContacto" class="inline-flex items-center justify-center px-3 h-9 text-xs font-bold uppercase border border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 rounded-none transition-colors">
                                <i class="fa-solid fa-plus mr-2 text-indigo-600"></i> Añadir Contacto
                            </button>
                        </div>

                        <div class="space-y-4">
                            @foreach($contactos as $index => $contacto)
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/10 relative rounded-none" wire:key="contacto-row-{{ $index }}">
                                    <input type="hidden" wire:model="contactos.{{ $index }}.id">
                                    
                                    {{-- Nombre Completo --}}
                                    <div class="md:col-span-3">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Nombre Completo</label>
                                        <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.nombre" placeholder="ej: Juan Pérez" class="w-full text-xs font-bold h-9 rounded-none" />
                                    </div>
                                    
                                    {{-- Relación / Vínculo --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Relación / Vínculo</label>
                                        <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.relacion" placeholder="ej: Propietario, Vecino" class="w-full text-xs font-medium h-9 rounded-none" />
                                    </div>
                                    
                                    {{-- Teléfono --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Teléfono</label>
                                        <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.telefono" placeholder="10 dígitos" class="w-full text-xs font-mono font-bold h-9 rounded-none" />
                                    </div>
                                    
                                    {{-- Correo Electrónico --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Correo Electrónico</label>
                                        <x-shared::form.text-input type="email" wire:model="contactos.{{ $index }}.correo" placeholder="ejemplo@mail.com" class="w-full text-xs font-medium h-9 rounded-none" />
                                    </div>
                                    
                                    {{-- Notas Cortas --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Notas Cortas</label>
                                        <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.notes" placeholder="ej: Horarios de atención" class="w-full text-xs font-medium h-9 rounded-none" />
                                    </div>

                                    <div class="md:col-span-1 flex items-end justify-center pb-0.5">
                                        <button type="button" wire:click="removeContacto({{ $index }})" class="h-9 w-full border border-red-200 dark:border-red-900/30 bg-red-50/50 hover:bg-red-100 text-red-600 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/50 transition-colors flex items-center justify-center rounded-none shadow-xs">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- SECCIÓN DE EXPEDIENTE DIGITAL DE DOCUMENTOS --}}
                    <div class="md:col-span-3 pt-6 mt-6 border-t border-dashed border-gray-200 dark:border-gray-800">
                        <div>
                            <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Expediente Digital Transaccional</span>
                            <p class="text-xs text-gray-400 dark:text-gray-550 font-medium mb-4">Adjunte archivos legibles (PDF, PNG, JPG) necesarios para la validación jurídica y fiscal de la propiedad.</p>
                        </div>

                        <div class="p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/20 dark:bg-gray-900/5 mb-4 rounded-none">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                
                                {{-- Clasificación del Documento (Input Select compartido con placeholder nativo) --}}
                                <div class="md:col-span-4">
                                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Clasificación del Documento</label>
                                    <x-shared::form.input-select 
                                        wire:model="temporalTipo" 
                                        placeholder="-- Clasificar archivo --"
                                        :messages="$errors->get('temporalTipo')"
                                        class="text-xs font-bold rounded-none"
                                    >
                                        @foreach($tiposDisponibles as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </x-shared::form.input-select>
                                </div>

                                <div class="md:col-span-6">
                                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Seleccionar Archivo Físico</label>
                                    <input type="file" wire:model="temporalFile" id="temporalFile" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-gray-900 dark:file:text-gray-300 hover:file:bg-indigo-100 border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 h-9 flex items-center rounded-none">
                                </div>
                                <div class="md:col-span-2">
                                    <button type="button" wire:click="addDocumento" class="w-full inline-flex items-center justify-center h-9 text-xs font-bold uppercase text-white bg-indigo-600 hover:bg-indigo-700 rounded-none transition-colors shadow-xs">
                                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Adjuntar
                                    </button>
                                </div>
                            </div>
                            <div wire:loading wire:target="temporalFile" class="mt-2 text-[11px] font-bold text-indigo-600 dark:text-indigo-400 animate-pulse">
                                <i class="fa-solid fa-spinner animate-spin mr-1"></i> Transfiriendo archivo al servidor...
                            </div>
                            @error('temporalFile') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                            @error('temporalTipo') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                        </div>

                        @if(count($documentos) > 0)
                            <div class="border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 divide-y divide-gray-200 dark:divide-gray-800">
                                @foreach($documentos as $index => $doc)
                                    <div class="p-3 flex items-center justify-between text-xs" wire:key="documento-row-{{ $index }}">
                                        <input type="hidden" wire:model="documentos.{{ $index }}.id">
                                        <div class="flex items-center gap-3 min-w-0 flex-1">
                                            <div class="p-2 bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-400">
                                                <i class="fa-solid fa-file-pdf text-base"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <span class="block font-bold text-gray-900 dark:text-gray-100 truncate">{{ $doc['nombre_original'] }}</span>
                                                <div class="flex items-center gap-2 mt-0.5 text-[10px] text-gray-400 dark:text-gray-550 font-medium">
                                                    <span class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-900 rounded-none text-gray-600 dark:text-gray-400 uppercase font-bold tracking-wide">
                                                        {{ $tiposDisponibles[$doc['tipo_documento']] ?? $doc['tipo_documento'] }}
                                                    </span>
                                                    <span>•</span>
                                                    <span>{{ round($doc['peso_bytes'] / 1024, 2) }} KB</span>
                                                    <span>•</span>
                                                    @if($doc['verificado'])
                                                        <span class="text-green-600 dark:text-green-400 font-bold"><i class="fa-solid fa-circle-check"></i> Verificado</span>
                                                    @else
                                                        <span class="text-yellow-600 dark:text-yellow-500 font-bold"><i class="fa-solid fa-clock"></i> Pendiente revisión</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 ml-4">
                                            @if(!empty($doc['id']))
                                                <a href="{{ route('viviendas.documentos.download', $doc['id']) }}" target="_blank" class="h-8 px-3 border border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 flex items-center justify-center font-bold text-gray-600 dark:text-gray-400 transition-colors">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @else
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-500/10 px-2 py-1 border border-amber-100 dark:border-amber-500/20">Por Guardar</span>
                                            @endif
                                            <button type="button" wire:click="removeDocumento({{ $index }})" class="h-8 px-3 border border-red-200 dark:border-red-900/30 bg-red-50/50 hover:bg-red-100 text-red-600 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/50 transition-colors flex items-center justify-center">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/10 text-xs font-medium text-gray-400 dark:text-gray-550">
                                <i class="fa-solid fa-folder-open text-lg block mb-1 text-gray-300 dark:text-gray-700"></i> No se han anexado documentos digitales a este expediente todavía.
                            </div>
                        @endif
                    </div>

                    {{-- SECCIÓN DE GALERÍA FOTOGRÁFICA --}}
                    <div class="md:col-span-3 pt-6 mt-6 border-t border-dashed border-gray-200 dark:border-gray-800">
                        <div>
                            <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Galería Fotográfica Comercial</span>
                            <p class="text-xs text-gray-400 dark:text-gray-550 font-medium mb-4">Suba las capturas de fachadas e interiores. Marque la estrella para fijar la portada del inmueble.</p>
                        </div>

                        <div class="p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/20 dark:bg-gray-900/5 mb-6 rounded-none">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                <div class="md:col-span-10">
                                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Seleccionar Imágenes (JPG, PNG)</label>
                                    <input type="file" wire:model="temporalFotoFile" id="temporalFotoFile" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-gray-900 dark:file:text-gray-300 hover:file:bg-indigo-100 border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 h-9 flex items-center rounded-none">
                                </div>
                                <div class="md:col-span-2">
                                    <button type="button" wire:click="addFoto" class="w-full inline-flex items-center justify-center h-9 text-xs font-bold uppercase text-white bg-indigo-600 hover:bg-indigo-700 rounded-none transition-colors shadow-xs">
                                        <i class="fa-solid fa-camera mr-2"></i> Subir
                                    </button>
                                </div>
                            </div>
                            <div wire:loading wire:target="temporalFotoFile" class="mt-2 text-[11px] font-bold text-indigo-600 dark:text-indigo-400 animate-pulse">
                                <i class="fa-solid fa-spinner animate-spin mr-1"></i> Subiendo imagen privada al servidor local...
                            </div>
                            @error('temporalFotoFile') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                        </div>

                        @if(count($fotos) > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach($fotos as $index => $f)
                                    <div class="relative border border-gray-200 dark:border-gray-800 p-2 bg-white dark:bg-gray-950 group rounded-none" wire:key="foto-card-{{ $index }}">
                                        <input type="hidden" wire:model="fotos.{{ $index }}.id">
                                        
                                        <div class="aspect-video w-full bg-gray-50 dark:bg-gray-900 flex items-center justify-center overflow-hidden border border-gray-100 dark:border-gray-900">
                                            @if(!empty($f['id']))
                                                <img src="{{ route('viviendas.fotos.show', $f['id']) }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ $f['preview'] }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>

                                        <div class="mt-2 text-[10px] font-medium text-gray-500 dark:text-gray-400 truncate px-1">{{ $f['nombre_original'] }}</div>
                                        <div class="mt-3 pt-2 border-t border-gray-150 dark:border-gray-900 flex items-center justify-between">
                                            <button type="button" wire:click="setFotoPrincipal({{ $index }})" class="text-xs transition-colors flex items-center {{ $f['es_principal'] ? 'text-amber-500 font-bold' : 'text-gray-400 hover:text-amber-400' }}">
                                                <i class="{{ $f['es_principal'] ? 'fa-solid' : 'fa-regular' }} fa-star mr-1"></i>
                                                <span class="text-[9px] uppercase tracking-tight">{{ $f['es_principal'] ? 'Principal' : 'Fijar' }}</span>
                                            </button>
                                            <button type="button" wire:click="removeFoto({{ $index }})" class="text-gray-400 hover:text-red-500 p-1 transition-colors">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-6 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/10 text-xs font-medium text-gray-400 dark:text-gray-550">
                                <i class="fa-solid fa-images text-lg block mb-1 text-gray-300 dark:text-gray-700"></i> El carrusel comercial de imágenes se encuentra vacío.
                            </div>
                        @endif
                    </div>
                </div>
                
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('viviendas.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-550 transition-colors">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        <x-shared::form.button-primary type="submit" class="shadow-lg px-5 h-11 text-xs" wire:loading.attr="disabled" wire:target="save">
                            <i class="fa-solid fa-circle-check mr-2" wire:loading.remove wire:target="save"></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading wire:target="save"></i> 
                            <span>Guardar Cambios</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>