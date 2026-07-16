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

<header class="sticky top-0 z-50 border-b border-teal-900/10 bg-school-teal text-white shadow-sm">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="#beranda" class="flex min-w-0 items-center gap-3">
            <span class="grid size-11 shrink-0 place-items-center rounded-full border-2 border-school-navy bg-school-gold/90 text-xs font-black text-school-navy shadow-inner">
                GSS
            </span>
            <span class="truncate font-serif text-lg font-semibold tracking-wide text-school-cream sm:text-xl">
                Golden Sierra School
            </span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Navigasi utama">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}" class="text-xs font-semibold uppercase tracking-[0.14em] text-white/90 transition hover:text-school-gold">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <x-ui.button href="#login" variant="cream" size="sm">Login</x-ui.button>
        </div>

        <details class="group relative lg:hidden">
            <summary class="grid size-10 cursor-pointer list-none place-items-center rounded-md border border-white/20 text-white transition hover:bg-white/10 [&::-webkit-details-marker]:hidden" aria-label="Buka menu">
                <span class="relative block h-3.5 w-5">
                    <span class="absolute left-0 top-0 h-0.5 w-5 rounded bg-current transition group-open:top-1.5 group-open:rotate-45"></span>
                    <span class="absolute left-0 top-1.5 h-0.5 w-5 rounded bg-current transition group-open:opacity-0"></span>
                    <span class="absolute left-0 top-3 h-0.5 w-5 rounded bg-current transition group-open:top-1.5 group-open:-rotate-45"></span>
                </span>
            </summary>

            <div class="absolute right-0 mt-3 w-64 overflow-hidden rounded-lg border border-teal-900/10 bg-white text-slate-800 shadow-xl">
                <nav class="grid py-2" aria-label="Navigasi mobile">
                    @foreach ($navLinks as $link)
                        <a href="{{ $link['href'] }}" class="px-4 py-3 text-sm font-semibold uppercase tracking-wide transition hover:bg-slate-50 hover:text-school-teal">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <div class="border-t border-slate-100 p-3">
                        <x-ui.button href="#login" class="w-full justify-center" size="sm">Login</x-ui.button>
                    </div>
                </nav>
            </div>
        </details>
    </div>
</header>
