@extends('public.layouts.app')

@section('meta-title', ($informasi->title ?? 'Informasi') . ' — DPA Corp')
@section('meta-description', $informasi->summary ?? 'Informasi DPA Corp')
@section('og-image', $informasi->image ? asset('storage/'.$informasi->image) : asset('images/og-default.jpg'))

@section('content')

<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li><a href="{{ route('public.news.index') }}#informasi">Berita &amp; Informasi</a></li>
        <li>{{ $informasi->title }}</li>
    </ol>
</div>

@include('public.partials.hero-video', [
    'label' => 'Informasi Resmi',
    'title' => $informasi->title,
    'maxWidth' => '760px',
])

<section style="padding:70px 5%;background:linear-gradient(180deg,#fff 0%,#f8fbff 100%);">
    <div style="max-width:1180px;margin:0 auto;display:grid;grid-template-columns:minmax(0,1.35fr) 320px;gap:32px;align-items:start;">
        <article>
            <div class="card-pub" style="overflow:hidden;">
                @if($informasi->image)
                    <div style="position:relative;height:420px;background:#12385f;overflow:hidden;">
                        <img src="{{ asset('storage/'.$informasi->image) }}" alt="{{ $informasi->title }}" style="width:100%;height:100%;object-fit:cover;" loading="lazy">
                    </div>
                @endif

                <div style="padding:28px;">
                    <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;margin-bottom:14px;">
                        <span style="display:inline-flex;align-items:center;background:#eef7ff;color:#12385f;padding:6px 12px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;">Informasi</span>
                        <span style="font-size:12px;color:var(--text-muted);">{{ optional($informasi->created_at)->translatedFormat('d M Y, H:i') }}</span>
                    </div>

                    <h1 style="font-family:'Poppins',sans-serif;font-size:clamp(28px,4vw,42px);line-height:1.2;font-weight:800;color:var(--primary);margin-bottom:16px;">{{ $informasi->title }}</h1>

                    @if($informasi->extraImages())
                        <div style="margin-bottom:26px;">
                            <div style="font-size:13px;font-weight:700;color:var(--primary);margin-bottom:10px;">Gambar Tambahan</div>
                            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px;">
                                @foreach($informasi->extraImages() as $image)
                                    <a href="{{ asset('storage/'.$image) }}" target="_blank" rel="noopener noreferrer" style="display:block;border-radius:14px;overflow:hidden;">
                                        <img src="{{ asset('storage/'.$image) }}" alt="{{ $informasi->title }}" style="width:100%;height:160px;object-fit:cover;display:block;">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div style="font-size:16px;line-height:1.9;color:var(--text);white-space:normal;">
                        {!! nl2br(e($informasi->content)) !!}
                    </div>

                    @php
                        $infoTags = collect(preg_split('/\r\n|\r|\n/', $informasi->tags ?? ''))
                            ->map(fn ($tag) => trim($tag))
                            ->filter();
                    @endphp

                    @if($infoTags->isNotEmpty())
                        <div style="margin-top:28px;padding-top:24px;border-top:1px solid var(--border);">
                            <div style="font-size:13px;font-weight:700;color:var(--primary);margin-bottom:12px;">Tags</div>
                            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                                @foreach($infoTags as $tag)
                                    <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:999px;background:#edf4ff;color:#12385f;font-size:12px;font-weight:700;">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </article>

        <aside style="position:sticky;top:90px;display:flex;flex-direction:column;gap:18px;">
            <div class="card-pub" style="padding:24px;">
                <div style="font-size:13px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;color:var(--accent);margin-bottom:10px;">Posting</div>
                <div style="display:flex;flex-direction:column;gap:12px;font-size:14px;color:var(--text);line-height:1.7;">
                    <div><strong style="color:var(--primary);">Terbit:</strong> {{ optional($informasi->created_at)->translatedFormat('d M Y') }}</div>
                    <div><strong style="color:var(--primary);">Jam:</strong> {{ optional($informasi->created_at)->translatedFormat('H:i') }}</div>
                    <div><strong style="color:var(--primary);">Slug:</strong> <span style="font-family:monospace;color:var(--text-muted);">{{ $informasi->slug }}</span></div>
                </div>
            </div>

            <div class="card-pub" style="padding:24px;background:linear-gradient(135deg,#12385f,#2d6cdf);color:#fff;">
                <div style="font-size:13px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;color:#f0b84a;margin-bottom:10px;">Aksi Cepat</div>
                <p style="font-size:14px;line-height:1.8;color:rgba(255,255,255,.78);margin-bottom:18px;">Butuh penjelasan lebih lanjut terkait informasi ini? Tim kami siap membantu.</p>
                <a href="{{ url('/kontak') }}" class="btn-pub btn-pub-accent" style="width:100%;justify-content:center;margin-bottom:10px;">Hubungi Kami</a>
                <a href="{{ route('public.news.index') }}#informasi" class="btn-pub btn-pub-outline" style="width:100%;justify-content:center;color:#fff;border-color:rgba(255,255,255,.3);">← Kembali ke Informasi</a>
            </div>
        </aside>
    </div>
</section>

@endsection
