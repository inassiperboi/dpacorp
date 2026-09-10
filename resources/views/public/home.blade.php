@extends('public.layouts.app')

@section('meta-title', 'PT Dharma Putra Airlangga — Holding Company Universitas Airlangga')
@section('meta-description', 'DPA Corp adalah holding company milik Universitas Airlangga yang mengelola 4 anak perusahaan di bidang perjalanan, kesehatan, konsultasi, dan properti.')

@section('content')

{{-- ─── Hero Section ───────────────────────────────── --}}
<section class="hero-section" style="min-height:92vh;display:flex;align-items:center;background:#000;position:relative;overflow:hidden;padding:0 5%;">

    {{-- Video background --}}
    <video autoplay muted loop playsinline preload="auto"
           style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.2;z-index:0;pointer-events:none;">
        <source src="{{ asset('images/hero/video.mp4') }}" type="video/mp4">
    </video>

    {{-- Fully animated illustrated scene using your own PNG assets.
         Drop transparent PNGs at public/images/hero/ with these names:
         cloud.png, plane.png, plane-small.png, skyline.png, truck.png
         The scene still fully animates — only the artwork changed from SVG to PNG. --}}
    <div class="hero-scene" aria-hidden="true">

        <img class="hero-cloud hero-cloud-1" src="{{ asset('images/hero/cloud.png') }}" alt="" onerror="this.style.display='none'">
        <img class="hero-cloud hero-cloud-2" src="{{ asset('images/hero/cloud.png') }}" alt="" onerror="this.style.display='none'">
        <img class="hero-cloud hero-cloud-3" src="{{ asset('images/hero/cloud.png') }}" alt="" onerror="this.style.display='none'">
        <img class="hero-cloud hero-cloud-4" src="{{ asset('images/hero/cloud.png') }}" alt="" onerror="this.style.display='none'">

        <svg class="hero-trail" viewBox="0 0 1600 500" preserveAspectRatio="none">
            <path d="M -50 260 C 250 140, 700 90, 1650 -180" fill="none" stroke="rgba(255,255,255,.35)" stroke-width="2" stroke-dasharray="2 10" stroke-linecap="round"/>
            <path d="M -50 380 C 300 340, 650 420, 1650 260" fill="none" stroke="rgba(240,184,74,.3)" stroke-width="2" stroke-dasharray="2 10" stroke-linecap="round"/>
        </svg>
        {{-- <img class="hero-plane hero-plane-1" src="{{ asset('images/hero/plane.png') }}" alt="" onerror="this.style.display='none'"> --}}
        {{-- <img class="hero-plane hero-plane-2" src="{{ asset('images/hero/plane-small.png') }}" alt="" onerror="this.style.display='none'"> --}}

        <img class="hero-skyline" src="{{ asset('images/hero/skyline.png') }}" alt="" onerror="this.style.display='none'">

        <div class="hero-road"></div>

        <img class="hero-truck" src="{{ asset('images/hero/truck.png') }}" alt="" onerror="this.style.display='none'">
    </div>

    {{-- Tint over the scene so text stays readable --}}
    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,31,69,.55) 0%,rgba(26,58,110,.4) 50%,rgba(15,42,92,.55) 100%);z-index:2;pointer-events:none;"></div>

    {{-- Background decorative glows --}}
    <div style="position:absolute;top:-100px;right:-100px;width:600px;height:600px;background:radial-gradient(circle,rgba(232,160,32,.15) 0%,transparent 70%);pointer-events:none;z-index:2;"></div>
    <div style="position:absolute;bottom:-80px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(41,82,163,.3) 0%,transparent 70%);pointer-events:none;z-index:2;"></div>

    {{-- Soft fade at the base so the section blends into the next one instead of cutting off --}}
    <div style="position:absolute;left:0;right:0;bottom:0;height:200px;background:linear-gradient(to bottom, rgba(15,42,92,0) 0%, rgba(15,42,92,.55) 55%, #ffffff 100%);z-index:3;pointer-events:none;"></div>

    <div style="position:relative;z-index:4;max-width:1200px;margin:0 auto;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;padding:100px 0;">
        <div>
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);color:#f0b84a;padding:6px 14px;border-radius:20px;font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;margin-bottom:24px;">
                Holding Company Universitas Airlangga
            </div>
            <h1 style="font-family:'Poppins',sans-serif;font-size:clamp(32px,5vw,54px);font-weight:800;color:#fff;line-height:1.15;margin-bottom:20px;">
                {{ $company->nama_resmi ?? 'PT Dharma Putra Airlangga' }}
            </h1>
            <p style="font-size:18px;color:rgba(255,255,255,.75);line-height:1.7;margin-bottom:36px;max-width:500px;">
                {{ $company->tagline ?? 'Membangun ekosistem bisnis berbasis riset, inovasi, dan nilai-nilai akademis Universitas Airlangga untuk mendukung kemajuan bangsa.' }}
            </p>
            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                <a href="{{ url('/tentang-kami') }}" class="btn-pub btn-pub-accent">
                    Pelajari Lebih Lanjut →
                </a>
                <a href="{{ url('/kontak') }}" class="btn-pub btn-pub-outline" style="color:#fff;border-color:rgba(255,255,255,.3);">
                    Hubungi Kami
                </a>
            </div>
            <div style="display:flex;gap:32px;margin-top:44px;">
                <div>
                    <div style="font-size:28px;font-weight:800;color:#fff;font-family:'Poppins',sans-serif;">4</div>
                    <div style="font-size:13px;color:rgba(255,255,255,.6);">Anak Perusahaan</div>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.15);"></div>
                <div>
                    <div style="font-size:28px;font-weight:800;color:#fff;font-family:'Poppins',sans-serif;">2009</div>
                    <div style="font-size:13px;color:rgba(255,255,255,.6);">Tahun Berdiri</div>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.15);"></div>
                <div>
                    <div style="font-size:28px;font-weight:800;color:#fff;font-family:'Poppins',sans-serif;">UNAIR</div>
                    <div style="font-size:13px;color:rgba(255,255,255,.6);">Mitra Universitas</div>
                </div>
            </div>
        </div>
            <div style="display:flex;justify-content:center;align-items:center;transform:translateX(50px);">            <img
                src="{{ asset('images/hero/logos.png') }}"
                alt="Logo PT Dharma Putra Airlangga"
                style="width:100%;max-width:440px;height:auto;object-fit:contain;filter:drop-shadow(0 20px 40px rgba(0,0,0,.25));"
            >
        </div>
    </div>
