@props([
    'id' => 'datepicker-' . uniqid(),
    'mode' => 'single', // 'single', 'multiple', 'range', 'time'
    'defaultDate' => null,
    'label' => null,
    'placeholder' => 'Select date',
    'name' => null,
    'dateFormat' => 'Y-m-d',
    'messages' => [],
])

{{-- 🟢 REMOVEMOS X-DESTROY Y SOLUCIONAMOS CON CLEANUP FUNCTION EN X-INIT --}}
<div x-data="{
    flatpickrInstance: null,
    value: @entangle($attributes->wire('model')),
    
    init() {
        this.$nextTick(() => {
            if (this.flatpickrInstance) {
                this.flatpickrInstance.destroy();
            }

            this.flatpickrInstance = flatpickr(this.$refs.dateInput, {
                mode: '{{ $mode }}',
                static: true,
                monthSelectorType: 'static',
                dateFormat: '{{ $dateFormat }}',
                defaultDate: this.value ? this.value : {{ $defaultDate ? (is_array($defaultDate) ? json_encode($defaultDate) : "'" . $defaultDate . "'") : 'null' }},
                onChange: (selectedDates, dateStr, instance) => {
                    this.value = dateStr;
                    this.$dispatch('date-change', { selectedDates, dateStr, instance });
                }
            });

            this.$watch('value', (newValue) => {
                if (this.flatpickrInstance && newValue !== this.flatpickrInstance.input.value) {
                    this.flatpickrInstance.setDate(newValue, false);
                }
            });
        });

        {{-- 🟢 RETORNAR UNA FUNCIÓN GARANTIZA QUE SOLO SE DESTRUYA SI EL COMPONENTE SE BORRA FÍSICAMENTE --}}
        return () => {
            if (this.flatpickrInstance) {
                this.flatpickrInstance.destroy();
                this.flatpickrInstance = null;
            }
        }
    }
}" x-init="init()">
    @if($label)
        <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <div class="relative custom-datepicker">
        <input
            x-ref="dateInput"
            type="text"
            id="{{ $id }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->whereDoesntStartWith('wire:model')->merge([
                'class' => "h-11 w-full rounded-lg border appearance-none px-4 py-2.5 text-sm shadow-theme-xs placeholder:text-gray-400 focus:outline-hidden focus:ring-3 bg-transparent text-gray-800 focus:border-brand-300 focus:ring-brand-500/20 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 " . 
                ($messages 
                    ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10 text-red-650' 
                    : 'border-gray-300 dark:border-gray-700 dark:focus:border-brand-800'
                )
            ]) }}
            autocomplete="off"
        />
        
        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none gap-2">
            @if ($messages)
                <svg class="text-red-500 dark:text-red-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99992 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z" fill="currentColor" />
                </svg>
            @endif

            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" class="size-6 text-gray-500 dark:text-gray-400">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
</div>