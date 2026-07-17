<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin - '.config('app.name', 'Golden Sierra School') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gs-confirm-popup{width:min(100% - 2rem,32rem)!important;padding:1.5rem!important;border:2px solid rgba(31,92,69,.16)!important;border-radius:.5rem!important;background:#fff!important;color:#25362f!important;font-family:Inter,ui-sans-serif,system-ui,sans-serif!important;box-shadow:8px 8px 0 rgba(31,92,69,.14)!important}
        .gs-confirm-title{margin:0!important;color:#1f5c45!important;font-family:Inter,ui-sans-serif,system-ui,sans-serif!important;font-size:1.35rem!important;font-weight:900!important;line-height:1.2!important}
        .gs-confirm-html{margin:.75rem 0 0!important;color:#647067!important;font-size:.92rem!important;font-weight:650!important;line-height:1.7!important;text-align:left!important}
        .gs-confirm-badge{display:inline-flex;align-items:center;margin-bottom:.9rem;border-left:4px solid #d9b45c;background:#f7f5ef;padding:.55rem .75rem;color:#2b7357;font-size:.68rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase}
        .gs-confirm-actions{margin-top:1.4rem!important;gap:.7rem!important}
        .gs-confirm-button,.gs-cancel-button{min-width:6.75rem!important;height:2.5rem!important;margin:0!important;border:2px solid!important;border-radius:.5rem!important;box-shadow:3px 3px 0 rgba(31,92,69,.14)!important;font-family:Inter,ui-sans-serif,system-ui,sans-serif!important;font-size:.78rem!important;font-weight:900!important;text-transform:uppercase!important;transition:transform .18s ease,box-shadow .18s ease,background-color .18s ease!important}
        .gs-confirm-button{border-color:#7f1d1d!important;background:#dc2626!important;color:#fff!important}
        .gs-cancel-button{border-color:rgba(31,92,69,.55)!important;background:#fff!important;color:#1f5c45!important}
        .gs-confirm-button:hover,.gs-cancel-button:hover{transform:translate(-1px,-1px)!important;box-shadow:5px 5px 0 rgba(31,92,69,.12)!important}
        .gs-confirm-button:focus-visible,.gs-cancel-button:focus-visible{outline:2px solid #d9b45c!important;outline-offset:2px!important}
    </style>
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
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 transition {{ request()->routeIs('admin.dashboard') ? 'border-2 border-white/18 bg-white text-primary shadow-[4px_4px_0_rgba(0,0,0,.14)]' : 'text-white/84 hover:bg-white/10 hover:text-white' }}">
                        <x-ui.icon name="layout-dashboard" class="size-5" />
                        Dashboard
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 transition {{ request()->routeIs('admin.news.*') ? 'border-2 border-white/18 bg-white text-primary shadow-[4px_4px_0_rgba(0,0,0,.14)]' : 'text-white/84 hover:bg-white/10 hover:text-white' }}">
                        <x-ui.icon name="newspaper" class="size-5" />
                        Berita
                    </a>
                    <a href="{{ route('admin.gallery-items.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 transition {{ request()->routeIs('admin.gallery-items.*') ? 'border-2 border-white/18 bg-white text-primary shadow-[4px_4px_0_rgba(0,0,0,.14)]' : 'text-white/84 hover:bg-white/10 hover:text-white' }}">
                        <x-ui.icon name="image" class="size-5" />
                        Galeri
                    </a>
                    <a href="{{ route('admin.ppdb-registrations.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 transition {{ request()->routeIs('admin.ppdb-registrations.*') ? 'border-2 border-white/18 bg-white text-primary shadow-[4px_4px_0_rgba(0,0,0,.14)]' : 'text-white/84 hover:bg-white/10 hover:text-white' }}">
                        <x-ui.icon name="calendar" class="size-5" />
                        PPDB
                    </a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 transition {{ request()->routeIs('admin.contact-messages.*') ? 'border-2 border-white/18 bg-white text-primary shadow-[4px_4px_0_rgba(0,0,0,.14)]' : 'text-white/84 hover:bg-white/10 hover:text-white' }}">
                        <x-ui.icon name="mail" class="size-5" />
                        Pesan
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
    <script>
        (() => {
            const scriptUrl = '{{ asset('vendor/flasher/sweetalert2.min.js') }}';
            const styleUrl = '{{ asset('vendor/flasher/sweetalert2.min.css') }}';
            let sweetAlertPromise = null;

            function loadSweetAlert() {
                if (window.Swal) {
                    return Promise.resolve(window.Swal);
                }

                if (!document.querySelector(`link[href="${styleUrl}"]`)) {
                    const link = document.createElement('link');
                    link.rel = 'stylesheet';
                    link.href = styleUrl;
                    document.head.appendChild(link);
                }

                sweetAlertPromise ??= new Promise((resolve, reject) => {
                    const script = document.createElement('script');
                    script.src = scriptUrl;
                    script.onload = () => resolve(window.Swal);
                    script.onerror = reject;
                    document.head.appendChild(script);
                });

                return sweetAlertPromise;
            }

            function escapeHtml(value) {
                return value.replace(/[&<>"']/g, (character) => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;',
                })[character]);
            }

            document.addEventListener('submit', async (event) => {
                const form = event.target;

                if (!(form instanceof HTMLFormElement) || !form.matches('[data-confirm]') || form.dataset.confirmed) {
                    return;
                }

                event.preventDefault();

                try {
                    const Swal = await loadSweetAlert();
                    const message = form.dataset.confirmText || 'Aksi ini tidak bisa dibatalkan.';
                    const result = await Swal.fire({
                        title: form.dataset.confirmTitle || 'Lanjutkan aksi?',
                        html: `
                            <div class="gs-confirm-badge">Konfirmasi</div>
                            <p>${escapeHtml(message)}</p>
                        `,
                        showCancelButton: true,
                        confirmButtonText: form.dataset.confirmButton || 'Ya, hapus',
                        cancelButtonText: form.dataset.cancelButton || 'Batal',
                        reverseButtons: true,
                        focusCancel: true,
                        buttonsStyling: false,
                        customClass: {
                            popup: 'gs-confirm-popup',
                            title: 'gs-confirm-title',
                            htmlContainer: 'gs-confirm-html',
                            actions: 'gs-confirm-actions',
                            confirmButton: 'gs-confirm-button',
                            cancelButton: 'gs-cancel-button',
                        },
                    });

                    if (result.isConfirmed) {
                        form.dataset.confirmed = 'true';
                        form.submit();
                    }
                } catch (error) {
                    console.error('Gagal memuat SweetAlert.', error);
                }
            });
        })();
    </script>
</body>
</html>
