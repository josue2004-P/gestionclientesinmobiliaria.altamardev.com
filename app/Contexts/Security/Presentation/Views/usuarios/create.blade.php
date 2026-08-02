<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Registrar Nuevo Usuario" 
        icon="fa-user-plus"
        desc="Configura los datos personales, credenciales de seguridad y archivos digitales del nuevo miembro."
        :breadcrumb="[
            ['label' => 'Usuarios', 'url' => route('usuarios.index')],
            ['label' => 'Nuevo Usuario', 'url' => null]
        ]"
    />

    <div class="max-w-5xl text-left">
        <form wire:submit="save" class="space-y-6">
            
            <x-shared::common.component-card 
                title="Información de Cuenta" 
                desc="Define los datos personales, nombre de usuario único y acceso inicial." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="space-y-8">
                    
                    {{-- SECCIÓN 1: DATOS PERSONALES --}}
                    <div>
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                            Datos Personales
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Nombre(s) --}}
                            <div class="col-span-1">
                                <x-shared::form.input-label for="name" :value="__('Nombre(s)')" required />
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="name"
                                        type="text"
                                        wire:model="name"
                                        placeholder="Ej. Pedro"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- Apellido Paterno --}}
                            <div class="col-span-1">
                                <x-shared::form.input-label for="apellido_paterno" :value="__('Apellido Paterno')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="apellido_paterno"
                                        type="text"
                                        wire:model="apellido_paterno"
                                        placeholder="Ej. Picapiedra"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
                            </div>

                            {{-- Apellido Materno --}}
                            <div class="col-span-1">
                                <x-shared::form.input-label for="apellido_materno" :value="__('Apellido Materno')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="apellido_materno"
                                        type="text"
                                        wire:model="apellido_materno"
                                        placeholder="Ej. Mármol"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 2: CREDENCIALES DE ACCESO --}}
                    <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                            Identidad en Plataforma
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nombre de Usuario --}}
                            <div>
                                <x-shared::form.input-label for="usuario" :value="__('Nombre de Usuario')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="usuario"
                                        type="text"
                                        wire:model="usuario"
                                        placeholder="Ej. pedropicapiedra"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('usuario')" class="mt-2" />
                            </div>

                            {{-- Correo Electrónico --}}
                            <div>
                                <x-shared::form.input-label for="email" :value="__('Correo Electrónico')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="email"
                                        type="email"
                                        wire:model="email"
                                        class="lowercase" 
                                        placeholder="usuario@dominio.com"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 3: ARCHIVOS DIGITALES --}}
                    <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-5">
                            Documentación Digital
                        </h3>
                        
                        {{-- Subcomponentes alineados en grid de dos columnas (lado a lado) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                            <div class="w-full">
                                <livewire:usuarios.upload-foto />
                            </div>
                            <div class="w-full">
                                <livewire:usuarios.upload-firma />
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 4: SEGURIDAD Y ESTADO --}}
                    <div class="border-t border-gray-100 dark:border-gray-800/60 pt-6 space-y-6">
                        <h3 class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">
                            Seguridad & Privilegios
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Contraseña --}}
                            <div x-data="{ showPassword: false }">
                                <x-shared::form.input-label for="password" :value="__('Contraseña Temporal')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="password"
                                        type="password"
                                        wire:model="password"
                                        placeholder="Mínimo 8 caracteres"
                                        :showPassword="true"
                                    />
                                </div>
                                <x-shared::form.input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            {{-- Confirmación --}}
                            <div x-data="{ showPassword: false }">
                                <x-shared::form.input-label for="password_confirmation" :value="__('Confirmar Contraseña')" required class="text-gray-700 dark:text-gray-300"/>
                                <div class="mt-1.5">
                                    <x-shared::form.text-input
                                        id="password_confirmation"
                                        type="password"
                                        wire:model="password_confirmation"
                                        placeholder="Repite la contraseña"
                                        :showPassword="true"
                                    />
                                </div>
                            </div>
                        </div>

                        @include('security::usuarios.partials.estado-cuenta')
                    </div>
                </div>

                {{-- Footer con alineación y contraste perfecto --}}
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('usuarios.index') }}"
                            class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-500 hover:text-red-555 dark:text-gray-400 dark:hover:text-red-400 transition-colors duration-150">
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar Registro
                        </a>
                        
                        <x-shared::form.button-primary type="submit" class="shadow-lg shadow-indigo-500/10 dark:shadow-indigo-500/5 px-5 h-11 text-xs" wire:loading.attr="disabled">
                            <i class="fa-solid fa-user-check mr-2 text-sm" wire:loading.remove></i>
                            <i class="fa-solid fa-circle-notch animate-spin mr-2 text-sm" wire:loading></i>
                            <span>Crear y Guardar</span>
                        </x-shared::form.button-primary>
                    </div>
                </x-slot:footer>

            </x-shared::common.component-card>
        </form>
    </div>
</div>