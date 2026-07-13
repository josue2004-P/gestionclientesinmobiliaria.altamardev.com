<div>
    <x-slot:title>Recuperación</x-slot:title>
    <x-slot:titleCard>Restablece Contraseña</x-slot:titleCard>
    <x-slot:descripcionCard>Ingresa tu email para recibir el enlace de recuperación!</x-slot:descripcionCard>

    <div class="space-y-5">
        <div class="mb-4 text-xs text-gray-500 italic leading-relaxed">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente indícanos tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña y podrás elegir una nueva.') }}
        </div>

        {{-- Alerta de éxito reactiva leída desde la sesión flash de Livewire --}}
        @if (session('status'))
            <div class="mb-4 font-bold text-xs text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 p-3 rounded-xl border border-emerald-200 dark:border-emerald-500/20 shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <form wire:submit="sendResetLink">
            <div class="space-y-5">
                {{-- Correo Electrónico --}}
                <div>
                    <x-shared::form.input-label for="email" :value="__('Email:')" required />
                    <x-shared::form.text-input 
                        type="email" 
                        wire:model="email" 
                        id="email" 
                        placeholder="Escribe el email registrado" 
                        class="w-full lowercase"
                        required 
                        autofocus 
                    />    
                    <x-shared::form.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Controles y Acciones --}}
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('login') }}" class="text-xs font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-wider">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Volver al Login
                    </a>

                    <x-shared::form.button-primary type="submit" wire:loading.attr="disabled" class="shadow-lg shadow-indigo-500/10">
                        <span wire:loading.remove><i class="fa-solid fa-paper-plane mr-1.5"></i> Enviar Enlace</span>
                        <span wire:loading class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-notch animate-spin text-xs"></i> Despachando token...
                        </span>
                    </x-shared::form.button-primary>
                </div>
            </div>
        </form>
    </div>
</div>