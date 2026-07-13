<div class="max-w-2xl">
    <form wire:submit="updatePassword">
        <x-shared::common.component-card 
            title="Actualizar Contraseña" 
            desc="Asegúrate de utilizar una clave larga y compleja para mantener protegida tu cuenta."
            class="shadow-theme-md"
        >
            <div class="space-y-6">
                {{-- Contraseña Actual --}}
                <div>
                    <x-shared::form.input-label for="current_password" :value="__('Contraseña Actual')" required />
                    <div class="mt-1">
                        <x-shared::form.text-input
                            id="current_password"
                            wire:model="current_password"
                            type="password"
                            class="w-full"
                            placeholder="••••••••"
                        />
                    </div>
                    <x-shared::form.input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800/60 my-2"></div>

                {{-- Nueva Contraseña --}}
                <div>
                    <x-shared::form.input-label for="password" :value="__('Nueva Contraseña')" required />
                    <div class="mt-1">
                        <x-shared::form.text-input
                            id="password"
                            wire:model="password"
                            type="password"
                            class="w-full"
                            placeholder="Mínimo 8 caracteres"
                        />
                    </div>
                    <x-shared::form.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Confirmar Nueva Contraseña --}}
                <div>
                    <x-shared::form.input-label for="password_confirmation" :value="__('Confirmar Nueva Contraseña')" required />
                    <div class="mt-1">
                        <x-shared::form.text-input
                            id="password_confirmation"
                            wire:model="password_confirmation"
                            type="password"
                            class="w-full"
                            placeholder="Repite la nueva contraseña"
                        />
                    </div>
                </div>
            </div>

            <x-slot:footer>
                <div class="flex items-center justify-end">
                    <x-shared::form.button-primary type="submit" class="shadow-lg shadow-indigo-500/20" wire:loading.attr="disabled">
                        <i class="fa-solid fa-floppy-disk mr-2" wire:loading.remove></i>
                        <i class="fa-solid fa-circle-notch animate-spin mr-2" wire:loading></i>
                        <span>Guardar Nueva Clave</span>
                    </x-shared::form.button-primary>
                </div>
            </x-slot:footer>
        </x-shared::common.component-card>
    </form>
</div>