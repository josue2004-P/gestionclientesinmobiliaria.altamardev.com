<div>
    <x-slot:title>Verificación de Cuenta</x-slot:title>
    <x-slot:titleCard>Verifica tu Correo</x-slot:titleCard>
    <x-slot:descripcionCard>¡Gracias por registrarte en el sistema!</x-slot:descripcionCard>

    <div class="space-y-6">
        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed italic">
            Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el correo, con gusto te enviaremos otro.
        </p>

        {{-- Alerta de Reenvío Exitoso --}}
        @if (session('status') == 'verification-link-sent')
            <div class="p-4 rounded-xl text-xs font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 shadow-sm flex items-start gap-2">
                <i class="fa-solid fa-circle-check mt-0.5"></i>
                <span>Se ha enviado un nuevo enlace de verificación a la dirección de correo proporcionada durante el registro.</span>
            </div>
        @endif

        {{-- Acciones del Módulo --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 border-t border-gray-100 dark:border-gray-800">
            {{-- Formulario de Reenvío --}}
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <x-shared::form.button-primary type="submit" class="w-full sm:w-auto justify-center shadow-lg shadow-indigo-500/10">
                    <i class="fa-solid fa-paper-plane mr-2"></i> {{ __('Reenviar Correo') }}
                </x-shared::form.button-primary>
            </form>

            {{-- Formulario de Cierre de Sesión Seguro --}}
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
                @csrf
                <button type="submit" class="text-xs font-bold text-gray-400 hover:text-red-500 transition-colors uppercase tracking-wider group">
                    <i class="fa-solid fa-power-off mr-1 text-gray-300 group-hover:text-red-500 transition-colors"></i> 
                    {{ __('Cerrar Sesión') }}
                </button>
            </form>
        </div>
    </div>
</div>