@extends('layouts.admin', ['title' => 'Dashboard Admin - Golden Sierra School', 'heading' => 'Dashboard'])

@php
    $toneClasses = [
        'primary' => 'border-primary/18 bg-primary text-white shadow-[5px_5px_0_rgba(31,92,69,.14)]',
        'secondary' => 'border-secondary/20 bg-secondary-muted text-primary shadow-[5px_5px_0_rgba(43,115,87,.12)]',
        'accent' => 'border-accent/40 bg-accent-muted text-primary shadow-[5px_5px_0_rgba(217,180,92,.18)]',
        'neutral' => 'border-primary/12 bg-white text-primary shadow-[5px_5px_0_rgba(31,92,69,.08)]',
    ];
@endphp

@section('content')
    <section class="grid gap-5 lg:grid-cols-[minmax(0,1.5fr)_minmax(320px,0.8fr)]">
        <div class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)] md:p-8">
            <div class="grid gap-6 md:grid-cols-[1fr_auto] md:items-start">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Selamat datang</p>
                    <h2 class="mt-3 text-3xl font-black leading-tight text-primary md:text-4xl">
                        Halo, {{ auth()->user()->name }}.
                    </h2>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                        Panel awal ini disiapkan sebagai pusat kerja admin Golden Sierra School.
                    </p>
                </div>
                <span class="grid size-14 place-items-center rounded-lg bg-secondary-muted text-primary">
                    <x-ui.icon name="layout-dashboard" class="size-7" />
                </span>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
                @foreach ($stats as $stat)
                    <article class="rounded-lg border-2 p-5 {{ $toneClasses[$stat['tone']] ?? $toneClasses['neutral'] }}">
                        <p class="text-3xl font-black">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-xs font-black uppercase tracking-wide opacity-75">{{ $stat['label'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>

        <aside class="rounded-lg border-2 border-primary/12 bg-white p-6 shadow-[6px_6px_0_rgba(31,92,69,.08)]">
            <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Aktivitas</p>
            <div class="mt-5 grid gap-4">
                @foreach ($activities as $activity)
                    <article class="border-l-4 border-accent bg-surface px-4 py-3">
                        <h3 class="text-sm font-black text-primary">{{ $activity['title'] }}</h3>
                        <p class="mt-1 text-sm leading-6 text-slate-600">{{ $activity['meta'] }}</p>
                    </article>
                @endforeach
            </div>
        </aside>
    </section>

    <section class="mt-6">
        <div class="mb-4 flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-secondary">Modul Admin</p>
                <h2 class="mt-2 text-2xl font-black text-primary">Area kerja utama</h2>
            </div>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-5">
            @foreach ($modules as $module)
                <a href="{{ $module['href'] }}" class="motion-card group rounded-lg border-2 border-primary/12 bg-white p-5 shadow-[5px_5px_0_rgba(31,92,69,.08)] transition hover:border-secondary/40">
                    <div class="flex items-start justify-between gap-4">
                        <span class="grid size-11 place-items-center rounded-lg bg-secondary-muted text-primary">
                            <x-ui.icon :name="$module['icon']" class="size-5" />
                        </span>
                        <x-ui.icon name="arrow-right" class="size-5 text-secondary transition group-hover:translate-x-1" />
                    </div>
                    <h3 class="mt-5 text-lg font-black text-primary">{{ $module['title'] }}</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $module['copy'] }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection
