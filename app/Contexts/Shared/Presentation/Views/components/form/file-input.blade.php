@props([
    'id' => 'file-' . uniqid(),
    'label' => null,
    'messages' => [],
    'required' => false,
    'accept' => '*/*',
    'file' => null,
])

<div class="w-full">
    @if($label)
        <x-shared::form.input-label :for="$id" :value="$label" :required="$required" />
    @endif

    <div 
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        class="mt-1.5 relative"
    >
        <div class="flex items-center gap-2 bg-white dark:bg-gray-900 px-3 border h-11 rounded-md shadow-xs transition-colors duration-200 {{ 
            $messages 
                ? 'border-red-300 dark:border-red-800' 
                : 'border-gray-300 dark:border-gray-700 focus-within:border-brand-300 dark:focus-within:border-brand-800' 
        }}">
            
            <input 
                id="{{ $id }}"
                type="file" 
                accept="{{ $accept }}"
                {{ $attributes->merge([
                    'class' => 'w-full text-xs font-semibold text-gray-500 dark:text-gray-400 file:mr-3 file:py-1 file:px-2.5 file:border-0 file:text-xs file:font-bold file:bg-gray-100 dark:file:bg-gray-800 file:text-gray-700 dark:file:text-gray-300 file:rounded-md hover:file:bg-gray-200 dark:hover:file:bg-gray-700 outline-none cursor-pointer'
                ]) }}
            />

            {{-- Indicador de Carga --}}
            <div x-show="isUploading" class="flex items-center gap-2 text-indigo-600 dark:text-indigo-400 text-xs font-medium shrink-0">
                <i class="fa-solid fa-circle-notch animate-spin"></i>
                <span x-text="progress + '%'" class="text-[10px] font-mono font-bold"></span>
            </div>

            {{-- Previsualización temporal segura --}}
            @if ($file && is_object($file) && method_exists($file, 'temporaryUrl'))
                @php
                    $tempUrl = null;
                    try {
                        $tempUrl = $file->temporaryUrl();
                    } catch (\Throwable $e) {
                        $tempUrl = null;
                    }
                @endphp

                <div x-show="!isUploading" class="shrink-0">
                    @if ($tempUrl)
                        <a 
                            href="{{ $tempUrl }}" 
                            target="_blank" 
                            class="inline-flex items-center gap-1.5 px-2 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 rounded transition-colors text-xs font-bold" 
                            title="Ver archivo temporal"
                        >
                            <i class="fa-solid fa-eye animate-pulse text-[11px]"></i> 
                            <span class="text-[10px] font-bold uppercase tracking-wider">Ver</span>
                        </a>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded text-[10px] font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-paperclip text-[10px]"></i> Listo
                        </span>
                    @endif
                </div>
            @endif
        </div>

        {{-- Barra de Progreso --}}
        <div x-show="isUploading" class="w-full bg-gray-200 dark:bg-gray-800 h-1 rounded-full overflow-hidden mt-1">
            <div class="bg-indigo-500 h-full transition-all duration-150" :style="'width: ' + progress + '%'"></div>
        </div>
    </div>

    <x-shared::form.input-error :messages="$messages" class="mt-1.5" />
</div>