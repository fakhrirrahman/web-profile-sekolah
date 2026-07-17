<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin - '.config('app.name', 'Golden Sierra School') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface font-sans text-slate-700 antialiased">
    <div class="min-h-dvh lg:grid lg:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="border-b-2 border-primary/10 bg-primary text-white lg:sticky lg:top-0 lg:h-dvh lg:border-b-0 lg:border-r-2">
            <div class="flex h-full flex-col px-4 py-4 lg:px-5 lg:py-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg focus-ring">
                    <span class="grid size-11 shrink-0 place-items-center rounded-lg border-2 border-white/70 bg-white text-xs font-black text-primary shadow-[4px_4px_0_rgba(0,0,0,.16)]">
                        GS
                    </span>
                    <span class="min-w-0">
                        <span class="brand-wordmark block truncate text-lg text-white">Admin Sekolah</span>
                        <span class="brand-tagline text-white/72">Golden Sierra</span>
                    </span>
                </a>

                <nav class="mt-6 grid gap-2 text-sm font-black lg:mt-10" aria-label="Navigasi admin">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg border-2 border-white/18 bg-white px-4 py-3 text-primary shadow-[4px_4px_0_rgba(0,0,0,.14)]">
                        <x-ui.icon name="layout-dashboard" class="size-5" />
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 text-white/84 transition hover:bg-white/10 hover:text-white">
                        <x-ui.icon name="newspaper" class="size-5" />
                        Berita
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 text-white/84 transition hover:bg-white/10 hover:text-white">
                        <x-ui.icon name="image" class="size-5" />
                        Galeri
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 text-white/84 transition hover:bg-white/10 hover:text-white">
                        <x-ui.icon name="calendar" class="size-5" />
                        PPDB
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 text-white/84 transition hover:bg-white/10 hover:text-white">
                        <x-ui.icon name="settings" class="size-5" />
                        Pengaturan
                    </a>
                </nav>

                <div class="mt-6 rounded-lg border border-white/18 bg-white/10 p-4 lg:mt-auto">
                    <p class="text-xs font-black uppercase tracking-[0.16em] text-accent">Login sebagai</p>
                    <p class="mt-2 truncate text-sm font-black text-white">{{ auth()->user()->name }}</p>
                    <p class="mt-1 truncate text-xs font-semibold text-white/70">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </aside>

        <div class="min-w-0">
            <header class="sticky top-0 z-40 border-b-2 border-primary/10 bg-surface/94 backdrop-blur">
                <div class="flex min-h-16 items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Portal Admin</p>
                        <h1 class="text-lg font-black text-primary sm:text-xl">{{ $heading ?? 'Dashboard' }}</h1>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ url('/') }}" class="grid size-10 place-items-center rounded-lg border-2 border-primary/15 bg-white text-primary shadow-[3px_3px_0_rgba(31,92,69,.08)] transition hover:bg-secondary-muted" aria-label="Buka beranda">
                            <x-ui.icon name="home" class="size-5" />
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="grid size-10 place-items-center rounded-lg border-2 border-primary/15 bg-white text-primary shadow-[3px_3px_0_rgba(31,92,69,.08)] transition hover:border-red-200 hover:bg-red-50 hover:text-red-700" aria-label="Keluar">
                                <x-ui.icon name="log-out" class="size-5" />
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
