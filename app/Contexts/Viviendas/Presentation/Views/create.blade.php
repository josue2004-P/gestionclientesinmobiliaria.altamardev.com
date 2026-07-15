{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Nueva Ficha de Inmueble" 
        icon="fa-house-medical-flag"
        desc="Carga de una nueva vivienda al inventario transaccional del sistema."
        :breadcrumb="[
            ['label' => 'Inventario', 'url' => route('viviendas.index')],
            ['label' => 'Nueva Ficha', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Estructura Física y Financiera de la Propiedad" 
                desc="Los datos ingresados se utilizarán de manera reactiva para las cotizaciones automáticas y expedientes fiscales." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Fraccionamiento --}}
                    <div>
                        <x-shared::form.input-label for="fraccionamiento" :value="__('Fraccionamiento / Proyecto')" class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="fraccionamiento" type="text" wire:model="fraccionamiento" placeholder="ej: Residencial del Bosque" class="w-full font-medium" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('fraccionamiento')" class="mt-2" />
                    </div>

                    {{-- Asentamiento Geográfico Compartido --}}
                    <div>
                        <x-shared::form.input-label for="asentamiento_id" :value="__('Ubicación Postal / Asentamiento')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <select id="asentamiento_id" wire:model="asentamiento_id" class="w-full text-xs font-bold uppercase tracking-wide border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-11 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Seleccionar --</option>
                                @foreach($asentamientos as $as)
                                    <option value="{{ $as->id }}">CP {{ $as->codigo_postal }} - {{ $as->nombre_asentamiento }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('asentamiento_id')" class="mt-2" />
                    </div>

                    {{-- Tipo Vivienda --}}
                    <div>
                        <x-shared::form.input-label for="tipo_vivienda_id" :value="__('Modelo / Tipo de Vivienda')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <select id="tipo_vivienda_id" wire:model="tipo_vivienda_id" class="w-full text-xs font-bold uppercase tracking-wide border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-11 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Seleccionar --</option>
                                @foreach($tiposVivienda as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('tipo_vivienda_id')" class="mt-2" />
                    </div>

                    {{-- Precio Lista --}}
                    <div>
                        <x-shared::form.input-label for="precio_lista" :value="__('Precio de Lista ($)')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="precio_lista" type="number" step="0.01" wire:model="precio_lista" placeholder="0.00" class="w-full font-mono font-bold" />
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

                    {{-- Estatus --}}
                    <div>
                        <x-shared::form.input-label for="estatus_vivienda" :value="__('Estatus Operativo')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <select id="estatus_vivienda" wire:model="estatus_vivienda" class="w-full text-xs font-bold uppercase tracking-wide border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-11 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Disponible">Disponible</option>
                                <option value="Apartada">Apartada</option>
                                <option value="Vendida">Vendida</option>
                                <option value="Rentada">Rentada</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Suspendida">Suspendida</option>
                            </select>
                        </div>
                    </div>

                    {{-- Dirección Detallada Full-Width --}}
                    <div class="md:col-span-3">
                        <x-shared::form.input-label for="direccion" :value="__('Dirección Completa (Calle, Número, Interno)')" required class="text-gray-700 dark:text-gray-300"/>
                        <div class="mt-1.5">
                            <textarea id="direccion" wire:model="direccion" placeholder="Ingresa la calle, número exterior y número de lote exacto..." class="w-full text-sm font-medium border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-24 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('direccion')" class="mt-2" />
                    </div>

                    {{-- Switches Cruzados M:N (Esquemas Financieros y Amenidades) --}}
                    <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 dark:border-gray-900">
                        
                        {{-- Créditos Admitidos M:N --}}
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">Créditos Financieros Permitidos</span>
                            <div class="space-y-2 max-h-40 overflow-y-auto p-3 border border-gray-150 dark:border-gray-900 rounded-none bg-gray-50/50 dark:bg-gray-950/20">
                                @foreach($creditosDisponibles as $cr)
                                    <label class="flex items-center gap-3 text-xs font-medium text-gray-700 dark:text-gray-400 cursor-pointer">
                                        <input type="checkbox" value="{{ $cr->id }}" wire:model="creditos_ids" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                                        <span>{{ $cr->nombre }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Amenidades de la Casa M:N --}}
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-wide text-gray-700 dark:text-gray-300 mb-2">Amenidades e Infraestructura Interna</span>
                            <div class="space-y-2 max-h-40 overflow-y-auto p-3 border border-gray-150 dark:border-gray-900 rounded-none bg-gray-50/50 dark:bg-gray-950/20">
                                @foreach($amenidadesDisponibles as $am)
                                    <label class="flex items-center gap-3 text-xs font-medium text-gray-700 dark:text-gray-400 cursor-pointer">
                                        <input type="checkbox" value="{{ $am->id }}" wire:model="amenidades_ids" class="h-4 w-4 rounded-none border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-800 dark:bg-gray-900">
                                        <span>{{ $am->nombre }}</span>
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
                            <p class="text-gray-400 dark:text-gray-550 font-medium mt-0.5">Marque esta casilla si el departamento de ventas tiene las llaves físicas para su demostración inmediata.</p>
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

                                    {{-- Nombre --}}
                                    <div class="md:col-span-3">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Nombre Completo</label>
                                        <input type="text" wire:model="contactos.{{ $index }}.nombre" placeholder="ej: Juan Pérez" class="w-full text-xs font-bold border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-9 focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    {{-- Relación --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Relación / Vínculo</label>
                                        <input type="text" wire:model="contactos.{{ $index }}.relacion" placeholder="ej: Propietario, Vecino" class="w-full text-xs font-medium border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-9 focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    {{-- Teléfono --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Teléfono</label>
                                        <input type="text" wire:model="contactos.{{ $index }}.telefono" placeholder="10 dígitos" class="w-full text-xs font-mono font-bold border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-9 focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    {{-- Correo --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Correo Electrónico</label>
                                        <input type="email" wire:model="contactos.{{ $index }}.correo" placeholder="ejemplo@mail.com" class="w-full text-xs font-medium border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-9 focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    {{-- Notas Breves --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Notas Cortas</label>
                                        <input type="text" wire:model="contactos.{{ $index }}.notes" placeholder="ej: Horarios de atención" class="w-full text-xs font-medium border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 rounded-none h-9 focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    {{-- Remover --}}
                                    <div class="md:col-span-1 flex items-end justify-center pb-0.5">
                                        <button type="button" wire:click="removeContacto({{ $index }})" class="h-9 w-full border border-red-200 dark:border-red-900/30 bg-red-50/50 hover:bg-red-100 text-red-600 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/50 transition-colors flex items-center justify-center rounded-none shadow-xs">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('viviendas.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-550 transition-colors">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </a>
                        
                        <x-shared::form.button-primary type="submit" class="shadow-lg px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-floppy-disk mr-2" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i> 
                            <span>Generar Ficha Técnica</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>