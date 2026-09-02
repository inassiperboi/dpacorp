@extends('public.layouts.app')

@section('meta-title', 'PT Dharma Putra Airlangga — Holding Company Universitas Airlangga')
@section('meta-description', 'DPA Corp adalah holding company milik Universitas Airlangga yang mengelola 4 anak perusahaan di bidang perjalanan, kesehatan, konsultasi, dan properti.')

@section('content')

{{-- ─── Hero Section ───────────────────────────────── --}}
<section style="min-height:92vh;display:flex;align-items:center;background:linear-gradient(135deg,#0d1f45 0%,#1a3a6e 50%,#0f2a5c 100%);position:relative;overflow:hidden;padding:0 5%;">
    {{-- Background decorative elements --}}
    <div style="position:absolute;top:-100px;right:-100px;width:600px;height:600px;background:radial-gradient(circle,rgba(232,160,32,.15) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-80px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(41,82,163,.3) 0%,transparent 70%);pointer-events:none;"></div>

    <div style="position:relative;z-index:1;max-width:1200px;margin:0 auto;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;padding:100px 0;">
        <div>
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);color:#f0b84a;padding:6px 14px;border-radius:20px;font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;margin-bottom:24px;">
                🏛️ Holding Company Universitas Airlangga
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
        <div style="display:flex;justify-content:center;align-items:center;">
            <div style="width:360px;height:360px;background:rgba(255,255,255,.06);border-radius:32px;border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(10px);">
                @if($company->logo)
                    <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->logo_alt ?? 'Logo DPA Corp' }}" style="max-width:260px;max-height:260px;object-fit:contain;">
                @else
                    <div style="font-size:80px;opacity:.4;">🏛️</div>
                @endif
            </div>
        </div>
    </div>
</section>

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