</section>

@push('head')
<style>
    .hero-scene { position:absolute; inset:0; z-index:1; overflow:hidden; }

    /* Drifting clouds — swap cloud.png for your own art anytime, sizing/animation stays */
    .hero-cloud { position:absolute; width:700px; height:auto; object-fit:contain; }
    .hero-cloud-1 { top:8%;  left:-260px; animation:cloudDrift 40s linear infinite; }
    .hero-cloud-2 { width:300px; top:20%; left:-400px; animation:cloudDrift 50s linear infinite 8s; opacity:.7; }
    .hero-cloud-3 { width:380px; top:38%; left:-420px; animation:cloudDrift 60s linear infinite 20s; opacity:.5; }
    .hero-cloud-4 { width:220px; top:55%; left:-320px; animation:cloudDrift 44s linear infinite 30s; opacity:.6; }
    @keyframes cloudDrift {
        0%   { transform:translateX(0); }
        100% { transform:translateX(calc(100vw + 320px)); }
    }

    /* Dashed flight trails behind the planes (kept as CSS/SVG lines — purely decorative) */
    .hero-trail { position:absolute; inset:0; width:100%; height:100%; z-index:0; }

    /* Flying planes
    .hero-plane { position:absolute; width:300px; height:auto; object-fit:contain; will-change:transform; }
    .hero-plane-1 { top:35%; left:-100px; animation:plane1Move 15s linear infinite; }
    .hero-plane-2 { width:66px; top:70%; left:-60px; animation:plane2Move 34s linear infinite 10s; }
    @keyframes plane1Move {
        0%   { transform:translate(0,0) rotate(-18deg); opacity:0; }
        6%   { opacity:1; }
        94%  { opacity:1; }
        100% { transform:translate(calc(100vw + 100px), -260px) rotate(-18deg); opacity:0; }
    }
    @keyframes plane2Move {
        0%   { transform:translate(0,0) rotate(-10deg); opacity:0; }
        6%   { opacity:1; }
        94%  { opacity:1; }
        100% { transform:translate(calc(100vw + 80px), -120px) rotate(-10deg); opacity:0; }
    } */

    /* City skyline */
    .hero-skyline { position:absolute; left:0; right:0; bottom:60px; width:100%; height:22%; min-height:140px; object-fit:cover; object-position:bottom; }

    /* Road with moving lane markings + driving truck */
    .hero-road { position:absolute; left:0; right:0; bottom:0; height:60px; background:linear-gradient(to bottom, rgba(9,20,50,.6), rgba(9,20,50,.85)); }
    .hero-road::after {
        content:''; position:absolute; top:50%; left:0; right:0; height:2px;
        background:repeating-linear-gradient(90deg, rgba(255,255,255,.5) 0 24px, transparent 24px 48px);
        animation:roadLines 1.4s linear infinite;
    }
    @keyframes roadLines { 0% { background-position:0 0; } 100% { background-position:-48px 0; } }
    .hero-truck { position:absolute; width:200px; height:auto; object-fit:contain; bottom:14px; left:-160px; animation:truckDrive 18s linear infinite 3s; }
    @keyframes truckDrive {
        0%   { transform:translateX(0); opacity:0; }
        6%   { opacity:1; }
        94%  { opacity:1; }
        100% { transform:translateX(calc(100vw + 200px)); opacity:0; }
    }

    @media (prefers-reduced-motion: reduce) {
        .hero-cloud, .hero-plane, .hero-truck { animation:none !important; }
        .hero-road::after { animation:none !important; }
    }
