@extends('public.layouts.app')
@section('meta-title', 'Client Kami — DPA Corp')
@section('content')
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Client</li>
    </ol>
</div>
<section style="background:linear-gradient(135deg,#0d1f45,#1a3a6e);padding:70px 5%;text-align:center;">
    <h1 style="font-family:'Poppins',sans-serif;font-size:42px;font-weight:800;color:#fff;margin-bottom:14px;">Client Kami</h1>
    <p style="font-size:16px;color:rgba(255,255,255,.75);max-width:540px;margin:0 auto;line-height:1.7;">
        Dipercaya oleh berbagai institusi, pemerintah, BUMN, dan perusahaan swasta terkemuka.
    </p>
</section>
<section style="padding:80px 5%;">
    <div style="max-width:1100px;margin:0 auto;">
        @if($clients->isEmpty())
            <div style="text-align:center;color:var(--text-muted);padding:60px;">Belum ada data client.</div>
        @else
        <div style="display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:40px;">
            @foreach($clients as $client)
            <div style="text-align:center;transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                @if($client->logo)
                    <img src="{{ asset('storage/'.$client->logo) }}" alt="{{ $client->logo_alt ?? $client->nama }}"
                         style="height:64px;width:auto;max-width:160px;object-fit:contain;filter:grayscale(80%);opacity:.7;transition:all .3s;"
                         onmouseover="this.style.filter='none';this.style.opacity='1'"
                         onmouseout="this.style.filter='grayscale(80%)';this.style.opacity='.7'"
                         title="{{ $client->nama }}" loading="lazy">
                @else
                    <div style="font-weight:700;font-size:14px;color:var(--text-muted);padding:16px 24px;background:var(--bg);border-radius:10px;border:1px solid var(--border);">{{ $client->nama }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
