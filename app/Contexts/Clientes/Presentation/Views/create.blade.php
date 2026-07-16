{{-- UN SOLO CONTENEDOR RAÍZ PARA EVITAR MultipleRootElementsDetectedException --}}
<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Registrar Nuevo Cliente" 
        icon="fa-user-plus"
        desc="Crea un expediente comercial completo para el seguimiento de compras y validaciones financieras."
        :breadcrumb="[
            ['label' => 'Clientes', 'url' => route('clientes.index')],
            ['label' => 'Nuevo Cliente', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit.prevent="store">
            <x-shared::common.component-card 
                title="Información y Perfil del Comprador" 
                desc="Los datos ingresados se utilizarán de manera reactiva para las precalificaciones automáticas y expedientes transaccionales." 
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
                                    <x-shared::form.text-input id="nombre" type="text" wire:model="nombre" placeholder="ej: Juan" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('nombre')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="apellido_paterno" :value="__('Apellido Paterno')" required/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="apellido_paterno" type="text" wire:model="apellido_paterno" placeholder="ej: Pérez" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="apellido_materno" :value="__('Apellido Materno')" required/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="apellido_materno" type="text" wire:model="apellido_materno" placeholder="ej: López" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                            </div>

                            <div>
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
                                    <x-shared::form.text-input id="regimen_casamiento" type="text" wire:model="regimen_casamiento" :disabled="$estado_civil !== 'Casado'" placeholder="Bienes Mancomunados, etc." class="w-full font-medium disabled:bg-gray-100 dark:disabled:bg-gray-900 transition-colors" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('regimen_casamiento')" class="mt-2" />
                            </div>
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
                                    <x-shared::form.text-input id="curp" type="text" wire:model="curp" placeholder="18 Caracteres" class="w-full font-mono uppercase font-bold tracking-wide" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('curp')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="rfc" :value="__('RFC')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="rfc" type="text" wire:model="rfc" placeholder="13 Homoclave" class="w-full font-mono uppercase font-bold tracking-wide" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('rfc')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="nss" :value="__('NSS (Seguro Social)')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="nss" type="text" wire:model="nss" placeholder="11 dígitos" class="w-full font-mono font-bold tracking-wide" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('nss')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                            <div class="md:col-span-2">
                                <x-shared::form.input-label for="correo_infonavit" :value="__('Correo Cuenta Infonavit')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="correo_infonavit" type="email" wire:model="correo_infonavit" placeholder="usuario@ejemplo.com" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('correo_infonavit')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="contrasena_infonavit" :value="__('Contraseña Infonavit')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="contrasena_infonavit" type="password" wire:model="contrasena_infonavit" placeholder="••••••••" class="w-full font-medium" />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('contrasena_infonavit')" class="mt-2" />
                            </div>

                            <div>
                                <x-shared::form.input-label for="precalificacion" :value="__('Monto Precalificación ($)')"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input id="precalificacion" type="number" step="0.01" wire:model="precalificacion" placeholder="0.00" class="w-full font-mono font-bold" />
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
                                    <x-shared::form.text-input id="calle_numero" type="text" wire:model="calle_numero" placeholder="ej: Av. Principal #123" class="w-full font-medium" />
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

                        {{-- SUBMÓDULO INTERACTIVO M:N DE ZONAS DE INTERÉS (COMPONENTE ENCAPSULADO) --}}
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
                            <span>Guardar Cliente</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>