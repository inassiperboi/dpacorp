@extends('public.layouts.app')
@section('meta-title', 'Anak Perusahaan — DPA Corp')
@section('meta-description', 'Empat anak perusahaan PT Dharma Putra Airlangga di bidang perjalanan wisata, bioproduct, konsultasi, dan properti.')

@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Anak Perusahaan</li>
    </ol>
</div>

{{-- Header --}}
<section style="background:linear-gradient(135deg,#0d1f45,#1a3a6e);padding:70px 5%;text-align:center;">
    <div class="section-label" style="color:#f0b84a;">Grup Bisnis DPA Corp</div>
    <h1 style="font-family:'Poppins',sans-serif;font-size:42px;font-weight:800;color:#fff;margin-bottom:14px;">Anak Perusahaan</h1>
    <p style="font-size:16px;color:rgba(255,255,255,.75);max-width:600px;margin:0 auto;line-height:1.7;">
        Setiap anak perusahaan beroperasi secara mandiri dengan website dan tim tersendiri, di bawah payung holding DPA Corp.
    </p>
</section>

{{-- Grid --}}
<section style="padding:80px 5%;">
    <div style="max-width:1100px;margin:0 auto;">
        @if($subsidiaries->isEmpty())
            <div style="text-align:center;padding:60px;color:var(--text-muted);">
                Belum ada data anak perusahaan.
            </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(480px,1fr));gap:28px;">
            @foreach($subsidiaries as $sub)
            <div class="card-pub" style="display:flex;flex-direction:column;">
                {{-- Cover --}}
                <div style="height:200px;background:linear-gradient(135deg,#1a3a6e,#2952a3);position:relative;overflow:hidden;">
                    @if($sub->cover_image)
                        <img src="{{ asset('storage/'.$sub->cover_image) }}" alt="{{ $sub->cover_alt }}" style="width:100%;height:100%;object-fit:cover;opacity:.65;" loading="lazy">
                    @endif
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,25,60,.85) 0%,rgba(10,25,60,.1) 60%);"></div>
                    <div style="position:absolute;bottom:0;left:0;right:0;padding:20px;display:flex;align-items:flex-end;gap:14px;">
                        @if($sub->logo)
                            <div style="width:56px;height:56px;background:#fff;border-radius:12px;padding:6px;flex-shrink:0;">
                                <img src="{{ asset('storage/'.$sub->logo) }}" alt="{{ $sub->logo_alt }}" style="width:100%;height:100%;object-fit:contain;" loading="lazy">
                            </div>
                        @endif
                        <div>
                            <div style="font-size:19px;font-weight:700;color:#fff;line-height:1.2;">{{ $sub->nama }}</div>
                            @if($sub->alamat)
                                <div style="font-size:12px;color:rgba(255,255,255,.65);margin-top:3px;">📍 {{ Str::limit($sub->alamat, 60) }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div style="padding:24px;flex:1;display:flex;flex-direction:column;">
                    <p style="font-size:14px;color:var(--text-muted);line-height:1.7;margin-bottom:16px;flex:1;">
                        {{ $sub->deskripsi_singkat ?? $sub->deskripsi_lengkap ?? '' }}
                    </p>

                    {{-- Service Badges --}}
                    @if($sub->services->count())
                        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:20px;">
                            @foreach($sub->services as $svc)
                                <span style="background:#e0f2fe;color:#0369a1;padding:4px 11px;border-radius:20px;font-size:12px;font-weight:600;">
                                    @if($svc->icon) {{ $svc->icon }} @endif {{ $svc->nama_layanan }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Legalitas singkat --}}
                    @if($sub->tanggal_pendirian || $sub->no_akta)
                        <div style="background:var(--bg);border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:12.5px;color:var(--text-muted);display:grid;grid-template-columns:1fr 1fr;gap:6px;">
                            @if($sub->tanggal_pendirian)
                                <div><strong>Berdiri:</strong> {{ $sub->tanggal_pendirian->format('Y') }}</div>
                            @endif
                            @if($sub->no_akta)
                                <div><strong>Akta:</strong> {{ $sub->no_akta }}</div>
                            @endif
                        </div>
                    @endif

                    {{-- Kontak sosmed --}}
                    @if($sub->instagram || $sub->whatsapp || $sub->email)
                        <div style="display:flex;gap:8px;margin-bottom:20px;">
                            @if($sub->instagram)
                                <a href="https://instagram.com/{{ ltrim($sub->instagram,'@') }}" target="_blank" rel="noopener" style="background:#f0f4ff;color:var(--primary);padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:500;">📷 IG</a>
                            @endif
                            @if($sub->whatsapp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$sub->whatsapp) }}" target="_blank" rel="noopener" style="background:#f0fdf4;color:#166534;padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:500;">💬 WA</a>
                            @endif
                            @if($sub->email)
                                <a href="mailto:{{ $sub->email }}" style="background:#faf5ff;color:#6b21a8;padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:500;">✉️ Email</a>
                            @endif
                        </div>
                    @endif

                    {{-- CTA --}}
                    @if($sub->website_url)
                        <a href="{{ $sub->website_url }}" target="_blank" rel="noopener noreferrer"
                           class="btn-pub btn-pub-primary" style="justify-content:center;">
                            🌐 Kunjungi Website ↗
                        </a>
                    @else
                        <button onclick="Swal.fire({title:'{{ addslashes($sub->nama) }}',text:'Website sedang dalam pengembangan. Gunakan kontak di atas untuk informasi lebih lanjut.',icon:'info',confirmButtonColor:'#1a3a6e'})"
                                class="btn-pub btn-pub-outline" style="justify-content:center;width:100%;background:none;">
                            ℹ️ Info Lebih Lanjut
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
