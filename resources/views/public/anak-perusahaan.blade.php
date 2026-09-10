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
@include('public.partials.hero-video', [
    'label' => 'Grup Bisnis DPA Corp',
    'title' => 'Anak Perusahaan',
    'description' => 'Setiap anak perusahaan beroperasi secara mandiri dengan website dan tim tersendiri, di bawah payung holding DPA Corp.',
])

{{-- Grid --}}
<section style="padding:80px 5%;">
    <div style="max-width:1100px;margin:0 auto;">
        @if($subsidiaries->isEmpty())
            <div style="text-align:center;padding:60px;color:var(--text-muted);">
                Belum ada data anak perusahaan.
            </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:28px;">
            @foreach($subsidiaries as $sub)
            <div class="card-pub" style="display:flex;flex-direction:column;text-align:center;padding:32px 24px;">

                {{-- Logo --}}
                <div style="width:88px;height:88px;margin:0 auto 18px;background:#fff;border:1px solid rgba(0,0,0,.06);border-radius:18px;padding:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(0,0,0,.06);">
                    @if($sub->logo)
                        <img src="{{ asset('storage/'.$sub->logo) }}" alt="{{ $sub->logo_alt }}" style="width:100%;height:100%;object-fit:contain;" loading="lazy">
                    @else
                        <span style="font-size:32px;">🏢</span>
                    @endif
                </div>

                {{-- Nama --}}
                <div style="font-size:19px;font-weight:700;color:var(--text,#1a1a2e);line-height:1.25;margin-bottom:4px;">{{ $sub->nama }}</div>
                @if($sub->alamat)
                    <div style="font-size:12px;color:var(--text-muted);margin-bottom:14px;">📍 {{ Str::limit($sub->alamat, 50) }}</div>
                @endif

                {{-- Deskripsi --}}
                <p style="font-size:14px;color:var(--text-muted);line-height:1.7;margin-bottom:16px;flex:1;">
                    {{ $sub->deskripsi_singkat ?? $sub->deskripsi_lengkap ?? '' }}
                </p>

                {{-- Service Badges --}}
                @if($sub->services->count())
                    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:6px;margin-bottom:18px;">
                        @foreach($sub->services as $svc)
                            <span style="background:#e0f2fe;color:#0369a1;padding:4px 11px;border-radius:20px;font-size:12px;font-weight:600;">
                                @if($svc->icon) {{ $svc->icon }} @endif {{ $svc->nama_layanan }}
                            </span>
                        @endforeach
                    </div>
                @endif

                {{-- Legalitas singkat --}}
                @if($sub->tanggal_pendirian || $sub->no_akta)
                    <div style="background:var(--bg);border-radius:10px;padding:10px 16px;margin-bottom:18px;font-size:12.5px;color:var(--text-muted);display:flex;justify-content:center;gap:16px;">
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
                    <div style="display:flex;justify-content:center;gap:8px;margin-bottom:18px;">
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
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