</style>
@endpush

{{-- ─── Anak Perusahaan Highlight ─────────────────────── --}}
@if($subsidiaries->count())
<section style="padding:80px 5%;background:var(--bg);">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:52px;">
            <div class="section-label">Grup Bisnis</div>
            <h2 class="section-title" style="margin:0 auto 14px;">Anak Perusahaan</h2>
            <p class="section-subtitle" style="margin:0 auto;">Empat entitas bisnis yang bersama-sama membangun ekosistem layanan terpadu berbasis universitas.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:22px;">
            @foreach($subsidiaries as $sub)
            <div class="card-pub" style="position:relative;">
                {{-- Cover --}}
                <div style="height:160px;background:linear-gradient(135deg,#1a3a6e,#2952a3);position:relative;overflow:hidden;">
                    @if($sub->cover_image)
                        <img src="{{ asset('storage/'.$sub->cover_image) }}" alt="{{ $sub->cover_alt }}" style="width:100%;height:100%;object-fit:cover;opacity:.7;" loading="lazy">
                    @endif
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(26,58,110,.8),transparent);"></div>
                    @if($sub->logo)
                        <img src="{{ asset('storage/'.$sub->logo) }}" alt="{{ $sub->logo_alt }}" style="position:absolute;bottom:14px;left:16px;height:36px;width:auto;object-fit:contain;filter:brightness(0) invert(1);" loading="lazy">
                    @endif
                </div>
                <div style="padding:20px;">
                    <div style="font-weight:700;font-size:15px;margin-bottom:8px;color:var(--primary);">{{ $sub->nama }}</div>
                    <p style="font-size:13px;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">{{ Str::limit($sub->deskripsi_singkat, 90) }}</p>
                    <div style="display:flex;flex-wrap:wrap;gap:5px;margin-bottom:16px;">
                        @foreach($sub->services->take(4) as $svc)
                            <span style="background:#e0f2fe;color:#0369a1;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:600;">{{ $svc->nama_layanan }}</span>
                        @endforeach
                    </div>
                    @if($sub->website_url)
                        <a href="{{ $sub->website_url }}" target="_blank" rel="noopener noreferrer"
                           class="btn-pub btn-pub-primary" style="width:100%;justify-content:center;font-size:13px;padding:10px 16px;">
                            Kunjungi Website ↗
                        </a>
                    @else
                        <button onclick="showSubsidiaryModal('{{ addslashes($sub->nama) }}','{{ addslashes($sub->deskripsi_singkat) }}')"
                                class="btn-pub btn-pub-outline" style="width:100%;justify-content:center;font-size:13px;padding:10px 16px;">
                            Info Lebih Lanjut
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:36px;">
            <a href="{{ url('/anak-perusahaan') }}" class="btn-pub btn-pub-primary">Lihat Semua Anak Perusahaan →</a>
        </div>
    </div>
