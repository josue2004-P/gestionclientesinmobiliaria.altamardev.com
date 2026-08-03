<div>
    <x-slot:title>Login</x-slot:title>
    <x-slot:titleCard>Iniciar Sesión</x-slot:titleCard>
    <x-slot:descripcionCard>Ingresa tu usuario y contraseña para iniciar sesión!</x-slot:descripcionCard>
    
    <form wire:submit="login">
        <div class="space-y-5">

            <div>
                <x-shared::form.input-label for="usuario" required :value="__('Usuario')" />
                <x-shared::form.text-input
                    type="text"
                    wire:model="usuario"
                    id="usuario"
                    placeholder="Ingresa tu usuario"
                    required 
                    autofocus
                    autocomplete="username" 
                />
                <x-shared::form.input-error :messages="$errors->get('usuario')" class="mt-2" />
            </div>

            <div>
                <x-shared::form.input-label required for="password" :value="__('Password')" />
                <div class="mt-1.5 relative" x-data="{ showPassword: false }">
                    <x-shared::form.text-input
                        wire:model="password"
                        name="password"
                        id="password"
                        type="password"
                        placeholder="Ingresa tu contraseña"
                        required 
                        :showPassword="true"
                        autocomplete="current-password"
                    />
                </div>
                <x-shared::form.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center cursor-pointer select-none">
                    <input type="checkbox" wire:model="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/20 dark:border-gray-700">
                    <span class="ml-2 text-xs text-gray-500 dark:text-gray-400 font-medium">Recordar sesión</span>
                </label>

                <x-shared::form.link href="{{ route('password.request') }}" >
                    ¿Olvidaste tu contraseña?
                </x-shared::form.link>
            </div>

            <div>
                <x-shared::form.button-form 
                    type="submit" 
                    variant="primary"
                    class="w-full justify-center shadow-lg shadow-indigo-500/10 h-11"
                    wire:loading.attr="disabled"
                >
                    {{-- Estado normal --}}
                    <span wire:loading.remove class="flex items-center gap-2">
                        <i class="fa-solid fa-right-to-bracket text-xs"></i>
                        <span>Iniciar Sesión</span>
                    </span>

                    {{-- Estado de carga --}}
                    <span wire:loading class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch animate-spin text-xs"></i>
                        <span>Verificando credenciales...</span>
                    </span>
                </x-shared::form.button-form>
            </div>
        </div>
    </form>
</div>