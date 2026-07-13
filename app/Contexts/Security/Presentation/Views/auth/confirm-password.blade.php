<div>
    <x-slot:title>Confirmar Identidad</x-slot:title>
    <x-slot:titleCard>Zona de Seguridad</x-slot:titleCard>
    <x-slot:descripcionCard>Esta es un área segura de la plataforma. Por favor, confirma tu contraseña antes de continuar.</x-slot:descripcionCard>

    <form wire:submit="confirm">
        <div class="space-y-5">
            
            {{-- Campo de Verificación de Contraseña --}}
            <div>
                <x-shared::form.input-label required for="password" :value="__('Contraseña Actual')" />
                <div class="relative">
                    <x-shared::form.text-input
                        wire:model="password"
                        name="password"
                        id="password"
                        type="password"
                        placeholder="Ingresa tu clave de acceso"
                        class="w-full"
                        required 
                        autofocus
                        autocomplete="current-password"
                    />
                </div>
                <x-shared::form.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Controles y Acciones del Formulario --}}
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-gray-400 hover:text-red-500 transition-colors">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Cancelar
                </a>

                <x-shared::form.button-primary type="submit" wire:loading.attr="disabled" class="shadow-lg shadow-indigo-500/10">
                    <span wire:loading.remove><i class="fa-solid fa-lock-open mr-1.5"></i> Confirmar Acceso</span>
                    <span wire:loading class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch animate-spin text-xs"></i> Verificando núcleo...
                    </span>
                </x-shared::form.button-primary>
            </div>
        </div>
    </form>
</div>