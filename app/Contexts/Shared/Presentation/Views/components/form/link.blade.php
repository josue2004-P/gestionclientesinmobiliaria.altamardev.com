@props([
    'href' => '#',
    'danger' => false,
])

@php
    $colorClasses = $danger 
        ? 'text-gray-500 hover:text-red-550 dark:text-gray-400 dark:hover:text-red-400' 
        : 'text-brand-500 hover:text-brand-600 dark:text-brand-400 dark:hover:text-brand-300';
@endphp

<a href="{{ $href }}" 
    {{ $attributes->merge([
        'class' => "text-sm font-medium {$colorClasses} transition-colors duration-200"
    ]) }}>
    {{ $slot }}
</a>