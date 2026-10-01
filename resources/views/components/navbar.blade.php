@php
    $navLinks = [
        ['label' => 'Beranda', 'href' => url('/'), 'active' => request()->is('/')],
        ['label' => 'Profil', 'href' => url('/profile'), 'active' => request()->is('profile')],
        ['label' => 'Berita', 'href' => url('/berita'), 'active' => request()->is('berita')],
        ['label' => 'Pengumuman', 'href' => url('/pengumuman'), 'active' => request()->is('pengumuman*')],
        // ['label' => 'PPDB', 'href' => url('/ppdb'), 'active' => request()->is('ppdb')],
        ['label' => 'Galeri', 'href' => url('/galeri'), 'active' => request()->is('galeri')],
        ['label' => 'Kontak', 'href' => url('/kontak'), 'active' => request()->is('kontak')],
    ];
@endphp

<header data-site-header class="sticky top-0 z-50 border-b-2 border-primary/12 bg-surface/95 text-primary shadow-sm backdrop-blur transition duration-300 data-[scrolled]:bg-surface data-[scrolled]:shadow-[0_4px_0_rgba(31,92,69,.12)]">
    <div class="section-shell flex h-18 items-center justify-between gap-4 py-3">
        <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3 focus-ring rounded-lg">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SD Muhammadiyah Pepe" class="size-15 shrink-0 rounded-lg object-contain">
            <span class="min-w-0">
                <span class="brand-wordmark block truncate text-lg text-primary sm:text-2xl">
                    SD Muhammadiyah <span class="brand-accent">Pepe</span>
                </span>
                
            </span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Navigasi utama">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}" class="rounded-md text-xs font-black uppercase tracking-[0.14em] transition hover:text-secondary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 focus-visible:ring-offset-surface {{ $link['active'] ? 'text-primary' : 'text-primary/75' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <x-ui.button href="{{ url('/ppdb') }}" variant="accent" size="sm">PPDB</x-ui.button>
            <x-ui.button href="{{ route('login') }}" variant="muted" size="sm">Login</x-ui.button>
        </div>

        <details data-mobile-menu class="group relative lg:hidden">
            <summary class="grid size-10 cursor-pointer list-none place-items-center rounded-md border-2 border-primary/20 bg-white text-primary transition hover:bg-secondary-muted [&::-webkit-details-marker]:hidden" aria-label="Buka menu">
                <span class="relative block h-3.5 w-5">
                    <span class="absolute left-0 top-0 h-0.5 w-5 rounded bg-current transition group-open:top-1.5 group-open:rotate-45"></span>
                    <span class="absolute left-0 top-1.5 h-0.5 w-5 rounded bg-current transition group-open:opacity-0"></span>
                    <span class="absolute left-0 top-3 h-0.5 w-5 rounded bg-current transition group-open:top-1.5 group-open:-rotate-45"></span>
                </span>
            </summary>

            <div class="absolute right-0 mt-3 w-72 overflow-hidden rounded-lg border border-slate-200 bg-white text-slate-800 shadow-xl">
                <nav class="grid py-2" aria-label="Navigasi mobile">
                    @foreach ($navLinks as $link)
                        <a href="{{ $link['href'] }}" class="px-4 py-3 text-sm font-semibold uppercase tracking-wide transition hover:bg-slate-50 hover:text-secondary {{ $link['active'] ? 'bg-secondary-muted text-primary' : '' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <div class="grid gap-2 border-t border-slate-100 p-3">
                        <x-ui.button href="{{ url('/ppdb') }}" variant="accent" class="w-full" size="sm">Daftar PPDB</x-ui.button>
                        <x-ui.button href="{{ route('login') }}" class="w-full" size="sm">Login</x-ui.button>
                    </div>
                </nav>
            </div>
        </details>
    </div>
</header>
