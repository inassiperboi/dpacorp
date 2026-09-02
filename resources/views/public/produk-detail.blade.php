@extends('public.layouts.app')

@section('meta-title', ($product->meta_title ?? $product->nama) . ' — DPA Corp')
@section('meta-description', $product->meta_description ?? $product->deskripsi_singkat)

@section('content')

<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li><a href="{{ url('/produk-layanan') }}">Produk & Layanan</a></li>
        <li>{{ $product->nama }}</li>
    </ol>
</div>

<section style="padding:60px 5%;">
    <div style="max-width:1000px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;">

        {{-- Gambar --}}
        <div>
            @if($product->thumbnail)
                <div style="border-radius:16px;overflow:hidden;margin-bottom:16px;background:var(--bg);">
                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->thumbnail_alt ?? $product->nama }}"
                         style="width:100%;max-height:400px;object-fit:cover;" loading="lazy">
                </div>
            @endif

            {{-- Galeri --}}
            @if($product->images->count())
            <div style="display:grid;grid-template-columns:repeat({{ min($product->images->count(), 4) }},1fr);gap:8px;">
                @foreach($product->images as $img)
                    <img src="{{ asset('storage/'.$img->image) }}" alt="{{ $img->alt_text }}"
                         style="width:100%;height:80px;object-fit:cover;border-radius:8px;cursor:pointer;"
                         onclick="openLightbox('{{ asset('storage/'.$img->image) }}')"
                         loading="lazy">
                @endforeach
            </div>
            @endif
        </div>

        {{-- Info --}}
        <div>
            @if($product->kategori)
                <div style="display:inline-block;background:var(--accent);color:#fff;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;margin-bottom:16px;">{{ $product->kategori }}</div>
            @endif

            <h1 style="font-family:'Poppins',sans-serif;font-size:32px;font-weight:800;color:var(--primary);margin-bottom:16px;line-height:1.2;">{{ $product->nama }}</h1>

            @if($product->deskripsi_singkat)
                <p style="font-size:16px;color:var(--text-muted);line-height:1.7;margin-bottom:24px;border-left:3px solid var(--accent);padding-left:16px;">{{ $product->deskripsi_singkat }}</p>
            @endif

            @if($product->deskripsi_lengkap)
                <div style="font-size:15px;color:var(--text);line-height:1.8;margin-bottom:32px;">{{ $product->deskripsi_lengkap }}</div>
            @endif

            <div style="display:flex;flex-direction:column;gap:10px;">
                <a href="{{ url('/kontak') }}" class="btn-pub btn-pub-primary" style="justify-content:center;">
                    📞 Hubungi Kami untuk Info Lebih Lanjut
                </a>
                <a href="{{ url('/produk-layanan') }}" class="btn-pub btn-pub-outline" style="justify-content:center;font-size:14px;padding:10px;">
                    ← Kembali ke Daftar Produk
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox" onclick="closeLightbox()"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.9);z-index:9999;align-items:center;justify-content:center;cursor:zoom-out;">
    <img id="lightbox-img" src="" alt="" style="max-width:90vw;max-height:90vh;border-radius:8px;">
</div>
@endsection

@push('scripts')
<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>
@endpush