</section>
@endif

{{-- ─── Produk & Layanan Highlight ────────────────────── --}}
@if($products->count())
<section style="padding:80px 5%;">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:40px;flex-wrap:wrap;gap:16px;">
            <div>
                <div class="section-label">Apa yang Kami Tawarkan</div>
                <h2 class="section-title" style="margin:0;">Produk & Layanan</h2>
            </div>
            <a href="{{ url('/produk-layanan') }}" class="btn-pub btn-pub-outline" style="font-size:14px;padding:10px 22px;">Lihat Semua →</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;">
            @foreach($products as $prod)
            <a href="{{ url('/produk-layanan/'.$prod->slug) }}" class="card-pub" style="text-decoration:none;color:inherit;">
                <div style="height:180px;background:var(--bg);overflow:hidden;">
                    @if($prod->thumbnail)
                        <img src="{{ asset('storage/'.$prod->thumbnail) }}" alt="{{ $prod->thumbnail_alt }}" style="width:100%;height:100%;object-fit:cover;transition:transform .4s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" loading="lazy">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:40px;background:linear-gradient(135deg,#e0f2fe,#dbeafe);">📦</div>
                    @endif
                </div>
                <div style="padding:18px;">
                    @if($prod->kategori)
                        <div style="font-size:11px;font-weight:600;color:var(--accent);text-transform:uppercase;letter-spacing:.8px;margin-bottom:6px;">{{ $prod->kategori }}</div>
                    @endif
                    <div style="font-weight:700;font-size:15px;margin-bottom:6px;">{{ $prod->nama }}</div>
                    <p style="font-size:13px;color:var(--text-muted);line-height:1.5;">{{ Str::limit($prod->deskripsi_singkat, 80) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ─── Client Logo Strip ──────────────────────────────── --}}
@if($clients->count())
<section style="padding:60px 5%;background:var(--bg);">
    <div style="max-width:1200px;margin:0 auto;text-align:center;">
        <p style="font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:2px;color:var(--text-muted);margin-bottom:32px;">Dipercaya Oleh</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:32px;">
            @foreach($clients as $client)
                @if($client->logo)
                    <img src="{{ asset('storage/'.$client->logo) }}" alt="{{ $client->logo_alt ?? $client->nama }}" style="height:44px;width:auto;object-fit:contain;filter:grayscale(100%);opacity:.6;transition:all .2s;" onmouseover="this.style.filter='none';this.style.opacity='1'" onmouseout="this.style.filter='grayscale(100%)';this.style.opacity='.6'" loading="lazy" title="{{ $client->nama }}">
                @else
                    <div style="font-weight:700;font-size:14px;color:var(--text-muted);opacity:.7;">{{ $client->nama }}</div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ─── CTA Section ────────────────────────────────────── --}}
<section style="padding:80px 5%;background:linear-gradient(135deg,#1a3a6e,#2952a3);">
    <div style="max-width:700px;margin:0 auto;text-align:center;">
        <h2 style="font-family:'Poppins',sans-serif;font-size:36px;font-weight:700;color:#fff;margin-bottom:16px;">Siap Berkolaborasi?</h2>
        <p style="font-size:16px;color:rgba(255,255,255,.75);line-height:1.7;margin-bottom:36px;">
            Hubungi tim DPA Corp untuk mengetahui lebih lanjut tentang peluang kerjasama dan layanan yang kami tawarkan.
        </p>
        <a href="{{ url('/kontak') }}" class="btn-pub btn-pub-accent">Hubungi Kami Sekarang →</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
function showSubsidiaryModal(nama, deskripsi) {
    Swal.fire({
        title: nama,
        text: deskripsi || 'Website sedang dalam pengembangan. Hubungi kami untuk informasi lebih lanjut.',
        icon: 'info',
        confirmButtonColor: '#1a3a6e',
        confirmButtonText: 'Tutup',
    });
}
</script>
@endpush
