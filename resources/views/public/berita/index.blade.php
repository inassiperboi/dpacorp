@extends('public.layouts.app')

@section('meta-title', 'Berita — DPA Corp')
@section('meta-description', 'Kumpulan berita terbaru PT Dharma Putra Airlangga dan perkembangan kegiatan perusahaan.')

@section('content')

<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Berita</li>
    </ol>
</div>

@include('public.partials.hero-video', [
    'label' => 'Publikasi DPA Corp',
    'title' => 'Berita',
    'description' => 'Ikuti berita terbaru seputar aktivitas, pencapaian, dan perkembangan PT Dharma Putra Airlangga.',
])

<section style="padding:80px 5%;background:linear-gradient(180deg,#fff 0%,#f7fbff 100%);">
    <div style="max-width:1200px;margin:0 auto;">
        @if($items->isEmpty())
            <div style="text-align:center;color:var(--text-muted);padding:70px 20px;border:1px dashed var(--border);border-radius:18px;background:#fff;">
                Belum ada berita yang dipublikasikan.
            </div>
        @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;">
                @foreach($items as $item)
                    @php
                        $newsTags = collect(preg_split('/\r\n|\r|\n/', $item->tags ?? ''))
                            ->map(fn ($tag) => trim($tag))
                            ->filter()
                            ->take(4);
                    @endphp

                    <a href="{{ route('public.berita.show', $item->slug) }}" class="card-pub" style="text-decoration:none;color:inherit;overflow:hidden;display:block;">
                        <div style="position:relative;height:220px;background:linear-gradient(135deg,#0d1f45,#1a3a6e);overflow:hidden;">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" style="width:100%;height:100%;object-fit:cover;transition:transform .5s;" loading="lazy">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.7);font-size:54px;">📰</div>
                            @endif

                            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(13,31,69,.78),rgba(13,31,69,.08));"></div>
                            <div style="position:absolute;top:16px;left:16px;background:rgba(240,184,74,.95);color:#0d1f45;padding:6px 12px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;">
                                Berita
                            </div>
                            @if($item->extraImages())
                                <div style="position:absolute;bottom:16px;right:16px;background:rgba(255,255,255,.92);color:var(--primary);padding:5px 10px;border-radius:999px;font-size:11px;font-weight:700;">
                                    + Gambar tambahan
                                </div>
                            @endif
                        </div>

                        <div style="padding:22px;">
                            <div style="font-size:12px;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.8px;margin-bottom:8px;">{{ $item->country }}</div>
                            <h2 style="font-size:18px;font-weight:800;color:var(--primary);line-height:1.35;margin-bottom:10px;">{{ $item->title }}</h2>
                            <p style="font-size:14px;color:var(--text-muted);line-height:1.7;margin-bottom:16px;">{{ Str::limit($item->summary, 120) }}</p>

                            @if($newsTags->isNotEmpty())
                                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;">
                                    @foreach($newsTags as $tag)
                                        <span style="display:inline-flex;align-items:center;padding:5px 11px;border-radius:999px;background:#e8f1ff;color:#1a3a6e;font-size:11px;font-weight:700;">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                                <span style="font-size:12px;color:var(--text-muted);">{{ optional($item->created_at)->format('d M Y') }}</span>
                                <span style="font-size:13px;font-weight:700;color:var(--primary-light);">Baca selengkapnya →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
