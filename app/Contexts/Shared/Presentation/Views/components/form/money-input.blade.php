@props([
    'disabled' => false,
    'messages' => [],
    'placeholder' => '0.00'
])

<div 
    x-data="{
        rawValue: @entangle($attributes->wire('model')),
        displayValue: '',

        formatMoney(val) {
            if (val === null || val === undefined || val === '') return '';
            
            // Convertimos a string y eliminamos caracteres no numéricos excepto el punto
            let cleanVal = val.toString().replace(/[^0-9.]/g, '');
            
            // Prevenimos múltiples puntos
            let parts = cleanVal.split('.');
            if (parts.length > 2) {
                cleanVal = parts[0] + '.' + parts.slice(1).join('');
                parts = cleanVal.split('.');
            }

            let integerPart = parts[0];
            let decimalPart = parts[1] !== undefined ? parts[1].substring(0, 2) : null;

            // Formatear enteros con comas
            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            if (integerPart === '' && decimalPart === null) return '';

            return '$ ' + (decimalPart !== null ? `${integerPart}.${decimalPart}` : integerPart);
        },

        updateValues(inputVal) {
            if (!inputVal) {
                this.displayValue = '';
                this.rawValue = null;
                return;
            }

            // Extraer solo dígitos y un punto decimal
            let cleanVal = inputVal.replace(/[^0-9.]/g, '');
            
            // Evitamos que haya más de un punto decimal
            let parts = cleanVal.split('.');
            if (parts.length > 2) {
                cleanVal = parts[0] + '.' + parts.slice(1).join('');
            }

            // Sincronizar el valor numérico (raw) hacia Livewire
            this.rawValue = cleanVal !== '' ? parseFloat(cleanVal) : null;

            // Formatear para la vista
            this.displayValue = this.formatMoney(cleanVal);
        }
    }"
    x-init="
        displayValue = formatMoney(rawValue);
        $watch('rawValue', value => {
            // Sincroniza en caso de que el valor cambie externamente por Livewire
            if (document.activeElement !== $refs.moneyInput) {
                displayValue = formatMoney(value);
            }
        });
    "
    class="relative w-full"
>
    <input
        x-ref="moneyInput"
        type="text"
        x-model="displayValue"
        @input="updateValues($event.target.value)"
        @blur="displayValue = formatMoney(rawValue)"
        @disabled($disabled)
        placeholder="$ {{ $placeholder }}"
        {{ $attributes->whereDoesntStartWith('wire:model')->merge([
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
    />
</div>