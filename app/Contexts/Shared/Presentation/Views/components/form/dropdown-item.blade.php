@props([
    'icon' => null,
    'href' => null,
    'variant' => 'default', // default | danger
])

@php
    $base = 'flex w-full items-center px-3 py-2.5 text-sm font-semibold rounded-md transition-colors group/item';

    $variants = [
        'default' => [
            'class' => 'text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-indigo-600 dark:hover:text-indigo-400',
            'icon'  => 'text-gray-400 dark:text-gray-500 group-hover/item:text-indigo-500 dark:group-hover/item:text-indigo-400',
        ],
        'danger' => [
            'class' => 'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 hover:text-red-700 dark:hover:text-red-300',
            'icon'  => 'text-red-400 dark:text-red-500 group-hover/item:text-red-500 dark:group-hover/item:text-red-400',
        ],
    ];

    $selectedVariant = $variants[$variant] ?? $variants['default'];
    $variantClass = $selectedVariant['class'];
    $iconColorClass = $selectedVariant['icon'];

    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @else type="button" @endif
    {{ $attributes->merge(['class' => "{$base} {$variantClass}"]) }}
>
    @if($icon)
        <i class="{{ $icon }} mr-3 text-sm {{ $iconColorClass }} transition-colors"></i>
    @endif
    {{ $slot }}
</{{ $tag }}>