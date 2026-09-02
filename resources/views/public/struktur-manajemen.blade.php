@extends('public.layouts.app')
@section('meta-title', 'Struktur Manajemen — DPA Corp')
@section('content')
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Struktur Manajemen</li>
    </ol>
</div>
<section style="background:linear-gradient(135deg,#0d1f45,#1a3a6e);padding:70px 5%;text-align:center;">
    <h1 style="font-family:'Poppins',sans-serif;font-size:42px;font-weight:800;color:#fff;margin-bottom:14px;">Struktur Manajemen</h1>
    <p style="font-size:16px;color:rgba(255,255,255,.75);max-width:540px;margin:0 auto;line-height:1.7;">Tim kepemimpinan DPA Corp yang berpengalaman di bidang akademis dan bisnis.</p>
</section>
<section style="padding:80px 5%;">
    <div style="max-width:1100px;margin:0 auto;">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:24px;">
            @foreach($members as $member)
            <div class="card-pub" style="text-align:center;padding:28px 20px;">
                <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#e0f2fe,#bfdbfe);margin:0 auto 16px;overflow:hidden;border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,.1);">
                    @if($member->foto)
                        <img src="{{ asset('storage/'.$member->foto) }}" alt="{{ $member->foto_alt ?? $member->nama }}" style="width:100%;height:100%;object-fit:cover;" loading="lazy">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:36px;color:#1a3a6e;font-weight:700;font-family:'Poppins',sans-serif;">{{ strtoupper(substr($member->nama,0,1)) }}</div>
                    @endif
                </div>
                <div style="font-weight:700;font-size:15.5px;color:var(--primary);margin-bottom:6px;">{{ $member->nama }}</div>
                <div style="display:inline-block;background:linear-gradient(135deg,#1a3a6e,#2952a3);color:#fff;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:600;margin-bottom:12px;">{{ $member->jabatan }}</div>
                @if($member->deskripsi)
                    <p style="font-size:13px;color:var(--text-muted);line-height:1.6;">{{ $member->deskripsi }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
