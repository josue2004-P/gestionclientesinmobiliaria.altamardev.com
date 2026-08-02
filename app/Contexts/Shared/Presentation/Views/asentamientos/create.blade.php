<div class="w-full font-sans antialiased px-4 sm:px-6 pb-12 bg-transparent text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <x-shared::common.header 
        title="Nuevo Asentamiento" 
        icon="fa-map-location-dot"
        desc="Agrega de forma manual una nueva ubicación o código postal al catálogo global."
        :breadcrumb="[
            ['label' => 'Asentamientos', 'url' => route('asentamientos.index')],
            ['label' => 'Nuevo Asentamiento', 'url' => null]
        ]"
    />

    <div class="max-w-4xl text-left">
        <form wire:submit="save">
            <x-shared::common.component-card 
                title="Estructura de la Ubicación" 
                desc="Los datos ingresados nutrirán de forma predictiva los formularios de clientes y fichas inmobiliarias." 
                class="shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-colors duration-200"
            >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div>
                        <x-shared::form.input-label for="codigo_postal" :value="__('Código Postal')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="codigo_postal" type="text" wire:model="codigo_postal" placeholder="ej: 91700" />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('codigo_postal')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-shared::form.input-label for="nombre_asentamiento" :value="__('Nombre del Asentamiento (Colonia)')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="nombre_asentamiento" type="text" wire:model="nombre_asentamiento" placeholder="ej: Centro"  />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('nombre_asentamiento')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="tipo_asentamiento" :value="__('Tipo Asentamiento')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="tipo_asentamiento" type="text" wire:model="tipo_asentamiento" placeholder="ej: Colonia, Fraccionamiento"  />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('tipo_asentamiento')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="municipio" :value="__('Municipio o Delegación')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="municipio" type="text" wire:model="municipio" placeholder="ej: Veracruz"/>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('municipio')" class="mt-2" />
                    </div>

                    <div>
                        <x-shared::form.input-label for="ciudad" :value="__('Ciudad (Opcional)')"/>
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="ciudad" type="text" wire:model="ciudad" placeholder="ej: Veracruz"  />
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('ciudad')" class="mt-2" />
                    </div>

                    <div class="md:col-span-3">
                        <x-shared::form.input-label for="estado" :value="__('Estado')" required />
                        <div class="mt-1.5">
                            <x-shared::form.text-input id="estado" type="text" wire:model="estado" placeholder="ej: Veracruz de Ignacio de la Llave"/>
                        </div>
                        <x-shared::form.input-error :messages="$errors->get('estado')" class="mt-2" />
                    </div>
                </div>
                
                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <x-shared::form.link 
                            :href="route('asentamientos.index')" 
                            danger
                        >
                            <i class="fa-solid fa-xmark mr-2 text-sm"></i> Cancelar
                        </x-shared::form.link>
                        
                        <x-shared::form.button-form 
                            type="submit" 
                            wire:loading.attr="disabled"
                            startIcon='<i class="fa-solid fa-floppy-disk" wire:loading.remove></i>'
                        >
                            <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i>
                            <span>Registrar Asentamiento</span>
                        </x-shared::form.button-form>
                    </div>
                </x-slot:footer>
            </x-shared::common.component-card>
        </form>
    </div>
</div>