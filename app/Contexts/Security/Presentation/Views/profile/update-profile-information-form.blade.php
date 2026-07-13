<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-700 dark:text-gray-400">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-800 dark:text-gray-500">
            {{ __("Actualice la información del perfil y la dirección de correo electrónico de su cuenta.") }}
        </p>
    </header>

    <form wire:submit.prevent="updateProfile" class="mt-6 space-y-6">
        {{-- Nombre Completo --}}
        <div>
            <x-shared::form.input-label for="name" :value="__('Nombre:')" />
            <x-shared::form.text-input
                type="text"
                id="name"
                placeholder="Escribe el nombre"
                wire:model="name"
                class="w-full font-semibold"
            />    
            @error('name') 
                <span class="text-sm text-red-600 mt-2 block font-medium">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Correo Electrónico --}}
        <div>
            <x-shared::form.input-label for="email" :value="__('Email:')" />
            <x-shared::form.text-input
                type="email"
                id="email"
                placeholder="Escribe el email"
                wire:model="email"
                class="w-full lowercase"
            />    
            @error('email') 
                <span class="text-sm text-red-600 mt-2 block font-medium">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Acciones y Notificación de Éxito --}}
        <div class="flex items-center gap-4">
            <x-shared::form.button-primary type="submit">
                {{ __('Guardar') }}
            </x-shared::form.button-primary>

            @if (session()->has('success'))
                <p class="text-sm text-green-600 dark:text-green-400 font-bold animate-pulse">
                    <i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}
                </p>
            @endif
        </div>
    </form>
</section>