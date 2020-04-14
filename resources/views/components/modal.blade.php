<div
    x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }" 
    x-show="open" 
    {{ $attributes->merge(['class' => 'fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center']) }}
    @toggle-modal.window="if ($event.detail.id === '{{ $id }}') { open = !open; $event.stopPropagation() }"
    @if ($escClose)
        @keydown.escape.window="open = false"
    @endif
>
    <div   
        x-show="open" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0" 
        class="fixed inset-0 transition-opacity"
    >
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>
    
    <div 
        @if ($clickOutside)
            @click.away="open = false"
        @endif
        x-show="open" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
        class="bg-white dark:bg-gray-800 rounded px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-xl sm:w-full sm:p-6"
    >
        {{ $slot }}
        <button @click.prevent="open = false" type="button">Close</button>
    </div>
</div>