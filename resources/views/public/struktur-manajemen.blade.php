@extends('public.layouts.app')
@section('meta-title', 'Struktur Manajemen — DPA Corp')
@section('content')
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Struktur Manajemen</li>
    </ol>
</div>
@include('public.partials.hero-video', [
    'label' => 'Mengenal DPA Corp',
    'title' => 'Struktur Manajemen',
    'description' => 'Tim kepemimpinan DPA Corp yang berpengalaman di bidang akademis dan bisnis.',
])

<section style="padding:80px 5%;">
    <div style="max-width:900px;margin:0 auto;text-align:center;">
        @if($structure->image)
            <img src="{{ asset('storage/'.$structure->image) }}" alt="{{ $structure->image_alt ?? 'Struktur Manajemen DPA Corp' }}"
                 style="width:100%;height:auto;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,.08);">
        @else
            <div style="padding:80px 20px;background:var(--bg);border-radius:16px;color:var(--text-muted);">
                Struktur manajemen belum tersedia.
            </div>
        @endif
    </div>
</section>
@endsection
