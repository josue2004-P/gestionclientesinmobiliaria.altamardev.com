<div class="md:col-span-3 pt-6 mt-4 border-t-2 border-dashed border-gray-200 dark:border-gray-800">
    <div class="flex items-center justify-between mb-4">
        <div>
            <span class="block text-sm font-black uppercase tracking-tight text-gray-900 dark:text-white">Contactos Relacionados Propietario / Llaves</span>
            <p class="text-xs text-gray-400 dark:text-gray-550 font-medium">Asigne números telefónicos de administradores, dueños anteriores o agentes con acceso al inmueble.</p>
        </div>
        <button type="button" wire:click="addContacto" class="inline-flex items-center justify-center px-3 h-9 text-xs font-bold uppercase border border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 rounded-none transition-colors">
            <i class="fa-solid fa-plus mr-2 text-indigo-600"></i> Añadir Contacto
        </button>
    </div>

    <div class="space-y-4">
        @foreach($contactos as $index => $contacto)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-4 border border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/10 relative rounded-none" wire:key="contacto-row-{{ $index }}">
                <input type="hidden" wire:model="contactos.{{ $index }}.id">
                
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Nombre Completo</label>
                    <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.nombre" placeholder="ej: Juan Pérez" class="w-full text-xs font-bold h-9 rounded-none" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Relación / Vínculo</label>
                    <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.relacion" placeholder="ej: Propietario, Vecino" class="w-full text-xs font-medium h-9 rounded-none" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Teléfono</label>
                    <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.telefono" placeholder="10 dígitos" class="w-full text-xs font-mono font-bold h-9 rounded-none" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Correo Electrónico</label>
                    <x-shared::form.text-input type="email" wire:model="contactos.{{ $index }}.correo" placeholder="ejemplo@mail.com" class="w-full text-xs font-medium h-9 rounded-none" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 dark:text-gray-550 uppercase tracking-wider mb-1">Notas Cortas</label>
                    <x-shared::form.text-input type="text" wire:model="contactos.{{ $index }}.notes" placeholder="ej: Horarios de atención" class="w-full text-xs font-medium h-9 rounded-none" />
                </div>

                <div class="md:col-span-1 flex items-end justify-center pb-0.5">
                    <button type="button" wire:click="removeContacto({{ $index }})" class="h-9 w-full border border-red-200 dark:border-red-900/30 bg-red-50/50 hover:bg-red-100 text-red-600 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/50 transition-colors flex items-center justify-center rounded-none shadow-xs">
                        <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>