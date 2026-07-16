@extends('layouts.auth', ['title' => 'Login - Golden Sierra School'])

@section('auth-content')
    <div class="flex items-start justify-between gap-5">
        <div>
            <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Masuk Portal</p>
            <h1 class="mt-3 text-3xl font-black leading-tight text-primary sm:text-4xl">Selamat datang kembali.</h1>
            <p class="mt-3 text-sm leading-7 text-slate-600">
            Gunakan akun terdaftar untuk mengakses portal Golden Sierra School.
            </p>
        </div>
        <span class="hidden size-12 shrink-0 place-items-center rounded-lg border-2 border-primary/14 bg-secondary-muted text-lg font-black text-primary shadow-[4px_4px_0_rgba(31,92,69,.08)] sm:grid">
            GS
        </span>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="mt-6 rounded-lg border-2 border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold leading-6 text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('status'))
        <div class="mt-6 rounded-lg border-2 border-secondary/20 bg-secondary-muted px-4 py-3 text-sm font-semibold leading-6 text-primary">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="#" class="mt-8 grid gap-5">
        @csrf

        <div>
            <label for="email" class="text-sm font-black text-primary">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
                autofocus
                class="mt-2 h-12 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 text-sm font-semibold text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-primary focus:bg-white focus:shadow-[0_0_0_4px_rgba(217,180,92,.20)]"
                placeholder="nama@email.com"
            >
            @isset($errors)
                @error('email')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            @endisset
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <label for="password" class="text-sm font-black text-primary">Password</label>
                <a href="#" class="text-xs font-black uppercase tracking-wide text-secondary transition hover:text-primary">
                    Lupa password?
                </a>
            </div>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="mt-2 h-12 w-full rounded-lg border-2 border-primary/15 bg-surface px-4 text-sm font-semibold text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-primary focus:bg-white focus:shadow-[0_0_0_4px_rgba(217,180,92,.20)]"
                placeholder="Masukkan password"
            >
            @isset($errors)
                @error('password')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            @endisset
        </div>

        <label class="flex items-center gap-3 text-sm font-semibold text-slate-600">
            <input
                type="checkbox"
                name="remember"
                class="size-4 rounded border-2 border-primary/25 bg-surface text-primary focus:ring-2 focus:ring-accent"
            >
            Ingat saya
        </label>

        <x-ui.button type="submit" variant="accent" size="lg" class="w-full">
            <span>Masuk</span>
            <x-ui.icon name="arrow-right" class="size-4" />
        </x-ui.button>
    </form>

    <div class="mt-8 border-t border-primary/10 pt-6">
        <div class="mb-4 border-l-4 border-accent bg-surface px-4 py-3">
            <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Jam Layanan</p>
            <p class="mt-1 text-sm font-semibold leading-6 text-slate-600">Senin - Jumat, 08.00 - 15.00 WIB</p>
        </div>

        <div class="flex flex-col gap-3 bg-secondary-muted p-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-black text-primary">Belum punya akun?</p>
                <p class="mt-1 text-sm leading-6 text-slate-600">Halaman register disiapkan memakai layout auth ini.</p>
            </div>
            <span class="w-fit rounded-md bg-accent px-3 py-2 text-xs font-black uppercase tracking-wide text-primary">
                Segera
            </span>
        </div>
    </div>
@endsection
