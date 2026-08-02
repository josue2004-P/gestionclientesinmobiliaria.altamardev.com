<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Configurar Cuenta" 
        icon="fa-user-gear"
        :desc="'Editando credenciales para el operador: ' . $usuario"
        :breadcrumb="[
            ['label' => 'Usuarios', 'url' => route('usuarios.index')],
            ['label' => 'Configurar Cuenta', 'url' => null]
        ]"
    />

    <div class="max-w-7xl text-left">
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <div class="lg:col-span-7 space-y-6">
                    <x-shared::common.component-card 
                        title="Credenciales Básicas" 
                        desc="Información personal esencial de contacto y acceso a plataforma."
                        class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
                    >
                        <div class="space-y-8">
                            
                            {{-- BLOQUE 1: DATOS PERSONALES --}}
                            <div>
                                <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                                    Datos Personales
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <x-shared::form.input-label for="name" :value="__('Nombre(s)')" required />
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="name" type="text" wire:model="name" placeholder="Ej. Pedro"  />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-shared::form.input-label for="apellido_paterno" :value="__('Ap. Paterno')" required />
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="apellido_paterno" type="text" wire:model="apellido_paterno" placeholder="Ej. Picapiedra" />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-shared::form.input-label for="apellido_materno" :value="__('Ap. Materno')" required />
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="apellido_materno" type="text" wire:model="apellido_materno" placeholder="Ej. Mármol" />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            {{-- BLOQUE 2: IDENTIDAD --}}
                            <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                                <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                                    Identidad en Plataforma
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-shared::form.input-label for="usuario" :value="__('Nombre de Usuario')"  />
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="usuario" type="text" wire:model="usuario" readonly  />
                                        </div>
                                        <p class="text-[11px] font-medium text-gray-450 mt-2 flex items-center gap-1.5">
                                            <i class="fa-solid fa-lock text-[10px]"></i> Acceso inmutable.
                                        </p>
                                    </div>

                                    <div>
                                        <x-shared::form.input-label for="email" :value="__('Correo Electrónico')" required />
                                        <div class="mt-1.5">
                                            <x-shared::form.text-input id="email" type="email" wire:model="email" class="lowercase " placeholder="usuario@dominio.com" />
                                        </div>
                                        <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            {{-- BLOQUE 3: DOCUMENTACIÓN DIGITAL (FOTO Y FIRMA LADO A LADO EN GRID) --}}
                            <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                                <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                                    Documentación Digital
                                </h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                                    <div class="w-full">
                                        <livewire:usuarios.upload-foto :existingFoto="$currentFoto" />
                                    </div>
                                    <div class="w-full">
                                        <livewire:usuarios.upload-firma :existingFirma="$currentFirma" />
                                    </div>
                                </div>
                            </div>

                           <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                                @include('security::usuarios.partials.estado-cuenta')
                            </div>

                        </div>

                        {{-- Botonera inferior --}}
                        <x-slot:footer>
                            <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-6 w-full">
                                {{-- Botón de Eliminar (Danger) --}}
                                <div class="w-full sm:w-auto">
                                    @if(checkPermiso('usuarios.is_delete'))
                                        <x-shared::form.button-form 
                                            type="button" 
                                            variant="danger"
                                            size="md"
                                            wire:click="confirmPermanentDelete"
                                            class="w-full sm:w-auto"
                                        >
                                            <i class="fa-solid fa-trash-can"></i>
                                            <span>Eliminar Nodo</span>
                                        </x-shared::form.button-form>
                                    @endif
                                </div>

                                {{-- Botón de Guardar Cambios (Primary) --}}
                                <div class="w-full sm:w-auto">
                                    <x-shared::form.button-form 
                                        type="submit" 
                                        size="md"
                                        wire:loading.attr="disabled"
                                        class="w-full sm:w-auto"
                                    >
                                        <i class="fa-solid fa-floppy-disk" wire:loading.remove></i>
                                        <i class="fa-solid fa-circle-notch animate-spin" wire:loading></i>
                                        <span>Guardar Cambios</span>
                                    </x-shared::form.button-form>
                                </div>
                            </div>
                        </x-slot:footer>
                    </x-shared::common.component-card>
                </div>

                {{-- Columna Derecha: Roles/Perfiles de Seguridad (5 Columnas) --}}
                <div class="lg:col-span-5">
                    @include('security::usuarios.partials.perfiles-catalogo')
                </div>

            </div>
        </form>
    </div>
</div>