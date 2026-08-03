<div class="md:col-span-3 pt-6 mt-6 border-t border-dashed border-gray-200 dark:border-gray-800">
    <livewire:documentos-manager 
        :cliente-id="$clienteId ?? null" 
        :documentos="$documentos" 
        :key="'doc-manager-' . ($clienteId ?? 'new')" 
    />
</div>