<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full overflow-hidden scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ $title ?? 'Auth - '.config('app.name', 'Golden Sierra School') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-dvh overflow-hidden bg-primary font-sans text-slate-700 antialiased">
    <main class="relative h-dvh overflow-hidden">
        <img
            src="{{ asset('images/home.jpg') }}"
            alt="Gedung Golden Sierra School"
            class="absolute inset-0 size-full object-cover"
        >
        <div class="absolute inset-0 bg-[linear-gradient(115deg,rgba(23,70,52,.96)_0%,rgba(31,92,69,.88)_40%,rgba(31,92,69,.54)_63%,rgba(247,245,239,.96)_63.2%,rgba(247,245,239,.98)_100%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(0deg,rgba(0,0,0,.28),rgba(0,0,0,0)_42%,rgba(0,0,0,.18))]"></div>

        <div class="relative mx-auto flex h-full w-full max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
            <header class="flex items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3 rounded-lg text-white focus-ring">
                    <span class="grid size-11 shrink-0 place-items-center rounded-lg border-2 border-white/75 bg-white text-xs font-black text-primary shadow-[5px_5px_0_rgba(0,0,0,.18)] sm:size-12 sm:text-sm">
                        GS
                    </span>
                    <span class="min-w-0">
                        <span class="brand-wordmark block truncate text-lg text-white sm:text-xl">
                            Golden Sierra <span class="text-accent">School</span>
                        </span>
                        <span class="brand-tagline text-white/78">
                            Learn. Lead. Serve.
                        </span>
                    </span>
                </a>

                <a href="{{ url('/') }}" class="rounded-md border-2 border-primary/15 bg-white px-4 py-2 text-xs font-black uppercase tracking-wide text-primary shadow-[4px_4px_0_rgba(31,92,69,.12)] transition hover:border-primary/35 hover:bg-secondary-muted">
                    Beranda
                </a>
            </header>

            <section class="grid min-h-0 flex-1 items-center gap-8 py-5 lg:grid-cols-[minmax(0,1fr)_460px] xl:grid-cols-[minmax(0,1fr)_500px]">
                <div class="max-w-2xl text-white">
                    <p class="inline-flex rounded-lg border border-white/25 bg-white/12 px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-accent shadow-[3px_3px_0_rgba(0,0,0,.14)] backdrop-blur">
                        Portal Sekolah
                    </p>
                    <h1 class="mt-6 max-w-2xl text-5xl font-black leading-tight text-white sm:text-6xl lg:text-7xl">
                        Portal digital Golden Sierra.
                    </h1>
                    <p class="mt-6 max-w-xl text-base leading-8 text-white/84 sm:text-lg">
                        Masuk untuk mengakses informasi akademik, administrasi, dan komunikasi sekolah dengan tampilan yang lebih tertata.
                    </p>

                    <div class="mt-10 grid max-w-2xl gap-3 sm:grid-cols-3">
                        <div class="border-l-4 border-accent bg-white/10 px-4 py-3 backdrop-blur">
                            <p class="text-2xl font-black text-accent">01</p>
                            <p class="mt-1 text-xs font-black uppercase tracking-wide text-white/82">Akademik</p>
                        </div>
                        <div class="border-l-4 border-accent bg-white/10 px-4 py-3 backdrop-blur">
                            <p class="text-2xl font-black text-accent">02</p>
                            <p class="mt-1 text-xs font-black uppercase tracking-wide text-white/82">Administrasi</p>
                        </div>
                        <div class="border-l-4 border-accent bg-white/10 px-4 py-3 backdrop-blur">
                            <p class="text-2xl font-black text-accent">03</p>
                            <p class="mt-1 text-xs font-black uppercase tracking-wide text-white/82">Komunikasi</p>
                        </div>
                    </div>
                </div>

                <section class="w-full">
                    <div class="rounded-lg border-2 border-primary/14 bg-white/96 p-6 shadow-[10px_10px_0_rgba(23,70,52,.14)] backdrop-blur sm:p-8">
                        @yield('auth-content')
                    </div>
                </section>
            </section>
        </div>
    </main>
</body>
</html>
