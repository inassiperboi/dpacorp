{{--
    Partial: Hero banner dengan background video (opacity 20%)
    Pakai di halaman lain dengan:

    @include('public.partials.hero-video', [
        'label'       => 'Mengenal DPA Corp',      // opsional, hapus kalau tidak perlu
        'title'       => 'Tentang Kami',
        'description' => 'Teks deskripsi di bawah judul...', // opsional
        'maxWidth'    => '600px', // opsional, lebar maksimal paragraf
    ])
--}}
<section style="position:relative;overflow:hidden;background:#0d1f45;padding:70px 5%;text-align:center;">

    {{-- Video background --}}
    <video autoplay muted loop playsinline preload="auto"
           style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.2;z-index:0;pointer-events:none;">
        <source src="{{ asset('images/hero/video.mp4') }}" type="video/mp4">
    </video>

    {{-- Konten di atas video --}}
    <div style="position:relative;z-index:1;">
        @isset($label)
            <div class="section-label" style="color:#f0b84a;">{{ $label }}</div>
        @endisset

        <h1 style="font-family:'Poppins',sans-serif;font-size:42px;font-weight:800;color:#fff;margin-bottom:14px;">
            {{ $title }}
        </h1>

        @isset($description)
            <p style="font-size:16px;color:rgba(255,255,255,.75);max-width:{{ $maxWidth ?? '600px' }};margin:0 auto;line-height:1.7;">
                {{ $description }}
            </p>
        @endisset
    </div>
</section>
