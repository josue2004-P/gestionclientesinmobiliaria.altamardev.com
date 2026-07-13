<div>
    <x-slot:title>Restablecer Cuenta</x-slot:title>
    <x-slot:titleCard>Nueva Contraseña</x-slot:titleCard>
    <x-slot:descripcionCard>Ingresa tu nueva contraseña para restablecer el acceso.</x-slot:descripcionCard>

    <form wire:submit="resetPassword">
        <div class="space-y-5">
            
            {{-- Correo Electrónico --}}
            <div>
                <x-shared::form.input-label for="email" required :value="__('Email')" />
                <x-shared::form.text-input 
                    id="email" 
                    type="email" 
                    wire:model="email" 
                    required 
                    autocomplete="username" 
                    placeholder="usuario@dominio.com"
                    class="w-full lowercase"
                />
                <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Nueva Contraseña --}}
            <div>
                <x-shared::form.input-label for="password" required :value="__('Nueva Contraseña')" />
                <x-shared::form.text-input
                    wire:model="password"
                    id="password"
                    type="password"
                    placeholder="Mínimo 8 caracteres"
                    required 
                    autocomplete="new-password"
                    class="w-full"
                />
                <x-shared::form.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Confirmación de Nueva Contraseña --}}
            <div>
                <x-shared::form.input-label for="password_confirmation" required :value="__('Confirmar Contraseña')" />
                <x-shared::form.text-input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    type="password"
                    placeholder="Repite tu contraseña exactamente"
                    required 
                    autocomplete="new-password"
                    class="w-full"
                />
                <x-shared::form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            {{-- Acciones del Formulario --}}
            <div class="flex items-center justify-end pt-2">
                <x-shared::form.button-primary type="submit" wire:loading.attr="disabled" class="shadow-lg shadow-indigo-500/10">
                    <span wire:loading.remove><i class="fa-solid fa-shield-keyhole mr-1.5"></i> Actualizar Llave</span>
                    <span wire:loading class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch animate-spin text-xs"></i> Actualizando credenciales...
                    </span>
                </x-shared::form.button-primary>
            </div>  
        </div>
    </form>
</div>