@section('title', 'Perfil')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        {{-- Módulo 1: Actualización de Información Personal --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-transparent dark:border-gray-700">
            <div class="max-w-xl">
                {{-- Mapeado al contexto Security --}}
                @livewire('security.profile.update-profile-information-form')
            </div>
        </div>

        {{-- Módulo 2: Actualización de Credenciales (Password) --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-transparent dark:border-gray-700">
            <div class="max-w-xl">
                {{-- Mapeado al contexto Security --}}
                @livewire('security.auth.update-password-form')
            </div>
        </div>

        {{-- Módulo 3: Destrucción de Cuenta (Borrado Seguro) --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-transparent dark:border-gray-700">
            <div class="max-w-xl">
                {{-- Mapeado al contexto Security --}}
                @livewire('security.profile.delete-user-form')
            </div>
        </div>
        
    </div>
</div>