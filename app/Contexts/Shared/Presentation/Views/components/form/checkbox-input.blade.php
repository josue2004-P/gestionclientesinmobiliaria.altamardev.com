@props([
    'disabled' => false,
    'messages' => [],
    'label' => '',
    'description' => null
])

@php
    $hasError = !empty($messages);

    $baseClasses = 'relative flex items-center justify-between min-h-[2.75rem] w-full rounded-xl border p-3.5 cursor-pointer transition-all duration-200 select-none shadow-xs';
    
    $stateClasses = $hasError
        ? 'border-red-300 dark:border-red-500/40 bg-red-50/50 dark:bg-red-950/10 hover:border-red-400'
        : 'border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 hover:border-indigo-500/50 dark:hover:border-indigo-500/50 hover:bg-gray-50/50 dark:hover:bg-gray-900/50';

    $disabledClasses = $disabled 
        ? 'opacity-60 cursor-not-allowed pointer-events-none bg-gray-100 dark:bg-gray-900' 
        : '';
@endphp

<div>
    <label class="{{ $baseClasses }} {{ $stateClasses }} {{ $disabledClasses }} focus-within:ring-2 focus-within:ring-indigo-500/20">
        
        {{-- Textos y Etiquetas --}}
        <div class="pr-3 flex flex-col justify-center">
            @if($label)
                <span class="text-xs font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wide">
                    {{ $label }}
                </span>
            @endif

            @if($description || $slot->isNotEmpty())
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mt-0.5">
                    {{ $description ?? $slot }}
                </p>
            @endif
        </div>

        {{-- Checkbox Input con Attributes para Livewire --}}
        <input 
            type="checkbox" 
            @disabled($disabled)
            {{ $attributes->merge([
                'class' => 'h-5 w-5 shrink-0 rounded border-gray-300 dark:border-gray-700 text-indigo-600 dark:text-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:bg-gray-900 transition-all cursor-pointer'
            ]) }}
        >
    </label>

    {{-- Error de validación --}}
    @if($hasError)
        <x-shared::form.input-error :messages="$messages" class="mt-1.5" />
    @endif
</div>