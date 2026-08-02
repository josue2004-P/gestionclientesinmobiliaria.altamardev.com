@props([
    'size' => 'md',          
    'variant' => 'primary',
    'startIcon' => null,
    'endIcon' => null,
    'className' => '',
    'disabled' => false,
    'href' => null,
])

@php
    $base = 'inline-flex items-center justify-center font-medium gap-2 rounded-lg transition-colors duration-200';

    // Manejo exclusivo de tamaños (padding y tamaño de fuente)
    $sizeMap = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
    ];
    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];

    // Manejo exclusivo de variantes de color (sin interferir en el padding)
    $variantMap = [
        'primary'   => 'bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600',
        'secondary' => 'bg-white text-indigo-600 hover:bg-indigo-50 border border-indigo-200',
        'outline'   => 'bg-white text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03] dark:hover:text-gray-300',
    ];

    $variantClass = $variantMap[$variant] ?? $variantMap['primary'];

    $disabledClass = $disabled ? 'cursor-not-allowed opacity-50 pointer-events-none' : '';

    $classes = trim("{$base} {$sizeClass} {$variantClass} {$className} {$disabledClass}");
    
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
    {{ $attributes->merge([
        'class' => $classes, 
        'type' => $href ? null : $attributes->get('type', 'button'),
        'href' => $href
    ]) }}
    @if($disabled && !$href) disabled @endif
    @if($disabled && $href) aria-disabled="true" @endif
>
    @hasSection('startIcon')
        <span class="flex items-center text-current">
            @yield('startIcon')
        </span>
    @elseif($startIcon)
        <span class="flex items-center text-current">{!! $startIcon !!}</span>
    @endif

    {{ $slot }}

    @hasSection('endIcon')
        <span class="flex items-center text-current">
            @yield('endIcon')
        </span>
    @elseif($endIcon)
        <span class="flex items-center text-current">{!! $endIcon !!}</span>
    @endif
</{{ $tag }}>