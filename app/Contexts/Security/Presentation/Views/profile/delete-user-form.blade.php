<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-700 dark:text-gray-400">
            {{ __('Eliminar Cuenta') }}
        </h2>
        <p class="mt-1 text-sm text-gray-800 dark:text-gray-500">
            {{ __('Una vez eliminada su cuenta, todos sus recursos y datos se eliminarán permanentemente.') }}
        </p>
    </header>

    {{-- Mapeado al botón danger unificado de Shared --}}
    <x-shared::form.danger-button wire:click.prevent="confirmDeletion">
        {{ __('Eliminar Cuenta') }}
    </x-shared::form.danger-button> 

    {{-- Renderizado condicional del modal manejado por Livewire --}}
    @if($confirmingUserDeletion)
        <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center bg-gray-900/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl border border-gray-200 dark:border-gray-700">
                
                <h2 class="text-lg font-medium text-gray-700 dark:text-gray-400">
                    {{ __('¿Estás segura de que quieres eliminar tu cuenta?') }}
                </h2>
                <p class="mt-1 text-sm text-gray-800 dark:text-gray-500">
                    {{ __('Ingrese su contraseña para confirmar que desea eliminar tu cuenta permanentemente.') }}
                </p>

                <form wire:submit.prevent="deleteAccount" class="mt-6">
                    <div>
                        <x-shared::form.input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                        
                        <x-shared::form.text-input
                            type="password"
                            id="password"
                            placeholder="Ingresa la contraseña actual"
                            wire:model="password"
                            class="w-full"
                            required 
                        />
                        
                        {{-- Corregido text-red-650 a text-red-600 para Tailwind nativo --}}
                        @error('password') 
                            <span class="text-sm text-red-600 mt-2 block font-medium">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        {{-- Mapeado a los controles de Shared --}}
                        <x-shared::form.secondary-button type="button" wire:click="cancelDeletion">
                            {{ __('Cancelar') }}
                        </x-shared::form.secondary-button>

                        <x-shared::form.danger-button type="submit" class="ms-3">
                            {{ __('Eliminar Cuenta') }}
                        </x-shared::form.danger-button>
                    </div>
                </form>
                
            </div>
        </div>
    @endif
</section>