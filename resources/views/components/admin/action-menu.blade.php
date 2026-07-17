<details
    x-data
    data-admin-action-menu
    @toggle="if ($el.open) document.querySelectorAll('[data-admin-action-menu]').forEach((menu) => { if (menu !== $el) menu.removeAttribute('open') })"
    @click.outside="$el.removeAttribute('open')"
    class="group relative inline-block text-left"
>
    <summary class="grid size-9 cursor-pointer list-none place-items-center rounded-lg border-2 border-primary/15 bg-white text-primary shadow-[3px_3px_0_rgba(31,92,69,.08)] transition hover:bg-secondary-muted [&::-webkit-details-marker]:hidden" aria-label="Buka menu aksi">
        <x-ui.icon name="more-vertical" class="size-5" />
    </summary>

    <div class="absolute right-0 z-30 mt-2 min-w-36 rounded-lg border-2 border-primary/12 bg-white p-2 text-left shadow-[6px_6px_0_rgba(31,92,69,.12)]">
        <div class="grid gap-1">
            {{ $slot }}
        </div>
    </div>
</details>
