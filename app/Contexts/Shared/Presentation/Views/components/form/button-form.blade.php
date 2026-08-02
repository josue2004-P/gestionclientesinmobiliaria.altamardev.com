@props([
    'size' => 'md',          
    'variant' => 'primary', // primary | secondary | outline | danger
    'startIcon' => null,
    'endIcon' => null,
    'disabled' => false,
    'href' => null,
])

@php
    $base = 'inline-flex items-center justify-center font-medium gap-2 rounded-lg transition-colors duration-200';

    $sizeMap = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
    ];
    $sizeClass = $sizeMap[$size] ?? $sizeMap['md'];

    // Se añadió la variante 'danger'
    $variantMap = [
        'primary'   => 'bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600',
        'secondary' => 'bg-white text-indigo-600 hover:bg-indigo-50 border border-indigo-200 dark:bg-gray-900 dark:text-indigo-400 dark:border-indigo-500/20',
        'outline'   => 'bg-white text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03] dark:hover:text-gray-300',
        'danger'    => 'bg-red-50 text-red-600 hover:bg-red-600 hover:text-white dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white border border-red-100 dark:border-red-500/20',
    ];

    $variantClass = $variantMap[$variant] ?? $variantMap['primary'];
    $disabledClass = $disabled ? 'cursor-not-allowed opacity-50 pointer-events-none' : '';

    $classes = trim("{$base} {$sizeClass} {$variantClass} {$disabledClass}");
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