@php
    $navLinks = [
        ['label' => 'Beranda', 'href' => '#beranda'],
        ['label' => 'Profil', 'href' => '#profil'],
        ['label' => 'Berita', 'href' => '#berita'],
        ['label' => 'PPDB', 'href' => '#ppdb'],
        ['label' => 'Galeri', 'href' => '#galeri'],
        ['label' => 'Kontak', 'href' => '#kontak'],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-white/10 bg-primary/95 text-white shadow-sm backdrop-blur">
    <div class="section-shell flex h-18 items-center justify-between gap-4 py-3">
        <a href="#beranda" class="flex min-w-0 items-center gap-3 focus-ring rounded-lg">
            <span class="grid size-12 shrink-0 place-items-center rounded-lg border border-white/20 bg-white text-sm font-black text-primary shadow-sm">
                GS
            </span>
            <span class="min-w-0">
                <span class="block truncate font-serif text-lg font-bold leading-tight tracking-wide text-white sm:text-xl">
                    Golden Sierra School
                </span>
                <span class="hidden text-xs font-semibold uppercase tracking-[0.18em] text-accent sm:block">
                    Learn. Lead. Serve.
                </span>
            </span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Navigasi utama">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}" class="rounded-md text-xs font-bold uppercase tracking-[0.14em] text-white/80 transition hover:text-accent focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 focus-visible:ring-offset-primary">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <x-ui.button href="#ppdb" variant="accent" size="sm">Daftar PPDB</x-ui.button>
            <x-ui.button href="#login" variant="muted" size="sm">Login</x-ui.button>
        </div>

        <details class="group relative lg:hidden">
            <summary class="grid size-10 cursor-pointer list-none place-items-center rounded-md border border-white/20 text-white transition hover:bg-white/10 [&::-webkit-details-marker]:hidden" aria-label="Buka menu">
                <span class="relative block h-3.5 w-5">
                    <span class="absolute left-0 top-0 h-0.5 w-5 rounded bg-current transition group-open:top-1.5 group-open:rotate-45"></span>
                    <span class="absolute left-0 top-1.5 h-0.5 w-5 rounded bg-current transition group-open:opacity-0"></span>
                    <span class="absolute left-0 top-3 h-0.5 w-5 rounded bg-current transition group-open:top-1.5 group-open:-rotate-45"></span>
                </span>
            </summary>

            <div class="absolute right-0 mt-3 w-72 overflow-hidden rounded-lg border border-slate-200 bg-white text-slate-800 shadow-xl">
                <nav class="grid py-2" aria-label="Navigasi mobile">
                    @foreach ($navLinks as $link)
                        <a href="{{ $link['href'] }}" class="px-4 py-3 text-sm font-semibold uppercase tracking-wide transition hover:bg-slate-50 hover:text-secondary">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <div class="grid gap-2 border-t border-slate-100 p-3">
                        <x-ui.button href="#ppdb" variant="accent" class="w-full" size="sm">Daftar PPDB</x-ui.button>
                        <x-ui.button href="#login" class="w-full" size="sm">Login</x-ui.button>
                    </div>
                </nav>
            </div>
        </details>
    </div>
</header>
