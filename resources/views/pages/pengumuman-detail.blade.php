@extends('layouts.app', ['title' => $announcement->title . ' - Golden Sierra School'])

@section('content')
    <section class="bg-surface py-14 md:py-20">
        <div class="section-shell">
            <a href="{{ route('pengumuman.index') }}" class="inline-flex rounded-lg border-2 border-primary/20 bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-primary shadow-[3px_3px_0_rgba(31,92,69,.10)] transition hover:bg-secondary-muted">
                Kembali ke Pengumuman
            </a>

            <div class="mt-8 grid gap-10 lg:grid-cols-[minmax(0,1fr)_340px] lg:items-start">
                <article class="motion-card js-reveal rounded-lg border-2 border-primary/15 bg-white p-5 shadow-[6px_6px_0_rgba(31,92,69,.10)] md:p-8">
                    <div class="flex flex-wrap items-center gap-2 text-xs font-black uppercase tracking-wide">
                        <span class="rounded-md bg-secondary-muted px-2.5 py-1 text-secondary">{{ $announcement->category }}</span>
                        <span class="text-slate-500">{{ $announcement->date }}</span>
                    </div>

                    <h1 class="mt-4 max-w-4xl text-3xl font-black leading-tight text-primary md:text-5xl">
                        {{ $announcement->title }}
                    </h1>

                    <div class="mt-8 whitespace-pre-line text-base leading-8 text-slate-700">
                        {{ $announcement->copy }}
                    </div>
                </article>

                <aside class="rounded-lg border-2 border-primary/15 bg-white p-6 shadow-[5px_5px_0_rgba(31,92,69,.08)]">
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-secondary">Pengumuman Terkait</p>

                    <div class="mt-5 grid gap-4">
                        @forelse ($relatedAnnouncements as $item)
                            <a href="{{ route('pengumuman.show', $item->slug) }}" class="block rounded-lg border-2 border-primary/10 bg-surface p-4 transition hover:border-primary/25 hover:bg-secondary-muted">
                                <p class="text-[11px] font-black uppercase tracking-wide text-secondary">{{ $item->category }}</p>
                                <h2 class="mt-2 text-sm font-black leading-6 text-primary">{{ $item->title }}</h2>
                                <p class="mt-2 text-xs font-bold uppercase tracking-wide text-slate-500">{{ $item->date }}</p>
                            </a>
                        @empty
                            <div class="rounded-lg border-2 border-dashed border-primary/15 bg-surface p-4 text-sm font-semibold leading-6 text-slate-500">
                                Belum ada pengumuman terkait.
                            </div>
                        @endforelse
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
