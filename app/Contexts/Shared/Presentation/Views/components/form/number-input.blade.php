@props([
    'disabled' => false,
    'messages' => [],
    'placeholder' => '0',
    'min' => null,
    'max' => null
])

<div class="relative w-full">
    <input
        type="text"
        inputmode="numeric"
        pattern="[0-9]*"
        @disabled($disabled)
        placeholder="{{ $placeholder }}"
        @keydown="['Backspace', 'Tab', 'Delete', 'Escape', 'Enter', 'ArrowLeft', 'ArrowRight', 'Home', 'End'].includes($event.key) || /^[0-9]$/.test($event.key) || $event.preventDefault()"
        @paste="/^\d+$/.test(($event.clipboardData || window.clipboardData).getData('text')) || $event.preventDefault()"
        {{ $attributes->merge([
            'class' => "
                dark:bg-dark-900 shadow-theme-xs
                focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800
                h-11 w-full rounded-md border
                " . ($messages ? 'border-red-300 text-error-600' : 'border-gray-300 text-gray-800 dark:border-gray-700 dark:bg-gray-900') . "
                bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400
                focus:ring-3 focus:outline-hidden 
                dark:text-white/90 dark:placeholder:text-white/30
            "
        ]) }}
    >
</div>