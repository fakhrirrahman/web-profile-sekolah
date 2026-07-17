@props([
    'id' => 'modal',
])

<div x-data="{ open: false }" 
    @open-modal.window="if ($event.detail.id === '{{ $id }}') open = true"
    @close-modal.window="if ($event.detail.id === '{{ $id }}' || $event.detail.id === 'all') open = false"
    class="relative">
    
    <!-- Trigger slot (optional) -->
    <div>
        {{ $trigger ?? '' }}
    </div>

    <!-- Modal backdrop & container -->
    <template x-if="open">
        <div x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click.self="open = false; document.dispatchEvent(new CustomEvent('close-modal', { detail: { id: '{{ $id }}' } }))"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
            
            <!-- Modal content -->
            <div x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.stop
                @keydown.escape="open = false; document.dispatchEvent(new CustomEvent('close-modal', { detail: { id: '{{ $id }}' } }))"
                class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-lg border-2 border-primary/12 bg-white shadow-[6px_6px_0_rgba(31,92,69,.12)]">
                
                <!-- Close button -->
                <button @click="open = false; document.dispatchEvent(new CustomEvent('close-modal', { detail: { id: '{{ $id }}' } }))"
                    class="absolute right-4 top-4 z-10 p-1 text-slate-400 transition hover:text-slate-600 hover:bg-slate-100 rounded-md"
                    aria-label="Tutup modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6l-12 12M6 6l12 12" />
                    </svg>
                </button>

                <!-- Modal slot -->
                <div class="p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </template>
</div>
