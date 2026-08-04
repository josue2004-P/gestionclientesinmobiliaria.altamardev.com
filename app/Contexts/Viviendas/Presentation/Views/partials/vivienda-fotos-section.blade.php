<div class="pt-6 mt-6 border-t-2 border-dashed border-gray-200 dark:border-gray-800">
    <div class="mb-5">
        <span class="block text-sm font-extrabold uppercase tracking-tight text-gray-900 dark:text-white">
            Galería Fotográfica Comercial
        </span>
        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5">
            Suba las capturas de fachadas e interiores. Marque la estrella para fijar la portada principal del inmueble.
        </p>
    </div>

    {{-- Formulario de Carga de Imágenes con file-input --}}
    <div class="p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/40 dark:bg-gray-900/20 mb-6 rounded-xl shadow-2xs">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="md:col-span-9">
                <x-shared::form.file-input
                    id="temporalFotoFile"
                    wire:model="temporalFotoFile"
                    label="Seleccionar Imágenes (JPG, PNG)"
                    :file="$temporalFotoFile"
                    accept="image/*"
                    :messages="$errors->get('temporalFotoFile')"
                />
            </div>

            <div class="md:col-span-3">
                <x-shared::form.button-form
                    type="button"
                    variant="primary"
                    wire:click="addFoto"
                    wire:loading.attr="disabled"
                    wire:target="temporalFotoFile, addFoto"
                    class="w-full h-11 justify-center"
                >
                    <i class="fa-solid fa-camera text-sm" wire:loading.remove wire:target="temporalFotoFile, addFoto"></i>
                    <i class="fa-solid fa-spinner animate-spin text-sm" wire:loading wire:target="temporalFotoFile, addFoto"></i>
                    <span wire:loading.remove wire:target="temporalFotoFile, addFoto">Subir Imagen</span>
                    <span wire:loading wire:target="temporalFotoFile, addFoto">Procesando...</span>
                </x-shared::form.button-form>
            </div>
        </div>
    </div>

    {{-- Grid de Fotografías --}}
    @if(count($fotos) > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach($fotos as $index => $f)
                <div 
                    wire:key="foto-card-{{ $index }}"
                    class="relative border border-gray-200 dark:border-gray-800 p-2.5 bg-white dark:bg-gray-900 rounded-xl group shadow-2xs transition-all hover:border-indigo-500/40"
                >
                    <input type="hidden" wire:model="fotos.{{ $index }}.id">
                    
                    {{-- Preview de la Imagen --}}
                    <div class="aspect-video w-full bg-gray-100 dark:bg-gray-950 rounded-lg flex items-center justify-center overflow-hidden border border-gray-100 dark:border-gray-800">
                        @if(!empty($f['id']))
                            <img src="{{ route('viviendas.fotos.show', $f['id']) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @elseif(!empty($f['preview']))
                            <img src="{{ $f['preview'] }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @endif
                    </div>

                    {{-- Nombre del archivo --}}
                    <div class="mt-2 text-[11px] font-medium text-gray-600 dark:text-gray-300 truncate px-1" title="{{ $f['nombre_original'] }}">
                        {{ $f['nombre_original'] }}
                    </div>

                    {{-- Acciones (Fijar Principal / Eliminar) --}}
                    <div class="mt-3 pt-2 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <button 
                            type="button" 
                            wire:click="setFotoPrincipal({{ $index }})" 
                            class="text-xs transition-colors flex items-center gap-1.5 font-bold {{ $f['es_principal'] ? 'text-amber-500' : 'text-gray-400 hover:text-amber-500' }}"
                        >
                            <i class="{{ $f['es_principal'] ? 'fa-solid' : 'fa-regular' }} fa-star text-sm"></i>
                            <span class="text-[10px] uppercase tracking-wider">
                                {{ $f['es_principal'] ? 'Principal' : 'Fijar' }}
                            </span>
                        </button>

                        <button 
                            type="button" 
                            wire:click="removeFoto({{ $index }})" 
                            class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 transition-all"
                            title="Eliminar foto"
                        >
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center border border-dashed border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/10 rounded-xl text-xs font-medium text-gray-500 dark:text-gray-400">
            <i class="fa-solid fa-images text-2xl block mb-2 text-gray-300 dark:text-gray-700"></i>
            El carrusel comercial de imágenes se encuentra vacío.
        </div>
    @endif
</div>