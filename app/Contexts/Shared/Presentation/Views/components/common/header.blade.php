@props([
    'title',
    'desc' => null,
    'icon' => 'fa-shield-halved',
    'breadcrumb' => [] 
])

<div {{ $attributes->merge(['class' => 'mb-8 sm:mb-8 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 font-sans']) }}>
    <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-5 text-left">
        <div class="h-12 w-12 flex-shrink-0 rounded-md bg-indigo-50/50 dark:bg-indigo-500/5 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-indigo-100/50 dark:border-indigo-500/10 shadow-sm transition-transform duration-200 hover:scale-105">
            <i class="fa-solid {{ $icon }} text-lg"></i>
        </div>
        
        <div class="space-y-1">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white tracking-tight leading-tight transition-colors">
                {{ $title }}
            </h1>
            @if($desc)
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 max-w-xl transition-colors">
                    {{ $desc }}
                </p>
            @endif
        </div>
    </div>

    @if(!empty($breadcrumb))
        <nav class="flex flex-wrap items-center justify-start gap-x-2 gap-y-1 text-sm font-semibold border-t border-gray-100 pt-3 lg:border-none lg:pt-0 transition-colors">
            @foreach($breadcrumb as $item)
                <div class="flex items-center gap-2">
                    @if(!empty($item['url']))
                        <a href="{{ $item['url'] }}" class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400 transition-colors whitespace-nowrap">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-gray-800 dark:text-gray-200 font-semibold whitespace-nowrap">
                            {{ $item['label'] }}
                        </span>
                    @endif
                    
                    @if(!$loop->last)
                        <i class="fa-solid fa-chevron-right text-[8px] text-gray-400 dark:text-gray-600 opacity-60"></i>
                    @endif
                </div>
            @endforeach
        </nav>
    @endif
</div>