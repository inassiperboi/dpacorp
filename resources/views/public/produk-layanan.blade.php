@extends('public.layouts.app')
@section('meta-title', 'Produk & Layanan — DPA Corp')
@section('content')
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Produk & Layanan</li>
    </ol>
</div>
@include('public.partials.hero-video', [
    'label' => 'Mengenal DPA Corp',
    'title' => 'Produk & Layanan',
    'description' => 'PT Dharma Putra Airlangga adalah holding company yang lahir dari rahim Universitas Airlangga, dibangun untuk menjadi jembatan antara akademisi dan dunia bisnis.',
])
<section style="padding:80px 5%;">
    <div style="max-width:1100px;margin:0 auto;">
        @if($products->isEmpty())
            <div style="text-align:center;color:var(--text-muted);padding:60px;">Belum ada produk.</div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:24px;">
            @foreach($products as $prod)
            <a href="{{ url('/produk-layanan/'.$prod->slug) }}" class="card-pub" style="text-decoration:none;color:inherit;">
                <div style="height:200px;background:var(--bg);overflow:hidden;">
                    @if($prod->thumbnail)
                        <img src="{{ asset('storage/'.$prod->thumbnail) }}" alt="{{ $prod->thumbnail_alt }}" style="width:100%;height:100%;object-fit:cover;transition:transform .4s;" loading="lazy">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:48px;background:linear-gradient(135deg,#e0f2fe,#dbeafe);">📦</div>
                    @endif
                </div>
                <div style="padding:20px;">
                    @if($prod->kategori)
                        <div style="font-size:11px;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.8px;margin-bottom:6px;">{{ $prod->kategori }}</div>
                    @endif
                    <h2 style="font-size:16px;font-weight:700;color:var(--primary);margin-bottom:8px;">{{ $prod->nama }}</h2>
                    <p style="font-size:13.5px;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">{{ Str::limit($prod->deskripsi_singkat, 100) }}</p>
                    <span style="color:var(--primary-light);font-size:13px;font-weight:600;">Selengkapnya →</span>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
