@extends('public.layouts.app')
@section('meta-title', 'Tentang Kami — PT Dharma Putra Airlangga')
@section('meta-description', 'Sejarah, legalitas, dan KBLI PT Dharma Putra Airlangga (DPA Corp), holding company Universitas Airlangga yang berdiri sejak 2009.')

@section('content')
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Tentang Kami</li>
    </ol>
</div>

@include('public.partials.hero-video', [
    'label' => 'Mengenal DPA Corp',
    'title' => 'Tentang Kami',
    'description' => 'PT Dharma Putra Airlangga adalah holding company yang lahir dari rahim Universitas Airlangga, dibangun untuk menjadi jembatan antara akademisi dan dunia bisnis.',
])

{{-- Sejarah --}}
<section style="padding:80px 5%;">
    <div style="max-width:900px;margin:0 auto;">
        <div class="section-label">Perjalanan Kami</div>
        <h2 class="section-title">Sejarah Perusahaan</h2>
        <div style="font-size:15px;color:var(--text-muted);line-height:1.85;margin-bottom:60px;">
            PT Dharma Putra Airlangga (DPA Corp) merupakan holding company milik Universitas Airlangga yang didirikan sebagai entitas bisnis untuk mendukung implementasi status Perguruan Tinggi Negeri Berbadan Hukum (PTNBH) Universitas Airlangga. Perusahaan ini berkomitmen untuk mengintegrasikan nilai-nilai akademis dengan praktik bisnis yang beretika dan berkelanjutan.
        </div>

        {{-- Timeline --}}
        @if($timelines->count())
        <div style="position:relative;padding-left:30px;">
            <div style="position:absolute;left:12px;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,var(--primary),var(--accent));border-radius:2px;"></div>
            @foreach($timelines as $tl)
            <div style="position:relative;margin-bottom:36px;">
                <div style="position:absolute;left:-26px;top:4px;width:16px;height:16px;background:{{ $loop->first ? 'var(--accent)' : 'var(--primary)' }};border-radius:50%;border:3px solid #fff;box-shadow:0 0 0 3px {{ $loop->first ? 'rgba(232,160,32,.25)' : 'rgba(26,58,110,.25)' }};"></div>
                <div style="background:{{ $loop->first ? 'linear-gradient(135deg,#fef3c7,#fde68a)' : 'var(--bg)' }};border-radius:14px;padding:20px 24px;border:1px solid {{ $loop->first ? '#fde68a' : 'var(--border)' }};">
                    <div style="font-size:13px;font-weight:700;color:{{ $loop->first ? '#92400e' : 'var(--accent)' }};text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;">{{ $tl->year }}</div>
                    <div style="font-weight:700;font-size:16px;color:var(--primary);margin-bottom:6px;">{{ $tl->title }}</div>
                    @if($tl->description)
                        <p style="font-size:13.5px;color:var(--text-muted);line-height:1.6;margin:0;">{{ $tl->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- Legalitas --}}
@if($legals->count())
<section style="padding:60px 5%;background:var(--bg);">
    <div style="max-width:900px;margin:0 auto;">
        <div class="section-label">Legalitas</div>
        <h2 class="section-title">Data Hukum Perusahaan</h2>
        <div style="background:#fff;border-radius:16px;border:1px solid var(--border);overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead style="background:var(--primary);">
                    <tr>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;width:200px;">Jenis Dokumen</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Nomor</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Tanggal</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($legals as $doc)
                    <tr style="{{ $loop->even ? 'background:#f8fafc;' : '' }}">
                        <td style="padding:14px 20px;font-weight:600;color:var(--primary);">{{ $doc->label }}</td>
                        <td style="padding:14px 20px;color:var(--text-muted);">{{ $doc->nomor ?? '—' }}</td>
                        <td style="padding:14px 20px;color:var(--text-muted);">{{ $doc->tanggal ? $doc->tanggal->format('d/m/Y') : '—' }}</td>
                        <td style="padding:14px 20px;color:var(--text-muted);font-size:13px;">{{ $doc->keterangan ?? ($doc->notaris ? 'Notaris: '.$doc->notaris : '—') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif

{{-- KBLI --}}
@if($kbliItems->count())
<section style="padding:60px 5%;">
    <div style="max-width:900px;margin:0 auto;">
        <div class="section-label">Klasifikasi Baku</div>
        <h2 class="section-title">Kode KBLI</h2>
        <div style="background:#fff;border-radius:16px;border:1px solid var(--border);overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead style="background:linear-gradient(135deg,#1a3a6e,#2952a3);">
                    <tr>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;width:160px;">Kode KBLI</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Judul Kegiatan Usaha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kbliItems as $kbli)
                    <tr style="{{ $loop->even ? 'background:#f8fafc;' : '' }}">
                        <td style="padding:13px 20px;font-weight:700;color:var(--accent);font-family:monospace;font-size:15px;">{{ $kbli->kode_kbli }}</td>
                        <td style="padding:13px 20px;color:var(--text);">{{ $kbli->judul_kbli }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif
@endsection
